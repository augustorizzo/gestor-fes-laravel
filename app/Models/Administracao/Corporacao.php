<?php

namespace App\Models\Administracao;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use App\User;
use Carbon\Carbon;

class Corporacao extends Model
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'corporacao';
    //chave primária da tabela
    protected $primaryKey = 'id';
    //relação dos campos de datas da tabela
    public $dates = ['dt_criacao','dt_alteracao'];

    //campos de datas referentes a criação e atualização do registro (gerenciadas pelo laravel)
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $sigla ='sigla';
    public static $nome ='nome';
    public static $logo ='logo';

    /* Relacionamentos com outras tabelas */

    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[Corporacao::$id];}
    public function getSigla(){return $this->attributes[Corporacao::$sigla];}
    public function getNome(){return $this->attributes[Corporacao::$nome];}
    public function getLogo(){return $this->attributes[Corporacao::$logo];}

    /* Métodos SET's (informar valor do campo) */
    public function setSigla($valor){$this->attributes[Corporacao::$sigla] = $valor;}
    public function setNome($valor){$this->attributes[Corporacao::$nome] = $valor;}
    public function setLogo($valor){$this->attributes[Corporacao::$logo] = $valor;}
}
