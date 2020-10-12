<?php namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\EventoModel;

class ManejoDB 
{
	private $sql;
	private $db;
	private $isOk;
	private $result;

	function __construct()
	{
		$this->db= \Config\Database::connect();
		$this->sql="";
		$this->isOk =false;
		$this->result = null;
	}

	function getEventos($data)
	{
		$this->sql = "call consultarEventos(?)";
		$sqlExc = $this->db->query($this->sql, $data);
		$result = $sqlExc->getResultArray();
		return $result;
	}
}



?>