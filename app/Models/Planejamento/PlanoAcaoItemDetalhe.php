<?php

namespace App\Models\Planejamento;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use Carbon\Carbon;
use App\Models\Administracao\Corporacao;
use App\Models\Financeiro\GrupoDespesa;

class PlanoAcaoItemDetalhe extends Model
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'plano_acao_item_detalhe';
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
    public static $fk_tipo_credito = 'fk_tipo_credito';
    public static $fk_beneficiario = 'fk_beneficiario';
    public static $descricao = 'descricao';
    public static $unidade = 'unidade';
    public static $qtd = 'qtd';
    public static $vlr_unitario = 'vlr_unitario';
    public static $vlr_total = 'vlr_total';

    /* Relacionamentos com outras tabelas */
    //retorna o item a que pertence
    public function PlanoAcaoItem(){return $this->belongsTo(PlanoAcaoItem::class,PlanoAcaoItemDetalhe::$fk_acao_item);}

    //retorna o beneficiário
    public function Beneficiario(){return $this->belongsTo(Corporacao::class,PlanoAcaoItemDetalhe::$fk_beneficiario);}
    public function GrupoDespesa(){return $this->belongsTo(GrupoDespesa::class,PlanoAcaoItemDetalhe::$fk_tipo_credito);}


    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[PlanoAcaoItemDetalhe::$id];}
    public function getFkAcaoItem(){return $this->attributes[PlanoAcaoItemDetalhe::$fk_acao_item];}
    public function getFkTipoCredito(){return $this->attributes[PlanoAcaoItemDetalhe::$fk_tipo_credito];}
    public function getFkBeneficiario(){return $this->attributes[PlanoAcaoItemDetalhe::$fk_beneficiario];}
    public function getDescricao(){return $this->attributes[PlanoAcaoItemDetalhe::$descricao];}
    public function getUnidade(){return $this->attributes[PlanoAcaoItemDetalhe::$unidade];}
    public function getQtd(){return $this->attributes[PlanoAcaoItemDetalhe::$qtd];}
    public function getVlrUnitario(){return $this->attributes[PlanoAcaoItemDetalhe::$vlr_unitario];}
    public function getVlrTotal(){return $this->attributes[PlanoAcaoItemDetalhe::$vlr_total];}

    /* Métodos SET's (informar valor do campo) */
    public function setFkAcaoItem($valor){$this->attributes[PlanoAcaoItemDetalhe::$fk_acao_item] = $valor;}
    public function setFkTipoCredito($valor){$this->attributes[PlanoAcaoItemDetalhe::$fk_tipo_credito] = $valor;}
    public function setFkBeneficiario($valor){$this->attributes[PlanoAcaoItemDetalhe::$fk_beneficiario] = $valor;}
    public function setDescricao($valor){$this->attributes[PlanoAcaoItemDetalhe::$descricao] = $valor;}
    public function setUnidade($valor){$this->attributes[PlanoAcaoItemDetalhe::$unidade] = $valor;}
    public function setQtd($valor){$this->attributes[PlanoAcaoItemDetalhe::$qtd] = $valor;}
    public function setVlrUnitario($valor){$this->attributes[PlanoAcaoItemDetalhe::$vlr_unitario] = $valor;}
    public function setVlrTotal($valor){$this->attributes[PlanoAcaoItemDetalhe::$vlr_total] = $valor;}
}
