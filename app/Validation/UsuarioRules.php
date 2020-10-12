<?php
namespace App\Validation;

use App\Models\UsuarioModel;

class UsuarioRules
{

	public function validateUser(string $str, string $fields, array $data)
	{
		$model = new UsuarioModel();
		$user = $model->where('usuario',$data['usuario'])
				->first();
		
		if(!$user){
			return false;
		}

		return password_verify($data['password'], $user['pass']);
	}
}


?>