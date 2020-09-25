<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
	protected $connection = 'base';
	protected $table = 'cidade';
	protected $primaryKey = 'id';
	public $timestamps = false;

	//campos
	public static $id = 'id';
	public static $descricao = 'nome';
	public static $latitude = 'latitude';
	public static $longitude = 'longitude';
	public static $capital = 'eh_capital';
	public static $fk_uf = 'uf';

	//Relacionamentos
	public function Estado(){return $this->belongsTo(Estado::class,Cidade::$fk_uf);}

	//Get's
	public function getTabela(){return $this->$table;}
	public function getId(){return $this->attributes[Cidade::$id];}
	public function getDescricao(){return $this->attributes[Cidade::$descricao];}
	public function getLatitude(){return $this->attributes[Cidade::$latitude];}
	public function getLongitude(){return $this->attributes[Cidade::$longitude];}
	public function getCapital(){return $this->attributes[Cidade::$capital];}
	public function getFkUf(){return $this->attributes[Cidade::$fk_uf];}

	//Set's
	public function setId($valor){$this->attributes[Cidade::$id] = $valor;}
	public function setDescricao($valor){$this->attributes[Cidade::$descricao] = $valor;}
	public function setLatitude($valor){$this->attributes[Cidade::$latitude] = $valor;}
	public function setLongitude($valor){$this->attributes[Cidade::$longitude] = $valor;}
	public function setCapital($valor){$this->attributes[Cidade::$capital] = $valor;}
	public function setFkUf($valor){$this->attributes[Cidade::$fk_uf] = $valor;}
}