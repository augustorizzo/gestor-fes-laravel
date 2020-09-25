<?php

namespace App\Http\Controllers\Cadastro;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ADM\RotaController;
use App\Http\Controllers\Util;
use Illuminate\Http\Request;
use App\Unidade;

class UnidadeMedidaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $rota = 'cadastro.unidade-medida';

    public function ListarUnidadeMedida(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('home');}

        try
        {
            return view('cadastro.unidade-medida',['unidades'=>Unidade::all()]);
        }
        catch(\Exception $ex)
        {
            return Redirect::route($this->rota)->withErrors('erro ao carregar as corporações: '.$ex->getMessage());
        }
    }

    public function SalvarUnidadeMedida(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado($this->rota);}

        try
        {
            $und = Unidade::where(Unidade::$sigla,$request->sigla)
                ->orWhere(Unidade::$descricao,$request->nome)
                ->first();

            if(Util::VerificaDuplicidade($request->id,$und))
            {
                return Redirect::route($this->rota)->withErrors('Já existe uma unidade com este código ou nome.');
            }

            $unidade = Unidade::findOrNew($request->id);
            $unidade->setSigla(strtoupper($request->sigla));
            $unidade->setDescricao($request->nome);

            $unidade->save();

            return Redirect::route($this->rota);
        }
        catch(\Exception $ex)
        {
            return Redirect::route($this->rota)->withErrors('erro ao salvar a unidade de medida: '.$ex->getMessage());
        }
    }

    public function DeletarUnidadeMedida(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado($this->rota);}

        try
        {
            if(empty($request->id)){return Redirect::route($this->rota)->withErrors('Código da unidade de medida vazio.');}

            Unidade::find($request->id)->delete();

            return Redirect::route($this->rota);
        }
        catch(\Exception $ex)
        {
            return Redirect::route($this->rota)->withErrors('erro ao excluir a unidade de medida: '.$ex->getMessage());
        }
    }

}
