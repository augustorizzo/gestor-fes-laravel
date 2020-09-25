<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe_Rota extends Model_Chave_Composta
{
    protected $connection = 'base';
    protected $table = 'classe_rota';
    protected $primaryKey = ['fk_classe_id','fk_rota_id'];
    public $timestamps = false;

    //campos
    public static $tabela = 'classe_rota';
    public static $fk_classe = 'fk_classe_id';
    public static $fk_rota = 'fk_rota_id';
    public static $rota_padrao = 'padrao';

    //relacionamentos
    public function Rota(){return $this->belongsTo(Rota::class,Classe_Rota::$fk_rota);}
    public function Classe(){return $this->belongsTo(Classe::class,Classe_Rota::$fk_classe);}

    //campos
    public function getFkRota(){return $this->attributes[Classe_Rota::$fk_rota];}
    public function getFkClasse(){return $this->attributes[Classe_Rota::$fk_classe];}


    public function isPadrao(){return $this->attributes[Classe_Rota::$rota_padrao] == 1;}
    public function setFkRota($valor){$this->attributes[Classe_Rota::$fk_rota] = $valor;}
    public function setFkClasse($valor){$this->attributes[Classe_Rota::$fk_classe] = $valor;}
    public function setPadrao($valor){$this->attributes[Classe_Rota::$rota_padrao] = $valor;}
}
