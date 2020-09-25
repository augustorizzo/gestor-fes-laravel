<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $connection = 'base';
    protected $table = 'unidade';
    protected $primaryKey = 'id';
    protected $dates = ['dt_criacao','dt_alteracao'];

    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $sigla = 'sigla';
    public static $descricao = 'descricao';

    //GET's
    public function getId(){return $this->attributes[Unidade::$id];}
    public function getSigla(){return $this->attributes[Unidade::$sigla];}
    public function getDescricao(){return $this->attributes[Unidade::$descricao];}

    //SET's
    public function setSigla($valor){$this->attributes[Unidade::$sigla] = $valor;}
    public function setDescricao($valor){$this->attributes[Unidade::$descricao] = $valor;}
}
