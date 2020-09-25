<?php

namespace App\Models\Aporte;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use Carbon\Carbon;

class TipoAporte extends Model
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'aporte_tipo';
    //chave primária da tabela
    protected $primaryKey = 'id';
    public $timestamps = false;


    //campos
    public static $id = 'id';
    public static $descricao ='descricao';

    /* Relacionamentos com outras tabelas */

    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[TipoAporte::$id];}
    public function getDescricao(){return $this->attributes[TipoAporte::$descricao];}

    /* Métodos SET's (informar valor do campo) */
    public function setDescricao($valor){$this->attributes[TipoAporte::$descricao] = $valor;}
}
