<?php

namespace App\Models\Planejamento;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use App\Model_Chave_Composta;
use Carbon\Carbon;
use App\Models\Aporte\Aporte;

class PlanoAporte extends Model_Chave_Composta
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'plano_aporte';
    //chave primária da tabela
    protected $primaryKey = ['fk_plano','fk_aporte'];
    //relação dos campos de datas da tabela
    public $dates = ['dt_criacao','dt_alteracao'];
    protected $fillable  = ['fk_plano','fk_aporte'];
    public $incrementing = false;

    //campos de datas referentes a criação e atualização do registro (gerenciadas pelo laravel)
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $tabela = 'plano_aporte';
    public static $fk_plano = 'fk_plano';
    public static $fk_aporte = 'fk_aporte';

    /* Relacionamentos com outras tabelas */
    public function Plano(){return $this->belongsTo(PlanoAcao::class,PlanoAporte::$fk_plano);}
    public function Aporte(){return $this->belongsTo(Aporte::class,PlanoAporte::$fk_aporte);}

    /* Métodos GET's (resgatar valor do campo)*/
    public function getFkPlano(){return $this->attributes[PlanoAporte::$fk_plano];}
    public function getFkAporte(){return $this->attributes[PlanoAporte::$fk_aporte];}

    /* Métodos SET's (informar valor do campo) */
    public function setFkPlano($valor){$this->attributes[PlanoAporte::$fk_plano] = $valor;}
    public function setFkAporte($valor){$this->attributes[PlanoAporte::$fk_aporte] = $valor;}
}
