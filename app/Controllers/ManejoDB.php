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

	public function getEventos($data)
	{
		$this->sql = "call consultarEventos(?)";
		$sqlExc = $this->db->query($this->sql, $data);
		$result = $sqlExc->getResultArray();
		return $result;
	}

	public function getEventosEsp($usuario,$evento)
	{
		$this->sql = "call consultarEventoEsp(?,?)";
		$sqlExc = $this->db->query($this->sql,[$usuario,$evento]);
		$result = $sqlExc->getResultArray();
		return $result;	
	}
	public function modificarEv($evento)
	{
		$this->sql = "call modificarEvento(?,?,?,?,?,?,?)";
		$sqlExc = $this->db->query($this->sql,[$evento['idUsuario'],$evento['tipo'],$evento['nombre'],$evento['fecha'],$evento['hora'],$evento['menu'],$evento['idEvento']]);
		$result = $sqlExc->getResultArray();
		return $result;	
	}
}



?>