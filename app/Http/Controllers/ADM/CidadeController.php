<?php

namespace App\Http\Controllers\ADM;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use Illuminate\Http\Request;
use App\Cidade;

class CidadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexCidade(Request $request)
    {
        $cidades = Cidade::orderby(Cidade::$descricao)->get();

        $estados = UfController::GetComboEstado();
        
        return view('adm.cidade',['cidades'=>$cidades,'estados'=>$estados]);
    }

    public function salvarCidade(Request $request)
    {
        try
        {
            if(!empty(Cidade::where(Cidade::$fk_estado,$request->uf)->where(Cidade::$nome,$request->nome)->first()))
            {
                return Redirect::back()->withErrors('Já existe uma Cidade com este nome no estado selecionado.');
            }

            $cidade = Cidade::findOrNew($request->id);
            $cidade->setNome($request->nome);
            $cidade->setFkEstado($request->uf);
            
            $uf->save();
        }
        catch(\Exception $ex)
        {
            return Redirect::back()->withErrors('erro ao salvar o Estado: '.$ex->getMessage());
        }

        return Redirect::route('adm.uf');
    }
}
