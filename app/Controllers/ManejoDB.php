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
	public function getInvitados($idEv,$idUsu)
	{
		$this->sql = "call verInvitados(?,?)";
		$sqlExc = $this->db->query($this->sql, [$idEv,$idUsu]);
		$result = $sqlExc->getResultArray();
		return $result;
	}
	public function nuevoInvitado($inv)
	{
		$this->sql = "call crearInvitado(?,?,?,?,?,?,?)";
		$sqlExc = $this->db->query($this->sql,[$inv['idEvento'],$inv['idUsuario'],$inv['numMesa'],$inv['nombre'],$inv['apeP'],$inv['apeM'],$inv['correo']]);
		$result = $sqlExc->getResultArray();
		return $result;	
	}
	public function cupoMesa($mesa,$idUsu,$idEv)
	{
		$this->sql = "select count(*) as num from invitados where numMesa = ? and invitados.idUsuario = ? and invitados.idEvento = ?";
		$sqlExc = $this->db->query($this->sql,[$mesa,$idUsu,$idEv]);
		$result = $sqlExc->getResultArray();
		return $result;	
	}
	public function getInvMesa($mesa,$idUsu,$idEvento)
	{
		$this->sql = "select * from invitados where numMesa = ? and invitados.idUsuario=? and invitados.idEvento = ?";
		$sqlExc = $this->db->query($this->sql,[$mesa,$idUsu,$idEvento]);
		$result = $sqlExc->getResultArray();
		return $result;	
	}
	public function getInvitado($idInv,$idUsu)
	{
		$this->sql = "select * from invitados where idInvitado = ? and invitados.idUsuario=?";
		$sqlExc = $this->db->query($this->sql,[$idInv,$idUsu]);
		$result = $sqlExc->getResultArray();
		return $result;
	}
	public function editarInvitado($idInv)
	{
		$this->sql = "call modificarInvitado(?,?,?,?,?,?)";
		$sqlExc = $this->db->query($this->sql,[$idInv['idInvitado'],$idInv['numMesa'],$idInv['nombre'],$idInv['apeP'],$idInv['apeM'],$idInv['correo']]);
		$result = $sqlExc->getResultArray();
		return $result;
	}

	// funcniones para eliminar
	public function eliminarInv($idEvento,$idInv)
	{
		$this->sql = "call eliminarInvitado(?,?)";
		$sqlExc = $this->db->query($this->sql,[$idEvento,$idInv]);
		$result = $sqlExc->getResultArray();
		return $result;
	}
	public function eliminarEvento($idUsuario,$idEvento)
	{
		$this->sql = "call eliminarEvento(?,?)";
		$sqlExc = $this->db->query($this->sql,[$idEvento,$idUsuario]);
		$result = $sqlExc->getResultArray();
		return $result;
	}
	public function eliminarCuenta($idUsuario)
	{
		$this->sql = "delete from usuarios where usuarios.idUsuario = ?";
		$sqlExc = $this->db->query($this->sql,$idUsuario);
		$result = $sqlExc->getResultArray();
		return $result;
	}
}



?>