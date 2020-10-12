<?php namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Controllers\ManejoDB;

class Dashboard extends BaseController
{
	public function index()
	{	
		$data=[];
		echo view('templates/header',$data);
		echo view('bienvenida');
		echo view('templates/footer');
		
	}

	public function perfil()
	{
		$data = [];
		$model = new UsuarioModel();
		helper(['form']);
		if($this->request->getMethod() == 'post')
		{
			// registro en la base de datos
			// validamos los datos
			$reglas =
			[
				'nombres' => ['rules' =>'required|min_length[3]|max_length[20]','errors'=>[
					'required' => 'El campo nombre no puede estar vacio',
					'min_length'=>'El campo nombre no puede tener menos de 3 caracteres',
					'max_length' =>'El campo nombre no puede tener mas de 20 caracteres'
				]],
				'apeP' => ['rules'=>'required|min_length[3]|max_length[20]','errors'=>[
					'required'=>'No puedes dejar en blanco tu apellido',
					'min_length'=>'Tu apellido debe contener al menos 3 caracteres',
					'max_length'=>'Tu apelllido no puede contener mas de 20 caracteres'
				]],
				'apeM' => ['rules'=>'required|min_length[3]|max_length[20]','errors'=>[
					'required'=>'No puedes dejar en blanco tu apellido',
					'min_length'=>'Tu apellido debe contener al menos 3 caracteres',
					'max_length'=>'Tu apelllido no puede contener mas de 20 caracteres'
				]],
				'tel' => ['rules'=>'required|min_length[10]|max_length[10]','errors'=>[
					'required'=>'Escribe un numero de telefono',
					'min_length'=>'Escribe los 10 digitos de tu telefono',
					'max_length'=>'Escribe los 10 digitos de tu telefono'
				]],
				'email' => ['rules'=>'required|min_length[6]|max_length[50]|valid_email','errors'=>[
					'required'=>'Escribe un correo electronico',
					'min_length'=>'Tu correo electronico no es valido debe contener mas de 6 caracteres',
					'max_length'=>'Escribe un correo electronico valido',
					'valid_email'=>'Escribe un correo electronico valido',
					'is_unique'=>'El correo ingresado ya se encuentra registrado con otro usuario'
				]],
				'usuario' => ['rules'=>'required|min_length[3]|max_length[20]','errors'=>[
					'required'=>'Escribe un nombre de usuario',
					'min_length'=>'Tu nombre de usuario debe tener al menos 3 caracteres',
					'max_length'=>'Tu nombre de usuario no debe exceder los 20 caracteres'
				]]
			];

			if($this->request->getPost('password') != '')
			{
				$reglas['password'] = ['rules'=>'required|min_length[8]|max_length[50]','errors'=>[
					'required'=>'Escribe una cotraseña de 8 o más caracteres',
					'min_length'=>'Tu contraseña debe tener al menos 8 caracteres',
					'max_length'=>'Tu contraseña no debe pasar de los 50 caracteres',
				]];
				$reglas['password_confirm'] = ['rules'=>'matches[password]|required','errors'=>[
					'required'=>'Escribe una cotraseña de 8 o más caracteres',
					'matches' => 'Las contraseñas no coinciden'
				]];
			}
			if(!$this->validate($reglas))
			{
				$data['validation'] = $this->validator;
			}
			else
			{
				// guardamos el usuarios en la base de datos
				$model = new UsuarioModel();
				$newData=[
					'idUsuario' => session()->get('idUsuario'),
					'nombre' => $this->request->getPost('nombres'),
					'apeP' => $this->request->getPost('apeP'),
					'apeM' => $this->request->getPost('apeM'),
					'tel' => $this->request->getPost('tel'),
					'correo' => $this->request->getPost('email'),
					'usuario' => $this->request->getPost('usuario')
				];
				if($this->request->getPost('password') != '')
				{
					$newData['pass'] = $this->request->getPost('password');
				}
				$model->save($newData);
				/// creando la sesion
				session()->setFlashdata('exito','Datos actualizados');
				return redirect()->to('/dashboard/perfil');
			}
		}

		$data['user'] = $model->where('idUsuario',session()->get('idUsuario'))->first();
		echo view('templates/header',$data);
		echo view('perfil');
		echo view('templates/footer');
	}
	public function eventos()
	{
		$this->verEventos();
	}
	private function verEventos()
	{
		$model = new UsuarioModel();
		$data['user'] = $model->where('idUsuario',session()->get('idUsuario'))->first();
		$manejador = new ManejoDB();
		$result = $manejador->getEventos($data['user']['idUsuario']);
		$data['result'] = $result;
		echo view('templates/header',$data);
		echo view('eventos');
		echo view('templates/footer');
	}
}

?>