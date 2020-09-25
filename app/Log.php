<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $connection = 'base';
    protected $table = 'log';
    protected $primaryKey = 'id';
    protected $dates = ['data','dt_criacao','dt_alteracao'];
   
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $fk_sistema = 'fk_sistema';
    public static $fk_usuario = 'fk_usuario';
    public static $descricao = 'descricao';
    public static $data = 'data';
    public static $fk_tipo = 'fk_tipo';
    public static $fk_target = 'fk_target';
    public static $fk_filial = 'fk_filial';
    public static $ip = 'ip';
    public static $status = 'status';

    //relacionamentos
    public function Usuario(){return $this->belongsTo(User::class,Log::$fk_usuario);}
    public function Sistema(){return $this->belongsTo(Sistema::class,Log::$fk_sistema);}
    public function Filial(){return $this->belongsTo(Filial::class,Log::$fk_filial);}
        
    //GET's
    public function getId(){return $this->attributes[Log::$id];}
    public function getDescricao(){return $this->attributes[Log::$descricao];}      
    public function getData(){return $this->attributes[Log::$data];}
    public function getFkSistema(){return $this->attributes[Log::$fk_sistema];}
    public function getFkUsuario(){return $this->attributes[Log::$fk_usuario];}
    public function getFkTipo(){return $this->attributes[Log::$fk_tipo];}
    public function getFkTarget(){return $this->attributes[Log::$fk_target];}
    public function getFkFilial(){return $this->attributes[Log::$fk_filial];}
    public function getIp(){return $this->attributes[Log::$ip];}
    public function getStatus(){return $this->attributes[Log::$status];}

    //SET's
    public function setDescricao($valor){$this->attributes[Log::$descricao] = $valor;}
    public function setData($valor){$this->attributes[Log::$data] = $valor;}
    public function setFkSistema($valor){$this->attributes[Log::$fk_sistema] = $valor;}
    public function setFkUsuario($valor){$this->attributes[Log::$fk_usuario] = $valor;}
    public function setFkTipo($valor){$this->attributes[Log::$fk_tipo] = $valor;}
    public function setFkTarget($valor){$this->attributes[Log::$fk_target] = $valor;}
    public function setFkFilial($valor){$this->attributes[Log::$fk_filial] = $valor;}
    public function setIp($valor){$this->attributes[Log::$ip] = $valor;}
    public function setStatus($valor){$this->attributes[Log::$status] = $valor;}
}
