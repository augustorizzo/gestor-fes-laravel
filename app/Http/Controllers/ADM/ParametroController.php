<?php

namespace App\Http\Controllers\ADM;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use Illuminate\Http\Request;
use App\Parametro;

class ParametroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $rota = 'adm.parametro';
    
    //############ PARÂMETRO ############
    public function indexParametro(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('home');}

        try
        {
            $parametros = Parametro::all();

            return view('adm.parametros',['parametros'=>$parametros]);
        }
        catch(\Exception $ex)
        {
            return Redirect::route($rota)->withErrors('erro ao carregar os parâmetros: '.$ex->getMessage());
        }
    }

    public function salvarParametro(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado($rota);}

        try
        {
            $p = Parametro::where(Parametro::$codigo,$request->codigo)->first();

            if((empty($request->id) && !empty($p)) || (!empty($request->id) && !empty($p) && $request->id != $p->getId()))
            {
                return Redirect::route($rota)->withErrors('Já existe um parametro com este código.');
            }

            $parametro = Parametro::findOrNew($request->id);
            $parametro->setCodigo($request->codigo);
            $parametro->setDescricao($request->descricao);
            $parametro->setValor($request->valor);

            $parametro->save();

            return Redirect::route($rota);
        }
        catch(\Exception $ex)
        {
            return Redirect::route($rota)->withErrors('erro ao salvar o parâmetro: '.$ex->getMessage());
        }
    }

    public function deleteParametro(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado($rota);}

        try
        {
            if(empty($request->id)){return Redirect::route($rota)->withErrors('Código do parâmetro vazio.');}

            $parametro = Parametro::find($request->id);
            $parametro->delete();

            return Redirect::route($rota);
        }
        catch(\Exception $ex)
        {
            return Redirect::route($rota)->withErrors('erro ao excluir o parâmetro: '.$ex->getMessage());
        }
    }
 
}
