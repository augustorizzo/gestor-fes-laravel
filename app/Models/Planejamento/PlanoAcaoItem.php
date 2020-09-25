<?php

namespace App\Models\Planejamento;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use Carbon\Carbon;

class PlanoAcaoItem extends Model
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'plano_acao_item';
    //chave primária da tabela
    protected $primaryKey = 'id';
    //relação dos campos de datas da tabela
    public $dates = ['dt_criacao','dt_alteracao'];

    //campos de datas referentes a criação e atualização do registro (gerenciadas pelo laravel)
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $fk_plano = 'fk_plano';
    public static $fk_acao_item = 'fk_acao_item';
    public static $index = 'idx';
    public static $titulo = 'titulo';
    public static $justificativa = 'justificativa';
    public static $indicador = 'indicador';
    public static $meta = 'meta';
    public static $territorio = 'territorio';
    public static $estrategia = 'estrategia';
    public static $objetivo = 'objetivo';
    public static $resultado = 'resultado';
    public static $impacto = 'impacto';


    public static $status = 'status';

    /* Relacionamentos com outras tabelas */
    //retorna o plano à qual este item se refere
    public function Plano(){return $this->belongsTo(PlanoAcao::class,PlanoAcaoItem::$fk_plano);}

    //retorna o item da ação pai deste item, no caso do item atual ser um sub item
    public function ItemPai(){return $this->belongsTo(PlanoAcaoItem::class,PlanoAcaoItem::$fk_acao_item);}

    //retorna os itens filhos do item
    public function Itens(){return $this->hasMany(PlanoAcaoItem::class,PlanoAcaoItem::$fk_acao_item);}

    //retorna os detalhes
    public function Detalhes(){return $this->hasMany(PlanoAcaoItemDetalhe::class,PlanoAcaoItemDetalhe::$fk_acao_item);}

    //Retorna valor total dos detlahes
    public function ValorTotalDetalhes($tipo_credito = null)
    {
        if(!empty($tipo_credito))
        {
            return $this->Detalhes->where(PlanoAcaoItemDetalhe::$fk_tipo_credito,$tipo_credito)->sum(PlanoAcaoItemDetalhe::$vlr_total);
        }
        else
        {
            return $this->Detalhes->sum(PlanoAcaoItemDetalhe::$vlr_total);
        }
    }

    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[PlanoAcaoItem::$id];}
    public function getFkPlano(){return $this->attributes[PlanoAcaoItem::$fk_plano];}
    public function getFkAcaoItem(){return $this->attributes[PlanoAcaoItem::$fk_acao_item];}
    public function getIndex(){return $this->attributes[PlanoAcaoItem::$index];}
    public function getTitulo(){return $this->attributes[PlanoAcaoItem::$titulo];}
    public function getJustificativa(){return $this->attributes[PlanoAcaoItem::$justificativa];}
    public function getMeta(){return $this->attributes[PlanoAcaoItem::$meta];}
    public function getIndicador(){return $this->attributes[PlanoAcaoItem::$indicador];}
    public function getTerritorio(){return $this->attributes[PlanoAcaoItem::$territorio];}
    public function getEstrategia(){return $this->attributes[PlanoAcaoItem::$estrategia];}
    public function getObjetivo(){return $this->attributes[PlanoAcaoItem::$objetivo];}
    public function getResultado(){return $this->attributes[PlanoAcaoItem::$resultado];}
    public function getImpacto(){return $this->attributes[PlanoAcaoItem::$impacto];}
    public function getStatus(){return $this->attributes[PlanoAcaoItem::$status];}

    /* Métodos SET's (informar valor do campo) */
    public function setFkPlano($valor){$this->attributes[PlanoAcaoItem::$fk_plano] = $valor;}
    public function setFkAcaoItem($valor){$this->attributes[PlanoAcaoItem::$fk_acao_item] = $valor;}
    public function setIndex($valor){$this->attributes[PlanoAcaoItem::$index] = $valor;}
    public function setTitulo($valor){$this->attributes[PlanoAcaoItem::$titulo] = $valor;}
    public function setJustificativa($valor){$this->attributes[PlanoAcaoItem::$justificativa] = $valor;}
    public function setIndicador($valor){$this->attributes[PlanoAcaoItem::$indicador] = $valor;}
    public function setMeta($valor){$this->attributes[PlanoAcaoItem::$meta] = $valor;}
    public function setTerritorio($valor){$this->attributes[PlanoAcaoItem::$territorio] = $valor;}
    public function setEstrategia($valor){$this->attributes[PlanoAcaoItem::$estrategia] = $valor;}
    public function setObjetivo($valor){$this->attributes[PlanoAcaoItem::$objetivo] = $valor;}
    public function setResultado($valor){$this->attributes[PlanoAcaoItem::$resultado] = $valor;}
    public function setImpacto($valor){$this->attributes[PlanoAcaoItem::$impacto] = $valor;}
    public function setStatus($valor){$this->attributes[PlanoAcaoItem::$status] = $valor;}
}
