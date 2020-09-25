<?php

namespace App\Models\Administracao;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use Carbon\Carbon;

class Eixo extends Model
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'eixo_programa';
    //chave primária da tabela
    protected $primaryKey = 'id';
    //relação dos campos de datas da tabela
    public $dates = ['dt_criacao','dt_alteracao'];
   
    //campos de datas referentes a criação e atualização do registro (gerenciadas pelo laravel)
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $fk_programa = 'fk_programa';
    public static $nome = 'nome';
    public static $abrv = 'abrv';
    public static $status = 'status';
    
    
    /* Relacionamentos com outras tabelas */
    //programa a que o eixo se refere
    public function Programa(){return $this->belongsTo(Programa::class,Eixo::$fk_programa);}


    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[Eixo::$id];}
    public function getFkPrograma(){return $this->attributes[Eixo::$fk_programa];}
    public function getNome(){return $this->attributes[Eixo::$nome];}
    public function getAbrv(){return $this->attributes[Eixo::$abrv];}
    public function getStatus(){return $this->attributes[Eixo::$status];}

    /* Métodos SET's (informar valor do campo) */
    public function setFkPrograma($valor){$this->attributes[Eixo::$fk_programa] = $valor;}
    public function setNome($valor){$this->attributes[Eixo::$nome] = $valor;}
    public function setAbrv($valor){$this->attributes[Eixo::$abrv] = $valor;}
    public function setStatus($valor){$this->attributes[Eixo::$status] = $valor;}
}
