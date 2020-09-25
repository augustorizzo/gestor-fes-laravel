<?php

namespace App\Http\Controllers\Planejamento;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Util;
use App\Http\Controllers\ADM\RotaController;
use App\Rota;
use App\Enum\MENSAGEM;
use App\Enum\TIPO_CREDITO;
use App\Models\Administracao\Programa;
use App\Models\Administracao\Eixo;
use App\Models\Planejamento\PlanoAcao;
use App\Models\Planejamento\PlanoAporte;
use App\Models\Planejamento\PlanoAcaoItem;
use App\Models\Planejamento\PlanoAcaoItemDetalhe;
use App\Models\Aporte\Aporte;
use App\Models\Planejamento\PlanoAcaoAnexo;
use Carbon\Carbon;
use PDF;

class PlanoController extends Controller
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

    private $rota = 'planejamento.plano';

    public function ListarPlano(Request $request)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('home');}

        try
        {
            $planos = PlanoAcao::all();

            return view($this->rota,['planos'=>$planos]);
        }
        catch (\Exception $ex)
        {
            Util::Mensagem(MENSAGEM::$ERRO,'Erro',$ex->getMessage());
            return redirect()->route('home');
        }
    }

    public function EditarPlano(Request $request,$id_plano)
    {
        if(!RotaController::Acesso($request,$request->route()->getName())){return RotaController::AcessoNegado('home');}

        try
        {
            $plano = PlanoAcao::find(Util::Decriptografa($id_plano));
            $aportes = Aporte::all();

            return view('planejamento.crud_plano_acao',['plano'=>$plano,'aportes'=>$aportes]);
        }
        catch (\Exception $ex)
        {
            Util::Mensagem(MENSAGEM::$ERRO,'Erro',$ex->getMessage());
            return redirect()->route($this->rota);
        }
    }

    public function SalvarPlano(Request $request)
    {
        try
        {
            $plano = PlanoAcao::findOrNew((!empty($request->id) ? Util::Decriptografa($request->id) : null));

            $plano->setAno(Util::GetData()->format('Y'));
            $plano->setIdentificador($request->identificador);
            $plano->setFkOrgao($request->orgao);
            $plano->setFkEixo($request->eixo);
            $plano->setFkGestor($request->gestor);
            $plano->setFkResponsavel($request->responsavel);
            $plano->setApelido($request->apelido);
            $plano->setResumo($request->resumo);
            $plano->setJustificativa($request->justificativa);
            $plano->setTerritorio($request->territorio);
            $plano->setEstrategia($request->estrategia);
            $plano->setImpacto($request->impacto);
            $plano->setResultado($request->resultado);
            $plano->setObjetivo($request->objetivo);

            $plano->save();


            /* vincula o plano com os aportes selecionados */
            //deleta os vínculos anteriores
            PlanoAporte::where(PlanoAporte::$fk_plano,$plano->getId())->delete();

            if(!empty($request->aporte))
            {
                foreach($request->aporte as $aporte)
                {
                    //return dd([PlanoAporte::$fk_plano=>$plano->getId(),PlanoAporte::$fk_aporte=>intval($aporte)]);

                    //insere o vínculo do plano com os aportes
                    PlanoAporte::create([PlanoAporte::$fk_plano=>$plano->getId(),PlanoAporte::$fk_aporte=>intval($aporte)]);
                }
            }

            /*################### ITENS DO PLANO ###################*/
            {
                //guarda os ids dos itens salvos da tela
                $array_id_itens =[];
                //guarda todos os ids gerados para apagar os que foram apagados em tela
                $array_ids =[];

                //percorre os itens do plano de ação
                if(!empty($request->planoitem))
                {
                    foreach($request->planoitem as $item)
                    {
                        $id = (strrpos($item['id'], "x") == true ? null : $item['id']);
                        $id_pai = $item['pai'];

                        $planoItem = PlanoAcaoItem::findOrNew($id);
                        $planoItem->setFkPlano($plano->getId());
                        $planoItem->setIndex($item['idx']);
                        $planoItem->setTitulo($item['titulo']);
                        $planoItem->setJustificativa($item['justificativa'] != 'null' ? $item['justificativa'] : null);
                        $planoItem->setTerritorio($item['territorio'] != 'null' ? $item['territorio'] : null);
                        $planoItem->setEstrategia($item['estrategia'] != 'null' ? $item['estrategia'] : null);
                        $planoItem->setObjetivo($item['objetivo'] != 'null' ? $item['objetivo'] : null);
                        $planoItem->setResultado($item['resultado'] != 'null' ? $item['resultado'] : null);
                        $planoItem->setImpacto($item['impacto'] != 'null' ? $item['impacto'] : null);
                        $planoItem->setIndicador($item['indicador'] != 'null' ? $item['indicador'] : null);
                        $planoItem->setMeta($item['meta'] != 'null' ? $item['meta'] : null);

                        //verifica se é um subitem
                        if($id_pai != 'null')
                        {
                            //verifica se o pai do item foi criado em tela
                            if(strrpos($id_pai, "x") == true)
                            {
                                //procura o ID salvo no banco pelo ID gerado em tela
                                $arr_pai = array_filter($array_id_itens,function($var) use($id_pai)
                                {
                                    return $var['id_tela'] == $id_pai;
                                });

                                //caso tenha encontrado o id do banco pelo id da tela no array
                                if($arr_pai != null)
                                {
                                    //seta o valor do item pai encontrado na variável
                                    $id_pai = reset($arr_pai)['id'];
                                }
                            }

                            //seta o pai do item
                            $planoItem->setFkAcaoItem($id_pai);
                        }

                        //salva o item
                        $planoItem->save();

                        //guarda o ID gerado em tela e o ID gravado no BD
                        array_push($array_id_itens,['id_tela'=>$item['id'],'id'=>$planoItem->getId()]);

                        //guarda todos os ID's dos itens relacionados nesse salvamento
                        array_push($array_ids,$planoItem->getId());
                    }
                }

                //percorre os detalhes
                if(!empty($request->detalhe))
                {
                    foreach($request->detalhe as $det)
                    {
                        //recupera as informações do detalhe
                        $det_id = $det['id'];
                        $det_acao = $det['acao'];
                        $det_tipo = $det['tipo'];
                        $det_beneficiario = $det['beneficiario'];
                        $det_descricao = $det['descricao'];
                        $det_unidade = $det['unidade'];
                        $det_qtd = $det['qtd'];
                        $det_vlr = $det['vlr_unitario'];

                        //caso o detalhe tenha sido criado em tela e tenha pelo menos um campo faltando, descarta o detlhe sem salvar
                        if(strrpos($det_id, "x") == true && (empty($det_acao) || empty($det_tipo) || empty($det_beneficiario) || empty($det_descricao) || empty($det_unidade) || empty($det_qtd) || empty($det_vlr)))
                        {
                            continue;
                        }

                        //verifica se a ação foi criada em tela
                        if(strrpos($det_acao, "x") == true)
                        {
                            //procura o ID da ação salvo no banco pelo ID gerado em tela
                            $arr_acao_id = array_filter($array_id_itens,function($var) use($det_acao){return $var['id_tela'] == $det_acao;});

                            //caso tenha encontrado o id do banco pelo id da tela no array
                            if($arr_acao_id != null)
                            {
                                //seta o valor da ação encontrado na variável em tela
                                $det_acao = reset($arr_acao_id)['id'];
                            }
                        }


                        //busca o detalhe para atualizar ou criar novo detalhe
                        $detalhe = PlanoAcaoItemDetalhe::findOrNew((strrpos($det_id, "x") == true ? null : $det_id));
                        $detalhe->setFkAcaoItem($det_acao);
                        $detalhe->setFkTipoCredito($det_tipo);
                        $detalhe->setFkBeneficiario($det_beneficiario);
                        $detalhe->setDescricao($det_descricao);
                        $detalhe->setUnidade($det_unidade);
                        $detalhe->setQtd($det_qtd);
                        $detalhe->setVlrUnitario(Util::TrataCampoMoeda($det_vlr));
                        $detalhe->setVlrTotal($detalhe->getVlrUnitario() * $detalhe->getQtd());
                        $detalhe->save();

                    }
                }

                //apaga os detalhes dos itens não encontrados na tela
                PlanoAcaoItemDetalhe::whereHas('PlanoAcaoItem',function($item) use($plano)
                {
                    return $item->where(PlanoAcaoItem::$fk_plano,$plano->getId());
                })
                ->whereNotIn(PlanoAcaoItemDetalhe::$fk_acao_item,$array_ids)
                ->delete();

                //apaga os filhos dos itens não encontrados na tela
                PlanoAcaoItem::where(PlanoAcaoItem::$fk_plano,$plano->getId())
                ->whereNotNull(PlanoAcaoItem::$fk_acao_item)
                ->whereNotIn(PlanoAcaoItem::$fk_acao_item,$array_ids)
                ->delete();

                //apaga os itens não encontrados na tela
                PlanoAcaoItem::where(PlanoAcaoItem::$fk_plano,$plano->getId())
                ->whereNotIn(PlanoAcaoItem::$id,$array_ids)
                ->delete();
            }

            /*################### ANEXOS DO PLANO ###################*/
            {
                //guarda o id dos anexos que serão mantidos
                $id_anexos = [];

                //guarda o id dos anexos que serão deletados
                $delete_ids_upload = [];

                //verifica se tem algum anexo em tela
                if(!empty($request->anexo))
                {
                    //percorre os anexos
                    foreach($request->anexo as $anexo)
                    {
                        //guarda os id's dos anexos vinculados
                        array_push($id_anexos,intval($anexo));
                    }

                    //exclui os anexos que foram excluídos em tela
                    $delete_ids_upload = PlanoAcaoAnexo::where(PlanoAcaoAnexo::$fk_plano,$plano->getId())
                        ->where(PlanoAcaoAnexo::$fk_plano,$plano->getId())
                        ->whereNotIn(PlanoAcaoAnexo::$id,$id_anexos)
                        ->pluck(PlanoAcaoAnexo::$id);
                }
                else
                {
                    //exclui todos os anexos
                    $delete_ids_upload = PlanoAcaoAnexo::where(PlanoAcaoAnexo::$fk_plano,$plano->getId())->pluck(PlanoAcaoAnexo::$id);
                }

                //deletar anexos. é feito desse jeito para gerar o histórico
                foreach($delete_ids_upload as $del_id)
                {
                    PlanoAcaoAnexo::find($del_id)->delete();
                }
            }

            Util::Mensagem(MENSAGEM::$SUCESSO,'Dados atualizados com sucesso','Plano de ação '.$plano->getIdentificador().' salvo com sucesso');
            return redirect()->route('planejamento.plano.editar',Util::Criptografa($plano->getId()));
        }
        catch (\Exception $ex)
        {
            return dd($ex);

            Util::Mensagem(MENSAGEM::$ERRO,'Erro',$ex->getMessage());
            return redirect()->route($this->rota);
        }
    }

    /**
     * Gera o PDF do plano de ação
    */
    public function GerarPdfPlanoAcao($id_plano_acao,$anexo)
    {
        try
        {
            $plano = PlanoAcao::find(Util::Decriptografa($id_plano_acao));
            return PDF::loadView('planejamento.pdf_plano_acao',['plano'=>$plano,'anexo'=>$anexo])
              ->setPaper('a4', 'portrait')
              //->setOption('header-html', view('pdf.cabecalho')->render())
              ->setOption('header-right', utf8_decode('[page]'))
              //->setOption('margin-top','50')
              ->stream('plano_de_ação_'.$plano->getIdentificador().'.pdf');

        }
        catch(\Exception $ex)
        {
            Util::Mensagem(MENSAGEM::$ERRO,'Erro',$ex->getMessage());
            return redirect()->route($this->rota);
        }
    }


    public function DeletarPlano(Request $request)
    {
        try
        {
            Util::Mensagem(MENSAGEM::$SUCESSO,'Exclusão realizada com sucesso','');
            return redirect()->route($this->rota);
        }
        catch(\Exception $ex)
        {
            Util::Mensagem(MENSAGEM::$ERRO,'Erro',$ex->getMessage());
            return redirect()->route($this->rota);
        }
    }

    public function AjaxCarregaAcoes(Request $request)
    {
        try
        {
            $acoes = PlanoAcaoItem::where(PlanoAcaoItem::$fk_plano,Util::Decriptografa($request->id_plano))
                ->get()
                ->map(function($item)
                {
                    return
                    [
                        'id'=> $item->getId(),
                        'titulo'=>$item->getTitulo(),
                        'idx'=> $item->getIndex(),
                        'id_pai'=>$item->getFkAcaoItem(),
                        'justificativa'=>$item->getJustificativa(),
                        'indicador'=>Util::IsNull($item->getIndicador(),''),
                        'meta'=> Util::IsNull($item->getMeta(),''),
                        'territorio'=>Util::IsNull($item->getTerritorio(),''),
                        'estrategia'=>Util::IsNull($item->getEstrategia(),''),
                        'objetivo'=>Util::IsNull($item->getObjetivo(),''),
                        'resultado'=>Util::IsNull($item->getResultado(),''),
                        'impacto'=>Util::IsNull($item->getImpacto(),''),
                        'detalhes'=>$item->Detalhes->map(function($detalhe)
                        {
                            return
                            [
                                'id'=>$detalhe->getId(),
                                'fk_grupo_despesa' => $detalhe->getFkTipoCredito(),
                                'fk_beneficiario' => $detalhe->getFkBeneficiario(),
                                'descricao' => $detalhe->getDescricao(),
                                'unidade' => $detalhe->getUnidade(),
                                'qtd' => $detalhe->getQtd(),
                                'vlr_unitario' => $detalhe->getVlrUnitario(),
                            ];
                        }),
                        'valor'=>
                        [
                            'custeio' => $item->ValorTotalDetalhes(TIPO_CREDITO::$CUSTEIO),
                            'investimento' => $item->ValorTotalDetalhes(TIPO_CREDITO::$INVESTIMENTO)
                        ]
                    ];
                });

            return response()->json($acoes,200);
        }
        catch(\Exception $ex)
        {
            return response()->json($ex,500);
        }
    }

    public function AjaxGeraIdentificadorPlano($programa,$eixo)
    {
        try
        {
            $programa = Programa::find($programa);
            $eixo =  Eixo::find($eixo);
            $ano = Carbon::now()->format('Y');
            $qtd = (PlanoAcao::where(PlanoAcao::$fk_eixo,$eixo)->where(PlanoAcao::$ano,$ano)->count() + 1);


            $identificador = ($ano.(!empty($programa) ? $programa->getAbrv() : 'XX') . (!empty($eixo) ? $eixo->getAbrv() : 'XX') . str_pad($qtd, 4, "0", STR_PAD_LEFT));

            return response()->json($identificador,200);
        }
        catch(\Exception $ex)
        {
            return response()->json($ex->getMessage(),500);
        }
    }

    public function ajaxAnexaArquivo(Request $request)
    {
        try
        {
            $anexo = New PlanoAcaoAnexo;
            $anexo->setFkUsuario(auth()->user()->getId());
            $anexo->setFkPlano(!empty($request->fk_plano) ? Util::Decriptografa($request->fk_plano) : null);
            $anexo->setNome($request->nome_upload_plano_acao);
            $anexo->setMensagem($request->comentario_upload_plano_acao);
            $anexo->setArquivo(Util::SalvarArquivo($request->arquivo_upload_plano_acao,'plano_acao_anexos',null));
            $anexo->save();

            return response()->json(
            [
                'id_anexo'=>$anexo->getId(),
                'nome'=>$anexo->getNome(),
                'mensagem'=>$anexo->getMensagem(),
                'arquivo'=>$anexo->getArquivo(),
                'usuario'=>$anexo->Usuario->getNomeCompleto(),
                'data'=>$anexo->getDtCriacao()
            ],200);
        }
        catch(\Exception $ex)
        {
            return response()->json($ex->geMessage(),500);
        }
    }
}
