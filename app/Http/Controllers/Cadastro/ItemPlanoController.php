<?php

namespace App\Http\Controllers\Cadastro;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ADM\RotaController;
use App\Http\Controllers\Util;
use Illuminate\Http\Request;
use App\ItemPlano;

class ItemPlanoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $rota = 'cadastro.item-plano';

    public function ListarItemPlano(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('home');}

        try
        {
            return view('cadastro.item-plano',['itemPlano'=>ItemPlano::all()]);
        }
        catch(\Exception $ex)
        {
            return Redirect::route($this->rota)->withErrors('erro ao carregar as corporações: '.$ex->getMessage());
        }
    }

    public function SalvarItemPlano(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado($this->rota);}

        try
        {
            $item = ItemPlano::where(ItemPlano::$descricao,$request->nome)
                ->first();

            if(Util::VerificaDuplicidade($request->id,$item))
            {
                return Redirect::route($this->rota)->withErrors('Já existe um item com este código ou nome.');
            }

            $itemPlano = ItemPlano::findOrNew($request->id);
            $itemPlano->setDescricao($request->nome);

            $itemPlano->save();

            return Redirect::route($this->rota);
        }
        catch(\Exception $ex)
        {
            return Redirect::route($this->rota)->withErrors('erro ao salvar a unidade de medida: '.$ex->getMessage());
        }
    }

    public function DeletarItemPlano(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado($this->rota);}

        try
        {
            if(empty($request->id)){return Redirect::route($this->rota)->withErrors('Código do item vazio.');}

            ItemPlano::find($request->id)->delete();

            return Redirect::route($this->rota);
        }
        catch(\Exception $ex)
        {
            return Redirect::route($this->rota)->withErrors('erro ao excluir o item: '.$ex->getMessage());
        }
    }

}
