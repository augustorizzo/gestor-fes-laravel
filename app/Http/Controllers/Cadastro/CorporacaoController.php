<?php

namespace App\Http\Controllers\Cadastro;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ADM\RotaController;
use App\Http\Controllers\Util;
use Illuminate\Http\Request;
use App\Models\Administracao\Corporacao;

class CorporacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $rota = 'cadastro.corporacao';

    public function ListarCorporacao(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('home');}

        try
        {
            return view('cadastro.corporacao',['corporacoes'=>Corporacao::all()]);
        }
        catch(\Exception $ex)
        {
            return Redirect::route($this->rota)->withErrors('erro ao carregar as corporações: '.$ex->getMessage());
        }
    }

    public function SalvarCorporacao(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado($this->rota);}

        try
        {
            $corp = Corporacao::where(Corporacao::$sigla,$request->sigla)
                ->orWhere(Corporacao::$nome,$request->nome)
                ->first();

            if(Util::VerificaDuplicidade($request->id,$corp))
            {
                return Redirect::route($this->rota)->withErrors('Já existe uma corporação com esta sigla ou nome.');
            }

            $corporacao = Corporacao::findOrNew($request->id);
            $corporacao->setSigla(strtoupper($request->sigla));
            $corporacao->setNome($request->nome);

            if($request->hasFile('logo'))
            {
                $corporacao->setLogo(Util::SalvarArquivo($request->logo,'corporacao',null));
            }

            $corporacao->save();

            return Redirect::route($this->rota);
        }
        catch(\Exception $ex)
        {
            return Redirect::route($this->rota)->withErrors('erro ao salvar o parâmetro: '.$ex->getMessage());
        }
    }

    public function DeletarCorporacao(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado($this->rota);}

        try
        {
            /*
            if(empty($request->id)){return Redirect::route($this->rota)->withErrors('Código do parâmetro vazio.');}

            $parametro = Parametro::find($request->id);
            $parametro->delete();

            return Redirect::route($this->rota);
            */
        }
        catch(\Exception $ex)
        {
            return Redirect::route($this->rota)->withErrors('erro ao excluir a corporação: '.$ex->getMessage());
        }
    }

}
