<?php

namespace App\Http\Controllers\ADM;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use Illuminate\Http\Request;
use App\Estado;

class UfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexUf(Request $request)
    {
        $ufs = Estado::orderby(Estado::$nome)->get();

        return view('adm.uf',['ufs'=>$ufs]);
    }

    public function salvarEstado(Request $request)
    {
        try
        {
            if(!empty(Estado::where(Estado::$nome,$request->nome)->first()))
            {
                return Redirect::back()->withErrors('Já existe um Estado com este nome.');
            }

            $uf = Estado::findOrNew($request->id);
            $uf->setNome($request->nome);
            $uf->setSigla($request->sigla);
            
            $uf->save();
        }
        catch(\Exception $ex)
        {
            return Redirect::back()->withErrors('erro ao salvar o Estado: '.$ex->getMessage());
        }

        return Redirect::route('adm.uf');
    }

    public static function GetComboEstado()
    {
        return Estado::orderby(Estado::$nome)->get()
        ->keyBy(Estado::$id)->map(function ($item) 
        {
            return $item->getNome();
        });
    }
}
