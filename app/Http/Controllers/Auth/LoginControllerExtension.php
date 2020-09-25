<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Util;
use App\Enum\TIPO_LOG;
use App\Filial;
use App\Permissao;
use App\Classe;
use Carbon\Carbon;

class LoginControllerExtension extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function GetLogout(Request $request)
    {
        //log do sistema
        //Util::Log($request,TIPO_LOG::$LOGOUT,'saiu do sistema',true);

        //limpa a sessão
        $this->TerminarSessao($request);

        //"desloga" o usuário
        auth::logout();

        //redireciona para o login
        return redirect()->route('login');
    }

    public function TerminarSessao(Request $request)
    {
        $request->session()->flush();
    }

    public function VerificaPermissoes(Request $request)
    {
        //se usuário tem apenas um acesso, loga no único acesso dele
        if(auth::user()->Permissoes->count() == 1)
        {
            //recupera a primeira permissão
            $permissao = auth::user()->Permissoes->first();

            return $this->LogaSessao($request,$permissao->Filial, $permissao->Classe);
        }
        //se usuário tem vários acessos, redireciona para a view de escolha da filial
        else if(auth::user()->Permissoes->count() > 1)
        {
            return redirect()->route('filial.alternar');
        }
        //caso não tenha nenhum acesso, redireciona para o logout
        else
        {
            return redirect()->route('logout');
        }
    }

    /**
     * Método para alternar a filial logada
     */
    public function AlternaFilial(Request $request)
    {
        try
        {
            $filiais = auth::user()->Permissoes->map(function($permissao)
            {
               return ['id'=> $permissao->Filial->getId(),'filial'=>$permissao->Filial->getNome()] ;
            });

            return view('auth.alterna_filial',['filiais'=>$filiais]);
        }
        catch(\Exception $ex)
        {
            return dd($ex);
        }
    }

    /**
     * Loga na filial selecionada
     */
    public function LoginFilial(Request $request)
    {
        try
        {
            //se nenhuma filial estiver logada, redireciona para escolher a filial
            if(empty($request->filial))
            {
                Util::Mensagem(MENSAGEM::$ERRO,'Nenhuma Filial selecionada','é obrigatório informar a filial para logar');

                return redirect()->route('filial.alternar');
            }

            //recupera a primeira permissão
            $permissao = Permissao::where(Permissao::$fk_usuario,auth::user()->getId())->where(Permissao::$fk_filial,$request->filial)->first();

            return $this->LogaSessao($request,$permissao->Filial, $permissao->Classe);
        }
        catch(\Exception $ex)
        {
            return dd($ex);
        }
    }

    /* ##############################  ############################## */

    private function LogaSessao(Request $request,Filial $filial, Classe $classe)
    {
        //limpa a filial e os menus da sessão
        session()->forget(['user.filial','user.menus','user.session']);

        //renova o tempo da sessão
        session()->regenerate();

        //seta a filial, os menus e o inicio da sessão
        session(['user.filial'=>$filial,'user.menus'=>$this->MenuSessao($classe),'user.session'=>Carbon::now()->getTimestamp()]);


        //log do sistema
        Util::Log($request,TIPO_LOG::$LOGIN,'entrou no sistema',true);

        //redireciona para a página inicial
        return redirect()->route('home');
    }

    //cria a estrutura do menu
    private function MenuSessao(Classe $classe)
    {
        //menus
        return $classe
            ->RotasMenu
            ->map(function($item)
            {
                return
                [
                    'id'=>$item->getId(),
                    'is_pai'=> empty($item->RotaPai),
                    'nome'=>$item->getNome(),
                    'icone'=>$item->getIcone(),
                    'rota'=>$item->getRota(),
                    'submenu'=>$item->Rotas
                    ->map(function($sub)
                    {
                        return
                        [
                            'id'=>$sub->getId(),
                            'is_menu'=>$sub->isMenu(),
                            'nome'=>$sub->getNome(),
                            'rota'=>$sub->getRota(),
                            'icone'=>$sub->getIcone()
                        ];
                    })
                ];
            });
    }
}
