<?php

namespace App\Models\Aporte;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use Carbon\Carbon;

class Aporte extends Model
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'aporte';
    //chave primária da tabela
    protected $primaryKey = 'id';
    //relação dos campos de datas da tabela
    public $dates = ['dt_criacao','dt_alteracao','dt_lancamento','dt_vig_ini','dt_vig_fim'];

    //campos de datas referentes a criação e atualização do registro (gerenciadas pelo laravel)
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $fk_tipo = 'fk_tipo';
    public static $apelido = 'apelido';
    public static $obs ='obs';
    public static $dt_lancamento = 'dt_lancamento';
    public static $dt_vig_ini = 'dt_vig_ini';
    public static $dt_vig_fim = 'dt_vig_fim';
    public static $status = 'status';

    /* Relacionamentos com outras tabelas */
    public function Tipo(){return $this->belongsTo(TipoAporte::class,Aporte::$fk_tipo);}
    public function Detalhes(){return $this->hasMany(AporteDetalhe::class,AporteDetalhe::$fk_aporte);}

    //métodos
    public function ValorTotal(){return $this->Detalhes->Sum(AporteDetalhe::$valor);}
    public function ValorEixo($eixo){return $this->Detalhes->where(AporteDetalhe::$fk_eixo,$eixo)->Sum(AporteDetalhe::$valor);}
    public function DetalhesEixo($eixo){return $this->Detalhes->where(AporteDetalhe::$fk_eixo,$eixo);}

    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[Aporte::$id];}
    public function getFkTipo(){return $this->attributes[Aporte::$fk_tipo];}
    public function getApelido(){return $this->attributes[Aporte::$apelido];}
    public function getObs(){return $this->attributes[Aporte::$obs];}
    public function getDtLancamento(){return Util::RetornaDataModel($this->attributes[Aporte::$dt_lancamento]);}
    public function getDtVigIni(){return Util::RetornaDataModel($this->attributes[Aporte::$dt_vig_ini]);}
    public function getDtVigFim(){return Util::RetornaDataModel($this->attributes[Aporte::$dt_vig_fim]);}
    public function getStatus(){return $this->attributes[Aporte::$status];}

    /* Métodos SET's (informar valor do campo) */
    public function setFkTipo($valor){$this->attributes[Aporte::$fk_tipo] = $valor;}
    public function setApelido($valor){$this->attributes[Aporte::$apelido] = $valor;}
    public function setObs($valor){$this->attributes[Aporte::$obs] = $valor;}
    public function setDtLancamento($valor){$this->attributes[Aporte::$dt_lancamento] = $valor;}
    public function setDtVigIni($valor){$this->attributes[Aporte::$dt_vig_ini] = $valor;}
    public function setDtVigFim($valor){$this->attributes[Aporte::$dt_vig_fim] = $valor;}
    public function setStatus($valor){$this->attributes[Aporte::$status] = $valor;}
}
