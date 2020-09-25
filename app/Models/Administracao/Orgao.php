<?php

namespace App\Models\Administracao;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use App\User;
use Carbon\Carbon;

class Orgao extends Model
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'orgao';
    //chave primária da tabela
    protected $primaryKey = 'id';
    //relação dos campos de datas da tabela
    public $dates = ['dt_criacao','dt_alteracao'];
   
    //campos de datas referentes a criação e atualização do registro (gerenciadas pelo laravel)
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $fk_responsavel = 'fk_responsavel';
    public static $fk_gestor = 'fk_gestor';
    public static $sigla = 'sigla';
    public static $descricao = 'descricao';
    public static $cnpj = 'cnpj';
    public static $lei_criacao = 'lei_criacao';
    public static $status = 'status';
    
    
    /* Relacionamentos com outras tabelas */
    //responsável pelo órgão
    public function Responsavel(){return $this->belongsTo(User::class,Orgao::$fk_responsavel);}
    //gestor do fundo - Secretário de Segurança
    public function Gestor(){return $this->belongsTo(User::class,Orgao::$fk_gestor);}


    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[Orgao::$id];}
    public function getFkResponsavel(){return $this->attributes[Orgao::$fk_responsavel];}
    public function getFkGestor(){return $this->attributes[Orgao::$fk_gestor];}
    public function getSigla(){return $this->attributes[Orgao::$sigla];}
    public function getDescricao(){return $this->attributes[Orgao::$descricao];}
    public function getCnpj(){return $this->attributes[Orgao::$cnpj];}
    public function getLeiCriacao(){return $this->attributes[Orgao::$lei_criacao];}
    public function getStatus(){return $this->attributes[Orgao::$status];}

    /* Métodos SET's (informar valor do campo) */
    public function setSigla($valor){$this->attributes[Orgao::$sigla] = $valor;}
    public function setDescricao($valor){$this->attributes[Orgao::$descricao] = $valor;}
    public function setFkResponsavel($valor){$this->attributes[Orgao::$fk_responsavel] = $valor;}
    public function setFkGestor($valor){$this->attributes[Orgao::$fk_gestor] = $valor;}
    public function setCnpj($valor){$this->attributes[Orgao::$cnpj] = $valor;}
    public function setLeiCriacao($valor){$this->attributes[Orgao::$lei_criacao] = $valor;}
    public function setStatus($valor){$this->attributes[Orgao::$status] = $valor;}
}
