<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    protected $connection = 'base';
    protected $table = 'filial';
    protected $primaryKey = 'id';
    protected $dates = ['dt_criacao','dt_alteracao'];
   
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $nome = 'nome';
    public static $fk_cidade = 'fk_cidade';
    public static $admin = 'admin';
    public static $ativo = 'ativo';

    //relacionamentos
    public function Cidade(){return $this->belongsTo(Cidade::class,Filial::$fk_cidade);}
        
    //GET's
    public function getId(){return $this->attributes[Filial::$id];}
    public function getNome(){return $this->attributes[Filial::$nome];}
    public function getFkCidade(){return $this->attributes[Filial::$fk_cidade];}
    public function isAdmin(){return $this->attributes[Filial::$admin];}
    public function isAtivo(){return $this->attributes[Filial::$ativo];}

    //SET's
    public function setNome($valor){$this->attributes[Filial::$nome] = $valor;}
    public function setFkCidade($valor){$this->attributes[Filial::$fk_cidade] = $valor;}
    public function setIsAdmin($valor){$this->attributes[Filial::$admin] = $valor;}
    public function setIsAtivo($valor){$this->attributes[Filial::$ativo] = $valor;}
}
