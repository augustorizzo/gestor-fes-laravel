<?php

namespace App\Http\Controllers\ADM;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\User;
//use App\UsuarioComunidade;
use App\Permissao;
use Hash;
use App\Http\Controllers\Email\Email;
use App\Enum\MENSAGEM;
use App\Enum\TIPO_LOG;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $rota = 'adm.usuario';

    public function indexUsuario(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('home');}

        try
        {
            return View('adm.usuarios',
            [
                'usuarios'=>User::all(),
                'classes'=>ClasseController::GetComboClasse()
            ]);
        }
        catch(\Exception $ex)
        {
            return Redirect::route('home')->withErrors('erro ao carregar os usuários: '.$ex->getMessage());
        }
    }

    public function salvarUsuario(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado($this->rota);}

        try
        {
            $nick = $request->usuario;

            $user = User::where(User::$usuario,$nick)->first();

            if(Util::VerificaDuplicidade($request->id,$user))
            {
                return Redirect::route($this->rota)->withErrors('O usuário informado já está em uso.');
            }

            $usuario = User::findOrNew($request->id);
            $usuario->setNome($request->nome);
            $usuario->setSobreNome($request->sobrenome);
            $usuario->setEmail($request->email);
            $usuario->setUsuario($nick);
            $usuario->setTelefone($request->telefone);
            $usuario->setCelular($request->celular);
            $usuario->setAtivo(!empty(($request->ativo)));

            if($request->hasFile('foto') && $request->file('foto')->isValid())
            {
                $usuario->setFoto(Util::SalvarArquivo($request->foto,'usuario',null));
            }

            if(empty($request->id) || (!empty($request->id) && !empty($request->senha)))
            {
                $usuario->setSenha(Hash::make($request->senha));
            }

            //salva o usuário
            $usuario->save();

            //Permissões
            {
                //exclui as permissões do usuário
                Permissao::where(Permissao::$fk_usuario,$usuario->getId())->delete();

                //insere permissão
                $permissao = New Permissao;
                $permissao->setFkUsuario($usuario->getId());
                $permissao->setFkClasse($request->classe);
                $permissao->save();
            }

            //Vínculo às filiais aqui
            {
                /*
                //exclui os acessos às comunidades
                UsuarioComunidade::where(UsuarioComunidade::$fk_usuario,$usuario->getId())->delete();
                
                //insere os acessos às comunidades
                $usuCom = New UsuarioComunidade;
                $usuCom->setFkUsuario($usuario->getId());
                $usuCom->setFkComunidade($request->comunidade);
                $usuCom->save();
                */
            }

            return Redirect::route($this->rota);
        }
        catch(\Exception $ex)
        {
            return Redirect::route($this->rota)->withErrors('erro ao salvar o usuário: '.$ex->getMessage());
        }
    }

    public function deleteUsuario(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado($this->rota);}

        try
        {
            $usuario = User::find($request->id);
            
            //exclui as permissões do usuário
            Permissao::where(Permissao::$fk_usuario,$usuario->getId())->delete();

            //exclui os acessos às filiais aqui
            //UsuarioComunidade::where(UsuarioComunidade::$fk_usuario,$usuario->getId())->delete();

            $usuario->delete();

            return Redirect::route($this->rota);
        }
        catch(\Exception $ex)
        {
            return Redirect::route($this->rota)->withErrors('erro ao excluir o usuário: '.$ex->getMessage());
        }
    }

    /* ########################## PERFIL ########################## */

    public function perfil(Request $request)
    {
        try
        {
            //verifica se o usuário possui senha temporária
            $senha = (auth::user()->isResetado() || auth::user()->isPrimeiroAcesso());

            if($senha)
            {
                Util::Mensagem(MENSAGEM::$ALERTA,'Altere sua senha temporária','É altamente recomendável alterar sua senha');
            }

            return view('auth.perfil.perfil',['senha'=>$senha]);
        }
        catch(\Exception $ex)
        {
            return dd($ex);
            return Util::TrataMensagemErro('home','Erro ao acessar o perfil',$ex);
        }
    }

    public function salvarPerfil(Request $request)
    {
        try
        {
            $usuario = Auth::user();
            $usuario->setNome($request->nome);
            $usuario->setSobreNome($request->sobrenome);
            $usuario->setEmail($request->email);
            $usuario->setCelular($request->celular);
            

            if($request->hasFile('foto') && $request->file('foto')->isValid())
            {
                $usuario->setFoto(Util::SalvarArquivo($request->foto,'usuario',null));
            }

           //alteração de senha
            if(!empty($request->nova_senha))
            {

                //verifica se a senha digitada confere com a atual
                if(empty($request->senha_atual) || !Hash::check($request->senha_atual, $usuario->getSenha()))
                {
                    Util::Mensagem(MENSAGEM::$ERRO,'Erro ao atualizar os dados','Senha atual não confere');

                    return redirect()->route('perfil.index');
                }

                //verifica se a nova senha é igual a senha da confirmação
                if($request->nova_senha != $request->confirma_senha)
                {
                    Util::Mensagem(MENSAGEM::$ERRO,'Erro ao atualizar os dados','Nova senha e a confirmação não são iguais');

                    return redirect()->route('perfil.index');
                }

                //seta a senha nova
                $usuario->setSenha(Hash::make($request->nova_senha));
                $usuario->setIsResetado(false);
                $usuario->setIsPrimeiroAcesso(false);

                //envia e-mail
                Email::AlteracaoSenha($usuario);

                //log
                Util::Log($request,TIPO_LOG::$ALTERACAO_SENHA,'senha de acesso alterada');
            }

            //salva os dados
            $usuario->save();

            //mensagem de sucesso
            Util::Mensagem(MENSAGEM::$SUCESSO,'Perfil atualizado','Dados do perfil salvos');
        
            return redirect()->route('perfil.index');
        }
        catch(\Exception $ex)
        {
            return Util::TrataMensagemErro('perfil.index','Erro ao salvar os dados do perfil',$ex); 
        }
    }

    /**
     * reseta a senha do usuário 
    */ 
    public function ResetarSenha(Request $request)
    {
        try
        {
            //busca o usuário
            $usuario = User::where(User::$id,$request->id_usuario);

            if(!auth::user()->Classe->first()->isAdmin())
            {
                $usuario->whereHas('Permissoes',function($com)
                {
                    $com->where(Permissao::$fk_comunidade, Util::GetComunidadeSessao()->getId());
                });
            }

            $usuario = $usuario->first();

            //verifica se usuário pertence à comunidade do usuário logado
            if(empty($usuario))
            {
                //log negativo de reset de senha
                Util::Log($request,TIPO_LOG::$RESET_SENHA,'tentativa de resetar senha de usuário de outra comunidade ou inexistente',false,null,null,$request->id_usuario);

                return response()->json('acesso negado. O usuário indicado não pertence à comunidade logada.',500);
            }

            //gera senha aleatória
            $nova_senha = Util::GeraSenha(8,true,true,true);
            
            //seta senha aleatoria
            $usuario->setSenha(Util::Criptografia($nova_senha));
            $usuario->setIsResetado(true);
            $usuario->save();
            
            //envia e-mail
            Email::ResetSenha($usuario,$nova_senha);
            
            //log de reset de senha
            Util::Log($request,TIPO_LOG::$RESET_SENHA,'reset de senha de usuário',true,null,null,$request->id_usuario);

            return response()->json(200);
        }
        catch(\Exception $ex)
        {
            return response()->json('erro ao resetar a senha do usuário: '.$ex->getMessage(),500);
        }
    }

}
