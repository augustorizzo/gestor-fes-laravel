<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $connection = 'base';
    protected $table = 'permissao';
    protected $primaryKey = 'id';
    protected $dates = ['dt_criacao','dt_alteracao'];
   
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $tabela = 'permissao';
    public static $id = 'id';
    public static $fk_classe = 'fk_classe';
    public static $fk_usuario = 'fk_usuario';
    public static $fk_filial = 'fk_filial';
	public static $fk_cargo = 'fk_cargo';

    //relacionamentos
    public function Usuario(){return $this->belongsTo(User::class,Permissao::$fk_usuario);}
    public function Classe(){return $this->belongsTo(Classe::class,Permissao::$fk_classe);}
    public function Filial(){return $this->belongsTo(Filial::class,Permissao::$fk_filial);}
	public function Cargo(){return $this->belongsTo(Cargo::class,Permissao::$fk_cargo);}

    //Get´s
    public function getId(){return $this->attributes[Permissao::$id];}
    public function getFkUsuario(){return $this->attributes[Permissao::$fk_usuario];}
    public function getFkClasse() {return $this->attributes[Permissao::$fk_classe];}
    public function getFkFilial(){return $this->attributes[Permissao::$fk_filial];}
	public function getFkCargo(){return $this->attributes[Permissao::$fk_cargo];}

    //Set´s
    public function setFkUsuario($valor){$this->attributes[Permissao::$fk_usuario] = $valor;}
    public function setFkClasse($valor) {$this->attributes[Permissao::$fk_classe] = $valor;}
    public function setFkFilial($valor){$this->attributes[Permissao::$fk_filial] = $valor;}
	public function setFkCargo($valor){$this->attributes[Permissao::$fk_cargo] = $valor;}
}
