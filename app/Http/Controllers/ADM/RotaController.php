<?php

namespace App\Http\Controllers\ADM;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use Illuminate\Http\Request;
use App\Enum\MENSAGEM;
use App\Enum\TIPO_LOG;
use App\Sistema;
use App\Rota;

class RotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexRotas(Request $request)
    {
        //verifica acesso à rota
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('home');}

        try
        {
            //recupera as rotas do sistema
            $rotas = Rota::whereHas('Sistema',function($sistema)
                    {
                        $sistema->where(Sistema::$codigo,env('APP_SISTEMA'));
                    })
                    ->whereNull(Rota::$fk_rota_pai)
                    ->orderby(Rota::$index)
                    ->get();

            //recupera as permissões às funcionalidades
            $permisEditar = true;//RotaController::Acesso($request,'adm.rota.salvar');
            $permisDelete = true;//RotaController::Acesso($request,'adm.rota.delete');


            return View('adm.rota',['rotas'=>$rotas,'permEditar'=>$permisEditar,'permDelete'=>$permisDelete]);//->renderSections();
        }
        catch(\Exception $ex)
        {
            return Redirect::route('home')->withErrors('Erro ao carregar as rotas: '. $ex->getMessage());
        }

    }

    public function salvarRota(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('adm.rota');}

        try
        {
            $rta = Rota::whereHas('Sistema',function($sistema)
                    {
                        $sistema->where(Sistema::$codigo,env('APP_SISTEMA'));
                    })
                    ->where(function($query) use ($request)
                    {
                        $query->where(Rota::$rota,$request->rota)
                                ->orWhere(Rota::$nome,$request->nome);
                    })->first();

            if((empty($request->id) && !empty($rta)) || (!empty($request->id) && !empty($rta) &&  $request->id != $rta->getId()))
            {
                return Redirect::route('adm.rota')->withErrors('Já existe uma rota com este nome ou este endereço.');
            }



            $rota = Rota::findOrNew($request->id);
            $rota->setNome($request->nome);
            $rota->setRota($request->rota);
            $rota->setIcone($request->icone);
            $rota->setFkSistema(Util::getSistema()->getId());
            $rota->setMenu(!empty($request->menu));
            $rota->setFkRotaPai($request->pai);

            $rota->save();

            return Redirect::route('adm.rota');
        }
        catch(\Exception $ex)
        {
            return Redirect::route('adm.rota')->withErrors('Erro ao salvar a rota: '. $ex->getMessage());
        }
    }

    public function deleteRota(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('adm.rota');}

        try
        {
            $rota = Rota::find($request->id);
            $rota->delete();

            return Redirect::route('adm.rota');
        }
        catch(\Exception $ex)
        {
            return Redirect::route('adm.rota')->withErrors('Erro ao excluir a rota: '. $ex->getMessage());
        }
    }

    public function ajaxRotaPai(Request $request)
    {
        try
        {
            $rotas = Rota::whereHas('Sistema',function($sistema)
                    {
                        $sistema->where(Sistema::$codigo,env('APP_SISTEMA'));
                    });

            if(!empty($request->id))
            {
                $rotas->where(Rota::$id,'!=',$request->id);
            }

            $rotas = $rotas->where(Rota::$menu,'1')
                    ->orderby(Rota::$nome)
                    ->get()
                    ->map(function ($item)
                    {
                        return
                        [
                            'id'=>$item->getId(),
                            'nome'=>$item->getNome()
                        ];
                    });

            return response()->json($rotas,200);
        }
        catch(\Exception $ex)
        {
            return response()->json('erro ao buscar as rotas: '.$ex->getMessage(),500);
        }
    }

    public function ajaxOrganizaIndex(Request $request)
    {
        try
        {
            foreach($request->indexes as $item)
            {
                $rota = Rota::find($item['id']);
                $rota->setIndex($item['index']);
                $rota->save();
            }

            return response()->json(200);
        }
        catch(\Exception $ex)
        {
            return response()->json("Erro ao organizar as rotas",500);
        }
    }

    public static function GetComboRotas()
    {
        return Rota::whereHas('Sitema',function($sistema)
                {
                    $sistema->where(Sistema::$codigo,env('APP_SISTEMA'));
                })
                ->orderby(Rota::$nome)
                ->get()
                ->keyBy(Rota::$id)->map(function ($item)
                {
                    return $item->getNome();
                });
    }


    public static function Acesso(Request $request,$rota)
    {
        try
        {
            //caso não tenha nenhuma filial na sessão
            if(empty(Util::GetFilial()))
            {
                return false;
            }
            else if(empty(Auth::user()->Classe->first()->Rotas->where(Rota::$rota,$rota)->first()))
            {
                //log
                Util::Log($request,TIPO_LOG::$ACESSO,$rota,false);

                return false;
            }
            else
            {
                //log
                Util::Log($request,TIPO_LOG::$ACESSO,$rota,true);
                return true;
            }
        }
        catch(\Exception $ex)
        {
            return false;
        }
    }

    public static function AcessoNegado($redirecionar)
    {
        //caso não tenha nenhuma filial na sessão
        if(empty(Util::GetFilial()))
        {
            Util::Mensagem(MENSAGEM::$ALERTA,'Nenhuma Filial logada','É necessário estar logado a uma Filial.');

            return  redirect()->route('filial.alternar');
        }

        Util::Mensagem(MENSAGEM::$ALERTA,'Privilégios Insuficientes','Procure o administrador do sistema.');

        return Redirect::route($redirecionar);
    }

}
