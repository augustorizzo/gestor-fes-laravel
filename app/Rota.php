<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rota extends Model
{
    protected $connection = 'base';
    protected $table = 'rota';
    protected $primaryKey = 'id';
    public $timestamps = false;

    //campos
    public static $id = 'id';
    public static $fk_sistema = 'fk_sistema';
    public static $fk_rota_pai = 'fk_rota';
    public static $nome = 'nome';
    public static $rota = 'rota';
    public static $menu = 'is_menu';
    public static $icone = 'icone';
    public static $index = 'idex';

    //relacionamentos
    public function Sistema(){return $this->belongsTo(Sistema::class,Rota::$fk_sistema);}
    public function Classes(){return $this->belongsToMany(Classe::class,Classe_Rota::$tabela,Classe_Rota::$fk_rota,Classe_Rota::$fk_classe);}
    public function RotaPai(){return $this->belongsTo(Rota::class,Rota::$fk_rota_pai);}
    public function Rotas(){return $this->hasMany(Rota::class,Rota::$fk_rota_pai)->orderby(Rota::$index);}

    //atributos
    public function getId(){return $this->attributes[Rota::$id];}
    public function getNome(){return $this->attributes[Rota::$nome];}
    public function isMenu(){return $this->attributes[Rota::$menu] == 1;}
    public function getIcone(){return $this->attributes[Rota::$icone];}
    public function getRota(){return $this->attributes[Rota::$rota];}
    public function getFkRotaPai(){return $this->attributes[Rota::$fk_rota_pai];}
    public function getFkSistema(){return $this->attributes[Rota::$fk_sistema];}
    public function getIndex(){return $this->attributes[Rota::$index];}

    public function setNome($valor){$this->attributes[Rota::$nome] = $valor;}
    public function setMenu($valor){$this->attributes[Rota::$menu] = $valor;}
    public function setIcone($valor){$this->attributes[Rota::$icone] = $valor;}
    public function setRota($valor){$this->attributes[Rota::$rota] = $valor;}
    public function setFkRotaPai($valor){$this->attributes[Rota::$fk_rota_pai] = $valor;}
    public function setFkSistema($valor){$this->attributes[Rota::$fk_sistema] = $valor;}
    public function setIndex($valor){$this->attributes[Rota::$index] = $valor;}
}
