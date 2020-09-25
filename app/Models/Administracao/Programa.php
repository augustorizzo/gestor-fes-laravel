<?php

namespace App\Models\Administracao;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use Carbon\Carbon;

class Programa extends Model
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'programa';
    //chave primária da tabela
    protected $primaryKey = 'id';
    //relação dos campos de datas da tabela
    public $dates = ['dt_criacao','dt_alteracao'];
   
    //campos de datas referentes a criação e atualização do registro (gerenciadas pelo laravel)
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $titulo = 'titulo';
    public static $abrv = 'abrv';
    public static $status = 'status';
    
    
    /* Relacionamentos com outras tabelas */
    //eixos do programa
    public function Eixos(){return $this->hasMany(Eixo::class,Eixo::$fk_programa);}


    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[Programa::$id];}
    public function getTitulo(){return $this->attributes[Programa::$titulo];}
    public function getAbrv(){return $this->attributes[Programa::$abrv];}
    public function getStatus(){return $this->attributes[Programa::$status];}

    /* Métodos SET's (informar valor do campo) */
    public function setTitulo($valor){$this->attributes[Programa::$titulo] = $valor;}
    public function setAbrv($valor){$this->attributes[Programa::$abrv] = $valor;}
    public function setStatus($valor){$this->attributes[Programa::$status] = $valor;}
}
