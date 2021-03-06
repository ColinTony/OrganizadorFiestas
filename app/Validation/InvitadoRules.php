<?php
namespace App\Validation;
use App\Models\InvitadoModel;
use App\Controllers\ManejoDB;
class InvitadoRules
{

	public function validar_cupo(string $str, string $fields, array $data)
	{
		$invitado = new InvitadoModel();
		$manejador = new ManejoDB();

		$result = $manejador->cupoMesa($data['mesa'],$data['idUsuario'],$data['idEvento']);
		$result = intval($result[0]['num']);
		if($result < 8 )
			return true;
		else
			return false;
	}
}


?>