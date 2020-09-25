<?php

namespace App\Models\Planejamento;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Util;
use Carbon\Carbon;
use App\Models\Administracao\Eixo;
use App\Models\Administracao\Orgao;
use App\User;
use App\Models\Aporte\Aporte;
use App\Models\Logs\Planejamento\LogPlanoAcao;

class PlanoAcao extends Model
{
    //conexão do banco
    protected $connection = 'base';
    //tabela referente
    protected $table = 'plano_acao';
    //chave primária da tabela
    protected $primaryKey = 'id';
    //relação dos campos de datas da tabela
    public $dates = ['dt_criacao','dt_alteracao'];

    //campos de datas referentes a criação e atualização do registro (gerenciadas pelo laravel)
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $fk_eixo = 'fk_eixo';
    public static $fk_orgao = 'fk_orgao';
    public static $fk_responsavel = 'fk_responsavel';
    public static $fk_gestor = 'fk_gestor';
    public static $abreviacao = 'abreviacao';
    public static $numero = 'numero';
    public static $ano = 'ano';
    public static $identificador = 'identificador';
    public static $apelido = 'apelido';
    public static $resumo = 'resumo';
    public static $justificativa = 'justificativa';
    public static $impacto = 'impacto';
    public static $territorio = 'territorio';
    public static $resultado = 'resultado';
    public static $objetivo = 'objetivo';
    public static $estrategia = 'estrategia';
    public static $status = 'status';

    /* Relacionamentos com outras tabelas */
    //retorna o órgão a qual o plano atual está vinculado
    public function Orgao(){return $this->belongsTo(Orgao::class,PlanoAcao::$fk_orgao);}

    //retorna o eixo a qual o plano atual está vinculado
    public function Eixo(){return $this->belongsTo(Eixo::class,PlanoAcao::$fk_eixo);}

    //retorna as ações do plano de ação atual
    public function Acoes(){return $this->hasMany(PlanoAcaoItem::class,PlanoAcaoItem::$fk_plano);}
    public function Responsavel(){return $this->belongsTo(User::class,PlanoAcao::$fk_responsavel);}
    public function Gestor(){return $this->belongsTo(User::class,PlanoAcao::$fk_gestor);}
    public function Aportes(){return $this->belongsToMany(Aporte::class,PlanoAporte::$tabela,PlanoAporte::$fk_plano,PlanoAporte::$fk_aporte);}
    public function Historico(){return $this->hasMany(LogPlanoAcao::class,LogPlanoAcao::$fk_plano)->orderby(LogPlanoAcao::$dt_criacao);}
    public function Anexos(){return $this->hasMany(PlanoAcaoAnexo::class,PlanoAcaoAnexo::$fk_plano);}


    //métodos
    public function Valor()
    {
        $valor = 0.00;

        foreach($this->Acoes as $acao)
        {
            $valor += $acao->ValorTotalDetalhes();
        }

        return $valor;
    }
    public function FkAportes(){return $this->Aportes->pluck(Aporte::$id)->toArray();}

    /* Métodos GET's (resgatar valor do campo)*/
    public function getId(){return $this->attributes[PlanoAcao::$id];}
    public function getFkEixo(){return $this->attributes[PlanoAcao::$fk_eixo];}
    public function getFkOrgao(){return $this->attributes[PlanoAcao::$fk_orgao];}
    public function getFkResponsavel(){return $this->attributes[PlanoAcao::$fk_responsavel];}
    public function getFkGestor(){return $this->attributes[PlanoAcao::$fk_gestor];}
    public function getAbreviacao(){return $this->attributes[PlanoAcao::$abreviacao];}
    public function getNumero(){return $this->attributes[PlanoAcao::$numero];}
    public function getAno(){return $this->attributes[PlanoAcao::$ano];}
    public function getIdentificador(){return $this->attributes[PlanoAcao::$identificador];}
    public function getApelido(){return $this->attributes[PlanoAcao::$apelido];}
    public function getResumo(){return $this->attributes[PlanoAcao::$resumo];}
    public function getJustificativa(){return $this->attributes[PlanoAcao::$justificativa];}
    public function getObjetivo(){return $this->attributes[PlanoAcao::$objetivo];}
    public function getResultado(){return $this->attributes[PlanoAcao::$resultado];}
    public function getTerritorio(){return $this->attributes[PlanoAcao::$territorio];}
    public function getEstrategia(){return $this->attributes[PlanoAcao::$estrategia];}
    public function getImpacto(){return $this->attributes[PlanoAcao::$impacto];}
    public function getStatus(){return $this->attributes[PlanoAcao::$status];}

    /* Métodos SET's (informar valor do campo) */
    public function setFkEixo($valor){$this->attributes[PlanoAcao::$fk_eixo] = $valor;}
    public function setFkOrgao($valor){$this->attributes[PlanoAcao::$fk_orgao] = $valor;}
    public function setFkResponsavel($valor){$this->attributes[PlanoAcao::$fk_responsavel] = $valor;}
    public function setFkGestor($valor){$this->attributes[PlanoAcao::$fk_gestor] = $valor;}
    public function setAbreviacao($valor){$this->attributes[PlanoAcao::$abreviacao] = $valor;}
    public function setNumero($valor){$this->attributes[PlanoAcao::$numero] = $valor;}
    public function setAno($valor){$this->attributes[PlanoAcao::$ano] = $valor;}
    public function setIdentificador($valor){$this->attributes[PlanoAcao::$identificador] = $valor;}
    public function setApelido($valor){$this->attributes[PlanoAcao::$apelido] = $valor;}
    public function setResumo($valor){$this->attributes[PlanoAcao::$resumo] = $valor;}
    public function setJustificativa($valor){$this->attributes[PlanoAcao::$justificativa] = $valor;}
    public function setEstrategia($valor){$this->attributes[PlanoAcao::$estrategia] = $valor;}
    public function setObjetivo($valor){$this->attributes[PlanoAcao::$objetivo] = $valor;}
    public function setResultado($valor){$this->attributes[PlanoAcao::$resultado] = $valor;}
    public function setTerritorio($valor){$this->attributes[PlanoAcao::$territorio] = $valor;}
    public function setImpacto($valor){$this->attributes[PlanoAcao::$impacto] = $valor;}
    public function setStatus($valor){$this->attributes[PlanoAcao::$status] = $valor;}
}
