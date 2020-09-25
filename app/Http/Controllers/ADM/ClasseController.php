<?php

namespace App\Http\Controllers\ADM;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Util;
use Illuminate\Http\Request;
use app\Sistema;
use App\Classe;
use App\Rota;
use App\Permissao;
use App\Classe_Rota;

class ClasseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     //############ CLASSE ############
     public function indexClasse(Request $request)
     {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('home');}

         try
         {
             $classes = Classe::whereHas('Sistema',function($sistema)
                        {
                            $sistema->where(Sistema::$codigo,env('APP_SISTEMA'));
                        })
                        ->get();

             return view('adm.classes',['classes'=>$classes]);
         }
         catch(\Exception $ex)
         {
             return Redirect::route('home')->withErrors('erro ao carregar as classes: '.$ex->getMessage());
         }
     }

    public function salvarClasse(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('adm.classe');}

        try
        {
            $cls = Classe::whereHas('Sistema',function($sistema)
                        {
                            $sistema->where(Sistema::$codigo,env('APP_SISTEMA'));
                        })
                        ->where(Classe::$codigo,$request->codigo)->first();

            if((empty($request->id) && !empty($cls)) || (!empty($request->id) && !empty($cls) && $request->id != $cls->getId()))
            {
                return Redirect::back()->withErrors('Já existe uma classe com este codigo.');
            }

            $classe = Classe::findOrNew($request->id);
            $classe->setCodigo($request->codigo);
            $classe->setDescricao($request->descricao);
            $classe->setFkSistema(Util::getSistema()->getId());

            $classe->save();

            return Redirect::route('adm.classe');
        }
        catch(\Exception $ex)
        {
            return Redirect::route('adm.classe')->withErrors('erro ao salvar a classe: '.$ex->getMessage());
        }


    }

    public function deleteClasse(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('adm.classe');}

        try
        {
            if(empty($request->id))
            {
                return Redirect::route('adm.classe')->withErrors('ID da classe vazio.');
            }

            $classe = Classe::find($request->id);
            $classe->delete();

            return Redirect::route('adm.classe');
        }
        catch(\Exception $ex)
        {
            return Redirect::back()->withErrors('erro ao excluir a classe: '.$ex->getMessage());
        }


    }

    public static function GetComboClasse()
    {
        return Classe::whereHas('Sistema',function($sistema)
                {
                    $sistema->where(Sistema::$codigo,env('APP_SISTEMA'));
                })
                ->orderby(Classe::$descricao)
                ->get()
                ->keyBy(Classe::$id)->map(function ($item)
                {
                    return $item->getDescricao();
                });
    }

    //############ CLASSES X ROTAS ############
    public function indexClasseRotas(Request $request)
    {
        if(!RotaController::Acesso($request,'adm.classe_rotas')){return RotaController::AcessoNegado('home');}

        try
        {
            $classes = Classe::whereHas('Sistema',function($sistema)
                        {
                            $sistema->where(Sistema::$codigo,env('APP_SISTEMA'));
                        })
                        ->get();

            return View('adm.classe_rota',['classes'=>$classes]);
        }
        catch(\Exception $ex)
        {
            return Redirect::route('home')->withErrors('erro ao carregar as classes x rotas: '.$ex->getMessage());
        }
    }

    public function ajaxCarregaRotasByClasse(Request $request)
    {
        try
        {
            $id_classe = $request->id;

            //rotas do sistema que não estão vinculadas à classe
            $rotasDisponiveis = Rota::whereHas('Sistema',function($sistema)
                                {
                                    $sistema->where(Sistema::$codigo,env('APP_SISTEMA'));
                                })
                                ->whereDoesntHave('Classes',function($query) use ($id_classe)
                                {
                                    $query->where(Classe::$id,$id_classe);
                                })
                                ->get()
                                ->map(function($item)
                                {
                                    return ['id'=> $item->getId(),'label'=> $item->getNome()];
                                });

            //rotas vinculadas à classe
            $rotasClasse = Rota::whereHas('Sistema',function($sistema)
                        {
                            $sistema->where(Sistema::$codigo,env('APP_SISTEMA'));
                        })
                    ->whereHas('Classes',function($query) use ($id_classe)
                        {
                            $query->where(Classe::$id,$id_classe);
                        })
                    ->get()
                    ->map(function($item) use($request)
                    {
                       return
                       [
                           'id'=> $item->getId(),
                           'label'=> $item->getNome(),
                           'menu'=>$item->isMenu(),
                           'padrao'=>Classe_Rota::where(Classe_rota::$fk_classe,$request->id)->where(Classe_rota::$fk_rota,$item->getId())->first()->isPadrao()
                        ];
                    });

            $dados = ['available'=>$rotasDisponiveis,'selected'=>$rotasClasse];

            return response()->json($dados,200);
        }
        catch(\Exception $ex)
        {
            return response()->json('erro ao buscar as rotas da classe: '.$ex->getMessage(),500);
        }
    }

    public function ajaxVinculaRotas(Request $request)
    {
        try
        {
            if($request->associa == 'true')
            {
                foreach($request->rotas as $rota)
                {
                    $vincula = New Classe_Rota;

                    $vincula->setFkClasse($request->idClasse);
                    $vincula->setFkRota($rota['id']);
                    $vincula->save();
                }
            }
            else
            {
                foreach($request->rotas as $rota)
                {
                    $claro = Classe_Rota::where(Classe_Rota::$fk_classe,$request->idClasse)->where(Classe_Rota::$fk_rota,$rota['id'])->first();
                    $claro->delete();
                }
            }

            return response()->json(200);
        }
        catch(\Exception $ex)
        {
            return response()->json('erro ao associar rota à classe: '.$ex->getMessage(),500);
        }
    }

    /**
     *
     */
    public function ajaxSetaRotaPadrao(Request $request)
    {
        try
        {
            if(!empty($request->classe))
            {
                //atualiza todas as linhas
                Classe_Rota::where(Classe_Rota::$fk_classe,$request->classe)->update([Classe_Rota::$rota_padrao=>false]);

                if(!empty($request->rota))
                {
                    Classe_Rota::where(Classe_Rota::$fk_classe,$request->classe)
                                ->where(Classe_Rota::$fk_rota,$request->rota)
                                ->update([Classe_Rota::$rota_padrao=>true]);
                }
            }

            return response()->json(200);
        }
        catch(\Exception $ex)
        {
            return response()->json('erro ao indicar a rota padrão: '.$ex->getMessage(),500);
        }
    }

    //############ CLASSES X USUÁRIOS ############

    public static function PermissaoUsuario($usuario,$fk_classe)
    {

        try
        {

            //exclui as classes vinculadas ao usuario no sistema atual
            Permissao::where(Permissao::$fk_usuario,$usuario->getId())
                    ->whereHas('Classe',function($classe)
                    {
                        $classe->where(Classe::$fk_sistema,Util::getSistema()->getId());
                    })
                    ->delete();

            //vincula a nova classe do sistema ao usuário, caso seja indicado uma classe

            if(!empty($fk_classe))
            {
                $permissao = New Permissao;
                $permissao->setFkClasse($fk_classe);
                $permissao->setFkUsuario($usuario->getId());
            }

            $permissao->save();
        }
        catch(\Exception $ex)
        {
            report($ex);
        }
    }

}
