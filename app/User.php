<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Controllers\Util;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = 'base';
    protected $table = 'usuario';
    protected $hidden = ['remember_token'];
	public $dates = ['dt_criacao','dt_alteracao'];
   
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_alteracao';

    //campos
    public static $id = 'id';
    public static $fk_funcao = 'fk_funcao';
    public static $cpf = 'cpf';
    public static $nome = 'nome';
    public static $sobrenome = 'sobrenome';
    public static $usuario = 'usuario';
    public static $email = 'email';
    public static $tipo = 'tipo';
    public static $ativo = 'ativo';
    public static $foto = 'foto';
    public static $telefone = 'telefone';
    public static $celular = 'celular';
    public static $senha = 'password';
    public static $resetado = 'resetado';
    public static $primeiro_acesso = 'primeiro_acesso';

    //retorna apenas a classe relacionada à filial logada
    public function Classe()
    {
        return $this->belongsToMany(Classe::class,Permissao::$tabela,Permissao::$fk_usuario,Permissao::$fk_classe)
            ->whereHas('Sistema',function($sis)
            {
                $sis->where(Sistema::$codigo,env('APP_SISTEMA'));
            })
            ->whereHas('Permissoes',function($permissao)
            {
               $permissao->where(Permissao::$fk_usuario,$this->attributes[User::$id])
               ->where(Permissao::$fk_filial,Util::GetFilial()->getId());
            });
    }

    //traz a primeira permissao da filial logada
    public function Permissao()
    {
        return Permissao::where(Permissao::$fk_filial,Util::GetFilial()->getId())
            ->where(Permissao::$fk_usuario,$this->attributes[User::$id])
            ->first();
    }

    //traz todas as permissões do usuário no sistema
    public function Permissoes()
    {
        return $this->hasMany(Permissao::class,Permissao::$fk_usuario)
            ->whereHas('Classe',function($classe)
            {
                $classe->whereHas('Sistema',function($sis){$sis->where(Sistema::$codigo,env('APP_SISTEMA'));});
            });
    }

    public function Funcao(){return $this->belongsTo(Cargo::class,User::$fk_funcao);}

    
    public function getId(){return $this->attributes[User::$id];}
    public function getFkFuncao(){return $this->attributes[User::$fk_funcao];}
    public function getCpf(){return $this->attributes[User::$cpf];}
    public function getNome(){return $this->attributes[User::$nome];}
    public function getSobreNome(){return $this->attributes[User::$sobrenome];}
    public function getNomeCompleto(){return $this->attributes[User::$nome] .' '. $this->attributes[User::$sobrenome];}
    public function getUsuario(){return $this->attributes[User::$usuario];}
    public function getEmail(){return $this->attributes[User::$email];}
    public function getTipo(){return $this->attributes[User::$tipo];}
    public function getAtivo(){return $this->attributes[User::$ativo];}
    public function getFoto(){return $this->attributes[User::$foto];}
    public function getTelefone(){return $this->attributes[User::$telefone];}
    public function getCelular(){return $this->attributes[User::$celular];}
    public function getSenha(){return $this->attributes[User::$senha];}
    public function isResetado(){return $this->attributes[User::$resetado];}
    public function isPrimeiroAcesso(){return $this->attributes[User::$primeiro_acesso];}

    public function setFkFuncao($valor){$this->attributes[User::$fk_funcao] = $valor;}
    public function setCpf($valor){$this->attributes[User::$cpf] = $valor;}
    public function setNome($valor){$this->attributes[User::$nome] = $valor;}
    public function setSobreNome($valor){$this->attributes[User::$sobrenome] = $valor;}
    public function setUsuario($valor){$this->attributes[User::$usuario] = $valor;}
    public function setEmail($valor){$this->attributes[User::$email] = $valor;}
    public function setTipo($valor){$this->attributes[User::$tipo] = $valor;}
    public function setAtivo($valor){$this->attributes[User::$ativo] = $valor;}
    public function setFoto($valor){$this->attributes[User::$foto] = $valor;}
    public function setSenha($valor){$this->attributes[User::$senha] = $valor;}
    public function setTelefone($valor){$this->attributes[User::$telefone] = $valor;}
    public function setCelular($valor){$this->attributes[User::$celular] = $valor;}
    public function setIsResetado($valor){$this->attributes[User::$resetado] = $valor;}
    public function setIsPrimeiroAcesso($valor){$this->attributes[User::$primeiro_acesso] = $valor;}
}
