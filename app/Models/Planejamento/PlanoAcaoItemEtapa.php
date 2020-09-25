<?php

namespace App\Models\Planejamento;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use Carbon\Carbon;

class PlanoAcaoItemEtapa extends Model
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
    public static $fk_acao_item = 'fk_acao_item';
    public static $index = 'index';
    public static $descricao = 'descricao';
    public static $status = 'status';
    
    /* Relacionamentos com outras tabelas */
    //retorna o plano à qual este item se refere
    public function Plano(){return $this->belongsTo(PlanoAcao::class,PlanoAcaoItem::$fk_plano);}
    
    //retorna o item da ação pai deste item, no caso do item atual ser um sub item
    public function ItemPai(){return $this->belongsTo(PlanoAcaoItem::class,PlanoAcaoItem::$fk_acao_item);}


    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[PlanoAcaoItemEtapa::$id];}
    public function getFkAcaoItem(){return $this->attributes[PlanoAcaoItemEtapa::$fk_acao_item];}
    public function getIndex(){return $this->attributes[PlanoAcaoItemEtapa::$index];}
    public function getDescricao(){return $this->attributes[PlanoAcaoItemEtapa::$descricao];}
    public function getStatus(){return $this->attributes[PlanoAcaoItemEtapa::$status];}

    /* Métodos SET's (informar valor do campo) */
    public function setFkAcaoItem($valor){$this->attributes[PlanoAcaoItemEtapa::$fk_acao_item] = $valor;}
    public function setIndex($valor){$this->attributes[PlanoAcaoItemEtapa::$index] = $valor;}
    public function setDescricao($valor){$this->attributes[PlanoAcaoItemEtapa::$descricao] = $valor;}
    public function setStatus($valor){$this->attributes[PlanoAcaoItemEtapa::$status] = $valor;}
}
