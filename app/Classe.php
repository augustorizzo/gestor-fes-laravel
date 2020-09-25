<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $connection = 'base';
    protected $table = 'classe';
    protected $primaryKey = 'id';
    public $timestamps = false;

    //campos
    public static $id = 'id';
    public static $codigo = 'codigo';
    public static $descricao = 'descricao';
    public static $admin = 'admin';
    public static $fk_sistema = 'fk_sistema';

    //Relacionamento
    public function Sistema(){return $this->belongsTo(Sistema::class,Classe::$fk_sistema);}
    public function Rotas(){return $this->belongsToMany(Rota::class,Classe_Rota::$tabela,Classe_Rota::$fk_classe,Classe_Rota::$fk_rota);}
    public function Permissoes(){return $this->hasMany(Permissao::class,Permissao::$fk_classe);}
    public function RotasMenu()
    {
        return $this->belongsToMany(Rota::class,Classe_Rota::$tabela,Classe_Rota::$fk_classe,Classe_Rota::$fk_rota)
                    ->whereNull(Rota::$fk_rota_pai)
                    ->where(Rota::$menu,true)
                    ->with(['Rotas'=>function($rota)
                    {
                        $rota->whereIn(Rota::$id,$this->Rotas->pluck(Rota::$id)->toArray())->orderby(Rota::$index);
                    }])
                    ->orderby(Rota::$index);
    }

    //atributos
    public function getId(){return $this->attributes[Classe::$id];}
    public function getCodigo(){return $this->attributes[Classe::$codigo];}
    public function getDescricao(){return $this->attributes[Classe::$descricao];}
    public function isAdmin(){return $this->attributes[Classe::$admin];}
    public function getFkSistema(){return $this->attributes[Classe::$fk_sistema];}

    public function setCodigo($valor){$this->attributes[Classe::$codigo] = $valor;}
    public function setDescricao($valor){$this->attributes[Classe::$descricao] = $valor;}
    public function setAdmin($valor){$this->attributes[Classe::$admin] = $valor;}
    public function setFkSistema($valor){$this->attributes[Classe::$fk_sistema] = $valor;}
}
