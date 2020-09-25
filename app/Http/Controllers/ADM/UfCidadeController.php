<?php

namespace App\Http\Controllers\ADM;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use Illuminate\Http\Request;
use App\Estado;
use App\Cidade;

class UfCidadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function indexComboUF()
    {
        $uf =  Estado::orderby(Estado::$nome)->get()
                ->keyBy(Estado::$id)->map(function ($item)
                    {
                        return $item->getSigla().' - '.$item->getNome();
                    });
        return $uf;
    }

    public function CarregaCidade($estado)
    {
		$cidade = Cidade::where(Cidade::$fk_uf,$estado)->orderby(Cidade::$descricao)
				->get()
				->map(function ($item)
				{
					return ['id'=>$item->getId(),'nome'=>$item->getDescricao()];
				});

		return $cidade;
	}

	public function ajaxCidadeByUF(Request $request)
    {
        try
        {
            $cidades = $this->CarregaCidade($request->estado);

            return response()->json($cidades,200);
        }
        catch(\Exception $ex)
        {
            return response()->json('erro ao buscar a cidade: '.$ex->getMessage(),500);
        }
    }
}
