<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $connection = 'base';
    protected $table = 'uf';
    protected $primaryKey = 'uf';
    public $timestamps = false;

    //campos
    public static $id = 'uf';
    public static $nome = 'descricao';
    public static $sigla = 'uf';

    //relacionamentos
    public function Cidades(){return $this->hasMany(Cidade::class,Cidade::$fk_estado);}

    //atributos
    public function getId(){return $this->attributes[Estado::$id];}
    public function getNome(){return $this->attributes[Estado::$nome];}
    public function getSigla(){return $this->attributes[Estado::$sigla];}

    public function setNome($valor){$this->attributes[Estado::$nome] = $valor;}
    public function setSigla($valor){$this->attributes[Estado::$sigla] = $valor;}
}
