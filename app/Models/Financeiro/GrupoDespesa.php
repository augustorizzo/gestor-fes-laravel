<?php

namespace App\Models\Financeiro;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use App\User;
use Carbon\Carbon;

class GrupoDespesa extends Model
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'grupo_despesa';
    //chave primária da tabela
    protected $primaryKey = 'id';
    //relação dos campos de datas da tabela
    public $dates = ['dt_criacao','dt_alteracao'];

    //campos de datas referentes a criação e atualização do registro (gerenciadas pelo laravel)
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $descricao ='descricao';
    /* Relacionamentos com outras tabelas */

    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[GrupoDespesa::$id];}
    public function getDescricao(){return $this->attributes[GrupoDespesa::$descricao];}

    /* Métodos SET's (informar valor do campo) */
    public function setDescricao($valor){$this->attributes[GrupoDespesa::$descricao] = $valor;}
}
