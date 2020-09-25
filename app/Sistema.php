<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    protected $connection = 'base';
    protected $table = 'sistema';
    protected $primaryKey = 'id';
    public $timestamps = false;

    //campos
    public static $id = 'id';
    public static $codigo = 'codigo';
    public static $descricao = 'descricao';
    public static $vsistema = 'v_sistema';
    public static $vcore = 'v_core';
    public static $vlayout = 'v_layout';

    public function getId(){return $this->attributes[Sistema::$id];}
    public function getCodigo(){return $this->attributes[Sistema::$codigo];}
    public function getDescricao(){return $this->attributes[Sistema::$descricao];}
    public function getVersaoSistema(){return $this->attributes[Sistema::$vsistema];}
    public function getVersaoCore(){return $this->attributes[Sistema::$vcore];}
    public function getVersaoLayout(){return $this->attributes[Sistema::$vlayout];}

    public function setCodigo($valor){$this->attributes[Sistema::$codigo] = $valor;}
    public function setDescricao($valor){$this->attributes[Sistema::$descricao] = $valor;}
    public function setVersaoSistema($valor){$this->attributes[Sistema::$vsistema] = $valor;}
    public function setVersaoCore($valor){$this->attributes[Sistema::$vcore] = $valor;}
    public function setVersaoLayout($valor){$this->attributes[Sistema::$vlayout] = $valor;}
}
