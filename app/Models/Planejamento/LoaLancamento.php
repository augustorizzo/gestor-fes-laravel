<?php

namespace App\Models\Planejamento;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use Carbon\Carbon;

class LoaLancamento extends Model
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'loa_lancamento';
    //chave primária da tabela
    protected $primaryKey = 'id';
    //relação dos campos de datas da tabela
    public $dates = ['dt_criacao','dt_alteracao','dt_disponivel','dt_expiracao','dt_previsao'];
   
    //campos de datas referentes a criação e atualização do registro (gerenciadas pelo laravel)
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $fk_loa = 'fk_loa';
    public static $dt_disponivel = 'dt_disponivel';
    public static $dt_expiracao = 'dt_expiracao';
    public static $dt_previsao = 'dt_previsao';
    public static $valor = 'valor';
    public static $status = 'status';
    
    /* Relacionamentos com outras tabelas */
    //retorna a lei orçamentária a que o registro se refere
    public function Loa(){return $this->belongsTo(Loa::class,LoaLancamento::$fk_loa);}

    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[LoaLancamento::$id];}
    public function getFkLoa(){return $this->attributes[LoaLancamento::$fk_loa];}
    public function getDtDisponivel(){return Util::RetornaDataModel($this->attributes[LoaLancamento::$dt_disponivel]);}
    public function getDtExpiracao(){return Util::RetornaDataModel($this->attributes[LoaLancamento::$dt_expiracao]);}
    public function getDtPrevisao(){return Util::RetornaDataModel($this->attributes[LoaLancamento::$dt_previsao]);}
    public function getValor(){return $this->attributes[LoaLancamento::$valor];}
    public function getStatus(){return $this->attributes[LoaLancamento::$status];}


    /* Métodos SET's (informar valor do campo) */
    public function setFkLoa($valor){$this->attributes[LoaLancamento::$fk_loa] = $valor;}
    public function setDtDisponivel($valor){$this->attributes[LoaLancamento::$dt_disponivel] = Util::SetDataModel($valor);}
    public function setDtExpiracao($valor){$this->attributes[LoaLancamento::$dt_expiracao] = Util::SetDataModel($valor);}
    public function setDtPrevisao($valor){$this->attributes[LoaLancamento::$dt_previsao] = Util::SetDataModel($valor);}
    public function setValor($valor){$this->attributes[LoaLancamento::$valor] = $valor;}
    public function setStatus($valor){$this->attributes[LoaLancamento::$status] = $valor;}
}
