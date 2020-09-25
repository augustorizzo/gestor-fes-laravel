<?php

namespace App\Http\Controllers\Aporte;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Util;
use App\Http\Controllers\ADM\RotaController;
use App\Rota;
use App\Enum\MENSAGEM;
use App\Models\Aporte\Aporte;
use App\Models\Aporte\AporteDetalhe;

class AporteController extends Controller
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

    private $rota = 'aporte.listar';

    public function ListarAportes(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('home');}

        try
        {
            return view('aporte.aporte_listar',['aportes'=>Aporte::all()]);
        }
        catch (\Exception $ex)
        {
            Util::Mensagem(MENSAGEM::$ERRO,'Erro',$ex->getMessage());
            return redirect()->route('home');
        }
    }

    public function AcessaAporte(Request $request,$id_aporte)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('home');}

        try
        {
            return view('aporte.visualizar',['aporte'=>Aporte::find(Util::Decriptografa($id_aporte))]);
        }
        catch (\Exception $ex)
        {
            Util::Mensagem(MENSAGEM::$ERRO,'Erro',$ex->getMessage());
            return redirect()->route('home');
        }
    }


    public function SalvarAporte(Request $request)
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

    public function DeletarAporte(Request $request)
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

    public function AjaxDetalhesAportes(Request $request)
    {
        try
        {
            $detalhes = [];

            if(!empty($request->aportes))
            {
                $detalhes = AporteDetalhe::whereIn(AporteDetalhe::$fk_aporte,$request->aportes)
                    ->get()
                    ->map(function($item)
                    {
                        return
                        [
                            'categoria' => strtolower($item->Categoria->getDescricao()),
                            'valor' => round($item->getValor(),2)
                        ];
                    });
            }

            return response()->json($detalhes,200);
        }
        catch(\Exception $ex)
        {
            return response()->json($ex,500);
        }
    }
}
