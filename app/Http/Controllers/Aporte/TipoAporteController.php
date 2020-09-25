<?php

namespace App\Http\Controllers\Aporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Util;
use App\Http\Controllers\ADM\RotaController;
use App\Enum\MENSAGEM;
use App\Models\Aporte\TipoAporte;

class TipoAporteController extends Controller
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

    private $rota = 'aporte.tipo.listar';

    public function ListarTipoAportes(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('home');}

        try
        {
            return view('aporte.tipo_listar',['tipos'=>TipoAporte::all()]);
        }
        catch (\Exception $ex)
        {
            Util::Mensagem(MENSAGEM::$ERRO,'Erro',$ex->getMessage());
            return redirect()->route('home');
        }
    }

    public function SalvarTipoAporte(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado($this->rota);}

        try
        {
            $tipo = TipoAporte::findOrNew($request->id);
            $tipo->setDescricao($request->descricao);
            $tipo->save();

            Util::Mensagem(MENSAGEM::$SUCESSO,'Tipo de Aporte salvo','Dados atualizados com sucesso');
            return redirect()->route($this->rota);
        }
        catch (\Exception $ex)
        {
            Util::Mensagem(MENSAGEM::$ERRO,'Erro',$ex->getMessage());
            return redirect()->route($this->rota);
        }
    }

    public function DeletarTipoAporte(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado($this->rota);}

        try
        {
            TipoAporte::findOrNew($request->id)->delete();

            Util::Mensagem(MENSAGEM::$SUCESSO,'Tipo de Aporte excluído','Exclusão realizada com sucesso');
            return redirect()->route($this->rota);
        }
        catch(\Exception $ex)
        {
            Util::Mensagem(MENSAGEM::$ERRO,'Erro',$ex->getMessage());
            return redirect()->route($this->rota);
        }
    }
}
