<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Email\Email;
use App\User;
use App\Http\Controllers\Util;
use App\Enum\MENSAGEM;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * 
     */
    public function BloqueiaUsuarioAlteracaoSenha($prefixo,$prefixo2,$id_usuario,$sufixo)
    {
        try
        {

            $usuario = User::find($id_usuario);
            $usuario->setAtivo(false);
            $usuario->save();
            
            return redirect()->route((Auth::check() ? 'logout' : 'login'));
        }
        catch(\Exception $ex)
        {
            return dd($ex);
        }
    }

    public function ResetarSenha(Request $request)
    {
        try
        {
            //recupera o CPF e limpa os caracteres
            $cpf = Util::LimpaCpf($request->cpf);

            //busca o usuário no banco
            $usuario = User::where(User::$cpf,$cpf)->where(User::$ativo,true)->first();

            //verifica se encontrou o usuário no banco
            if(!empty($usuario))
            {
                //gera senha aleatória de 8 caracteres
                $senha = Util::GeraSenha(8,true,true,true);
                //seta a nova senha
                $usuario->setSenha(Util::Criptografia($senha));
                //marca como resetado
                $usuario->setIsResetado(true);
                //salva as alterações
                $usuario->save();

                //envia e-mail de reset da senha
                Email::ResetSenha($usuario,$senha);

                //mostra a mensagem de sucesso
                Util::Mensagem(MENSAGEM::$SUCESSO,'Senha Resetada','Você receberá uma senha temporária no e-mail cadastrado');
            }
            else
            {
                //mostra a mensagem de erro caso não encontre o usuário do banco
                Util::Mensagem(MENSAGEM::$ERRO,'CPF não encontrado','Entre em contato com o administrador do sistema');
            }

            //retorna para a tela de login
            return redirect()->route('login');
        }
        catch(\Exception $ex)
        {
            return dd($ex);
        }
    }

}
