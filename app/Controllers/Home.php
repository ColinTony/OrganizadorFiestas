<?php namespace App\Controllers;

use App\Models\UsuarioModel;

class Home extends BaseController
{
	public function index()
	{	
		$data=[];
		helper(['form']);
		if(session()->get('isLog'))
		{	
			return redirect()->to('dashboard');
		}else
			echo view('index');
	}

	//--------------------------------------------------------------------
	public function registro()
	{
		$data = [];
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
				'tel' => ['rules'=>'required|min_length[10]|max_length[10]|is_unique[usuarios.tel]','errors'=>[
					'required'=>'Escribe un numero de telefono',
					'min_length'=>'Escribe los 10 digitos de tu telefono',
					'max_length'=>'Escribe los 10 digitos de tu telefono',
					'is_unique'=>'El telefono ingresado ya esta registrado con otro usuario'
				]],
				'email' => ['rules'=>'required|min_length[6]|max_length[50]|valid_email|is_unique[usuarios.correo]','errors'=>[
					'required'=>'Escribe un correo electronico',
					'min_length'=>'Tu correo electronico no es valido debe contener mas de 6 caracteres',
					'max_length'=>'Escribe un correo electronico valido',
					'valid_email'=>'Escribe un correo electronico valido',
					'is_unique'=>'El correo ingresado ya se encuentra registrado con otro usuario'
				]],
				'password' => ['rules'=>'required|min_length[8]|max_length[50]','errors'=>[
					'required'=>'Escribe una cotraseña de 8 o más caracteres',
					'min_length'=>'Tu contraseña debe tener al menos 8 caracteres',
					'max_length'=>'Tu contraseña no debe pasar de los 50 caracteres',
				]],
				'usuario' => ['rules'=>'required|min_length[3]|max_length[20]|is_unique[usuarios.usuario]','errors'=>[
					'required'=>'Escribe un nombre de usuario',
					'min_length'=>'Tu nombre de usuario debe tener al menos 3 caracteres',
					'max_length'=>'Tu nombre de usuario no debe exceder los 20 caracteres',
					'is_unique'=>'El nombre de usuario ya esta en uso por favor ingresa otro'
				]]
			];

			if(!$this->validate($reglas))
			{
				$data['validation'] = $this->validator;
			}
			else
			{
				// guardamos el usuarios en la base de datos
				$model = new UsuarioModel();
				$newData=[
					'nombre' => $this->request->getVar('nombres'),
					'apeP' => $this->request->getVar('apeP'),
					'apeM' => $this->request->getVar('apeM'),
					'tel' => $this->request->getVar('tel'),
					'correo' => $this->request->getVar('email'),
					'pass' => $this->request->getVar('password'),
					'usuario' => $this->request->getVar('usuario')
				];
				$model->save($newData);
				/// creando la sesion
				$session = session();
				$session->setFlashdata('exito','Registro exitoso');
				return redirect()->to('/login');
			}
		}
		echo view ('registro', $data);
	}

	public function login()
	{
		$data = [];
		helper(['form']);

		if($this->request->getMethod() == 'post')
		{
			// registro en la base de datos
			// validamos los datos
			$reglas =
			[
				'usuario' => ['rules'=>'required|min_length[3]|max_length[20]','errors'=>[
					'required'=>'Escribe un nombre de usuario',
					'min_length'=>'Tu nombre de usuario debe tener al menos 3 caracteres',
					'max_length'=>'Tu nombre de usuario no debe exceder los 20 caracteres',
				]],
				'password' => ['rules'=>'required|min_length[8]|max_length[50]|validateUser[usuario,password]','errors'=>[
					'required'=>'Escribe tu contraseña',
					'min_length'=>'Tu contraseña debe tener al menos 8 caracteres',
					'max_length'=>'Tu contraseña no debe pasar de los 50 caracteres',
					'validateUser' =>'Usuario o contraseña incorrectos'
				]],
			];

			if(!$this->validate($reglas))
			{
				$data['validation'] = $this->validator;
			}
			else
			{
				$model = new UsuarioModel();
				$user = $model->where('usuario',$this->request->getVar('usuario'))
						->first();

				// creamos nuestra sesion y mandamos otro controlador
				$this->setUsuario($user);
				return redirect()->to('dashboard');
			}
		}
		echo view('login',$data);
	}
	public function cerrar()
	{
		session()->destroy();
		return redirect()->to('/');
	}
	private function setUsuario($user)
	{
		$data=[
			'idUsuario' => $user['idUsuario'],
			'nombre' => $user['nombre'],
			'apeP' => $user['apeP'],
			'apeM' => $user['apeM'],
			'tel' => $user['tel'],
			'correo'=>$user['correo'],
			'pass' =>$user['pass'],
			'usuario'=>$user['usuario'],
			'isLog' => true
		];
		session()->set($data);
		return true;
	}
}
