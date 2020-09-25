<?php

namespace App\Http\Controllers\ADM;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use Illuminate\Http\Request;
use App\Sistema;

class SistemaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     //############ SISTEMA ############
     public function indexSistema(Request $request)
     {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('home');}

        try
        {
            $sistemas = Sistema::all();

            return view('adm.sistemas',['sistemas'=>$sistemas]);
        }
        catch(\Exception $ex)
        {
            return Redirect::route('download')->withErrors('erro ao carregar os sistemas: '.$ex->getMessage());
        }
     }

    public function salvarSistema(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('adm.sistema');}

        try
        {
            $sist = Sistema::where(Sistema::$codigo,$request->codigo)->first();

            if((empty($request->id) && !empty($sist)) || (!empty($request->id) && !empty($sist) && $request->id != $sist->getId()))
            {
                return Redirect::route('adm.sistema')->withErrors('Já existe um sistema com este código.');
            }

            $sistema = Sistema::findOrNew($request->id);
            $sistema->setCodigo($request->codigo);
            $sistema->setDescricao($request->descricao);
            $sistema->save();

            return Redirect::route('adm.sistema');
        }
        catch(\Exception $ex)
        {
            return Redirect::route('adm.sistema')->withErrors('erro ao salvar o sistema: '.$ex->getMessage());
        }
    }

    public function deleteSistema(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('adm.sistema');}

        try
        {
            if(empty($request->id))
            {
                return Redirect::route('adm.sistema')->withErrors('Código do sistema vazio.');
            }

            $sistema = Sistema::find($request->id);
            $sistema->delete();

            return Redirect::route('adm.sistema');
        }
        catch(\Exception $ex)
        {
            return Redirect::route('adm.sistema')->withErrors('erro ao excluir o sistema: '.$ex->getMessage());
        }
    }
 
}
