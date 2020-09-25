<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemPlano extends Model
{
    protected $connection = 'base';
    protected $table = 'item_plano';
    protected $primaryKey = 'id';
    protected $dates = ['dt_criacao','dt_alteracao'];

    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $descricao = 'descricao';

    //GET's
    public function getId(){return $this->attributes[ItemPlano::$id];}
    public function getDescricao(){return $this->attributes[ItemPlano::$descricao];}

    //SET's
    public function setDescricao($valor){$this->attributes[ItemPlano::$descricao] = $valor;}
}
