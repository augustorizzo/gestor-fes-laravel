<?php

namespace App\Models\Planejamento;

use Illuminate\Database\Eloquent\Model_Chave_Composta;
use App\Http\Controllers\Util;
use Carbon\Carbon;

class PlanoAcaoItemBeneficiario extends Model_Chave_Composta
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'loa';
    //chave primária da tabela
    protected $primaryKey = 'id';

    public $timestamps = false;

    //campos
    public static $id = 'id';
    public static $ano = 'ano';
    public static $dt_validade_ini = 'dt_validade_ini';
    public static $dt_validade_fim = 'dt_validade_fim';
    public static $status = 'status';

    /* Relacionamentos com outras tabelas */
    //retorna os lançamentos referentes a este registro
    public function Lancamentos(){return $this->hasMany(LoaLancamento::class,LoaLancamento::$fk_loa);}

    public function ValorDisponivel()
    {
        return $this->Lancamentos//->whereNotNull(LoaLancamento::$dt_disponivel)
                ->where(LoaLancamento::$status,'D')
                ->sum(LoaLancamento::$valor);
    }
    public function ValorPendente()
    {
        return $this->Lancamentos//->whereNull(LoaLancamento::$dt_disponivel)
                ->where(LoaLancamento::$status,'P')
                ->sum(LoaLancamento::$valor);
    }
    public function ValorUtilizado()
    {
        return 0.0;
    }

    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[Loa::$id];}
    public function getAno(){return $this->attributes[Loa::$ano];}
    public function getDtValidadeIni(){return Util::RetornaDataModel($this->attributes[Loa::$dt_validade_ini]);}
    public function getDtValidadeFim(){return Util::RetornaDataModel($this->attributes[Loa::$dt_validade_fim]);}
    public function getStatus(){return $this->attributes[Loa::$status];}


    /* Métodos SET's (informar valor do campo) */
    public function setAno($valor){$this->attributes[Loa::$ano] = $valor;}
    public function setDtValidadeIni($valor){$this->attributes[Loa::$dt_validade_ini] = Util::SetDataModel($valor);}
    public function setDtValidadeFim($valor){$this->attributes[Loa::$dt_validade_fim] = Util::SetDataModel($valor);}
    public function setStatus($valor){$this->attributes[Loa::$status] = $valor;}
}
