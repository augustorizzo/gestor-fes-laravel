<?php

namespace App\Models\Logs\Planejamento;

use App\Http\Controllers\Auditoria\Planejamento\PlanoAcaoLog;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use Carbon\Carbon;
use App\User;

class LogPlanoAcao extends Model
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'audit_plano_acao';
    //chave primária da tabela
    protected $primaryKey = 'id';
    //relação dos campos de datas da tabela
    public $dates = ['dt_criacao','dt_alteracao'];

    public $fillable = ['fk_usuario','fk_plano','fk_tipo','ip','mensagem','obs'];

    //campos de datas referentes a criação e atualização do registro (gerenciadas pelo laravel)
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $fk_usuario ='fk_usuario';
    public static $fk_plano ='fk_plano';
    public static $fk_tipo ='fk_tipo';
    public static $ip ='ip';
    public static $mensagem ='mensagem';
    public static $obs ='obs';
    public static $dt_criacao ='dt_criacao';
    public static $dt_alteracao ='dt_alteracao';


    public function Usuario(){return $this->belongsTo(User::class,LogPlanoAcao::$fk_usuario);}


    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[LogPlanoAcao::$id];}
    public function getFkUsuario(){return $this->attributes[LogPlanoAcao::$fk_usuario];}
    public function getFkPlano(){return $this->attributes[LogPlanoAcao::$fk_plano];}
    public function getFkTipo(){return $this->attributes[LogPlanoAcao::$fk_tipo];}
    public function getIp(){return $this->attributes[LogPlanoAcao::$ip];}
    public function getMensagem(){return $this->attributes[LogPlanoAcao::$mensagem];}
    public function getObs(){return $this->attributes[LogPlanoAcao::$obs];}
    public function getData(){return Util::RetornaDataHora($this->attributes[LogPlanoAcao::$dt_criacao]);}

    /* Métodos SET's (informar valor do campo) */
    public function setFkUsuario($valor){$this->attributes[LogPlanoAcao::$fk_usuario] = $valor;}
    public function setFkPlano($valor){$this->attributes[LogPlanoAcao::$fk_plano] = $valor;}
    public function setFkTipo($valor){$this->attributes[LogPlanoAcao::$fk_tipo] = $valor;}
    public function setIp($valor){$this->attributes[LogPlanoAcao::$ip] = $valor;}
    public function setMensagem($valor){$this->attributes[LogPlanoAcao::$mensagem] = $valor;}
    public function setObs($valor){$this->attributes[LogPlanoAcao::$obs] = $valor;}
    public function setDtCriacao($valor){$this->attributes[LogPlanoAcao::$dt_criacao] = $valor;}
    public function setDtAlteracao($valor){$this->attributes[LogPlanoAcao::$dt_alteracao] = $valor;}
}
