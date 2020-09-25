<?php

namespace App\Models\Aporte;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use Carbon\Carbon;
use App\Models\Administracao\Eixo;
use App\Models\Financeiro\GrupoDespesa;

class AporteDetalhe extends Model
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'aporte_detalhe';
    //chave primária da tabela
    protected $primaryKey = 'id';
    //relação dos campos de datas da tabela
    public $dates = ['dt_criacao','dt_alteracao'];

    //campos de datas referentes a criação e atualização do registro (gerenciadas pelo laravel)
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $fk_aporte = 'fk_aporte';
    public static $fk_eixo = 'fk_eixo';
    public static $fk_categoria = 'fk_categoria';
    public static $valor = 'valor';

    /* Relacionamentos com outras tabelas */
    public function Aporte(){return $this->belongsTo(Aporte::class,AporteDetalhe::$fk_aporte);}
    public function Eixo(){return $this->belongsTo(Eixo::class,AporteDetalhe::$fk_eixo);}
    public function Categoria(){return $this->belongsTo(GrupoDespesa::class,AporteDetalhe::$fk_categoria);}

    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[Aporte::$id];}
    public function getFkAporte(){return $this->attributes[AporteDetalhe::$fk_aporte];}
    public function getFkEixo(){return $this->attributes[AporteDetalhe::$fk_eixo];}
    public function getFkCategoria(){return $this->attributes[AporteDetalhe::$fk_categoria];}
    public function getValor(){return $this->attributes[AporteDetalhe::$valor];}

    /* Métodos SET's (informar valor do campo) */
    public function setFkAporte($valor){$this->attributes[AporteDetalhe::$fk_aporte] = $valor;}
    public function setFkEixo($valor){$this->attributes[AporteDetalhe::$fk_eixo] = $valor;}
    public function setFkCategoria($valor){$this->attributes[AporteDetalhe::$fk_categoria] = $valor;}
    public function setValor($valor){$this->attributes[AporteDetalhe::$valor] = $valor;}

}
