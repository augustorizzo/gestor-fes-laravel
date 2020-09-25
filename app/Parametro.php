<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
	protected $connection = 'base';
	protected $table = 'parametro';
	protected $primaryKey = 'id';
	public $timestamps = false;

	//campos
	public static $codigo = 'codigo';
	public static $descricao = 'descricao';
	public static $id = 'id';
	public static $valor = 'valor';

	//Get's
	public function getTabela(){return $this->$table;}
	public function getCodigo(){return $this->attributes[Parametro::$codigo];}
	public function getDescricao(){return $this->attributes[Parametro::$descricao];}
	public function getId(){return $this->attributes[Parametro::$id];}
	public function getValor(){return $this->attributes[Parametro::$valor];}

	//Set's
	public function setCodigo($valor){$this->attributes[Parametro::$codigo] = $valor;}
	public function setDescricao($valor){$this->attributes[Parametro::$descricao] = $valor;}
	public function setId($valor){$this->attributes[Parametro::$id] = $valor;}
	public function setValor($valor){$this->attributes[Parametro::$valor] = $valor;}

}