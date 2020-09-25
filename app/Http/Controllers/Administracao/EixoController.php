<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Util;
use App\Http\Controllers\ADM\RotaController;
use App\Rota;
use App\Enum\MENSAGEM;
use App\Models\Administracao\Eixo;

class EixoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $rota = 'administracao.eixo';

    public function ListarEixo(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('home');}

        try 
        {
            $eixos = Eixo::all();

            return view($this->rota,['eixos'=>$eixos]);
        } 
        catch (\Exception $ex) 
        {
            Util::Mensagem(MENSAGEM::$ERRO,'Erro',$ex->getMessage());
            return redirect()->route('home');
        }
    }

    public function SalvarEixo(Request $request)
    {
        try 
        {
            Util::Mensagem(MENSAGEM::$SUCESSO,'Dados atualizados com sucesso','');
            return redirect()->route($this->rota);
        }
        catch (\Exception $ex) 
        {
            Util::Mensagem(MENSAGEM::$ERRO,'Erro',$ex->getMessage());
            return redirect()->route($this->rota);
        }
    }

    public function DeletarEixo(Request $request)
    {
        try
        {
            Util::Mensagem(MENSAGEM::$SUCESSO,'Exclusão realizada com sucesso','');
            return redirect()->route($this->rota);
        }
        catch(\Exception $ex)
        {
            Util::Mensagem(MENSAGEM::$ERRO,'Erro',$ex->getMessage());
            return redirect()->route($this->rota);
        }
    }
}
