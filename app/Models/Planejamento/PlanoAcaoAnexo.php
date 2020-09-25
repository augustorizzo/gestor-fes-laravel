<?php

namespace App\Models\Planejamento;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use Carbon\Carbon;
use App\User;

class PlanoAcaoAnexo extends Model
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'plano_acao_anexo';
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
    public static $nome = 'nome';
    public static $mensagem = 'comentario';
    public static $arquivo = 'arquivo';
    public static $dt_criacao = 'dt_criacao';

    /* Relacionamentos com outras tabelas */
    public function Usuario(){return $this->belongsTo(User::class,PlanoAcaoAnexo::$fk_usuario);}
    public function Plano(){return $this->belongsTo(PlanoAcao::class,PlanoAcaoAnexo::$fk_plano);}

    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[PlanoAcaoAnexo::$id];}
    public function getFkUsuario(){return $this->attributes[PlanoAcaoAnexo::$fk_usuario];}
    public function getFkPlano(){return $this->attributes[PlanoAcaoAnexo::$fk_plano];}
    public function getNome(){return $this->attributes[PlanoAcaoAnexo::$nome];}
    public function getMensagem(){return $this->attributes[PlanoAcaoAnexo::$mensagem];}
    public function getArquivo(){return $this->attributes[PlanoAcaoAnexo::$arquivo];}
    public function getDtCriacao(){return Util::RetornaDataModel($this->attributes[PlanoAcaoAnexo::$dt_criacao]);}

    /* Métodos SET's (informar valor do campo) */
    public function setFkUsuario($valor){$this->attributes[PlanoAcaoAnexo::$fk_usuario] = $valor;}
    public function setFkPlano($valor){$this->attributes[PlanoAcaoAnexo::$fk_plano] = $valor;}
    public function setNome($valor){$this->attributes[PlanoAcaoAnexo::$nome] = $valor;}
    public function setMensagem($valor){$this->attributes[PlanoAcaoAnexo::$mensagem] = $valor;}
    public function setArquivo($valor){$this->attributes[PlanoAcaoAnexo::$arquivo] = $valor;}
}
