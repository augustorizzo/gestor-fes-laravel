<?php

namespace App\Models\Planejamento;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use Carbon\Carbon;
use App\User;

class UploadPlanoAcao extends Model
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'upload_plano_acao';
    //chave primária da tabela
    protected $primaryKey = 'id';
    //relação dos campos de datas da tabela
    public $dates = ['dt_criacao','dt_alteracao'];

    //campos de datas referentes a criação e atualização do registro (gerenciadas pelo laravel)
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $fk_usuario = 'fk_usuario';
    public static $fk_plano = 'fk_plano';
    public static $mensagem = 'mensagem';
    public static $arquivo = 'arquivo';

    /* Relacionamentos com outras tabelas */
    public function Usuario(){return $this->belongsTo(User::class,UploadPlanoAcao::$fk_usuario);}
    public function PlanoAcao(){return $this->belongsTo(PlanoAcao::class,UploadPlanoAcao::$fk_plano);}

    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[UploadPlanoAcao::$id];}
    public function getFkUsuario(){return $this->attributes[UploadPlanoAcao::$fk_usuario];}
    public function getFkPlano(){return $this->attributes[UploadPlanoAcao::$fk_plano];}
    public function getMensagem(){return $this->attributes[UploadPlanoAcao::$mensagem];}
    public function getArquivo(){return $this->attributes[UploadPlanoAcao::$arquivo];}

    /* Métodos SET's (informar valor do campo) */
    public function setFkUsuario($valor){$this->attributes[UploadPlanoAcao::$fk_usuario] = $valor;}
    public function setFkPlano($valor){$this->attributes[UploadPlanoAcao::$fk_plano] = $valor;}
    public function setMensagem($valor){$this->attributes[UploadPlanoAcao::$mensagem] = $valor;}
    public function setArquivo($valor){$this->attributes[UploadPlanoAcao::$arquivo] = $valor;}

}
