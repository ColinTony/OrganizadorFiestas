<?php namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\InvitadoModel;
use App\Models\EventoModel;
use App\Controllers\ManejoDB;
use App\Libraries\PdfGen;

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
				'tel' => ['rules'=>'required|min_length[10]|max_length[10]|numeric','errors'=>[
					'required'=>'Escribe un numero de telefono',
					'numeric' => 'Teclea un telefono valido (solo numeros)',
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

	public function nuevo_evento()
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
				'idUsuario' =>['rules' => 'required'],
				'nombre' => ['rules' =>'required|min_length[3]|max_length[15]','errors'=>[
					'required' => 'El campo nombre no puede estar vacio',
					'min_length'=>'El campo nombre no puede tener menos de 3 caracteres',
					'max_length' =>'El campo nombre no puede tener mas de 20 caracteres'
				]],
				'tipo' => ['rules'=>'required','errors'=>[
					'required'=>'No puedes dejar en blanco tu apellido',
					'min_length'=>'Tu apellido debe contener al menos 3 caracteres',
					'max_length'=>'Tu apelllido no puede contener mas de 20 caracteres'
				]],
				'date' => ['rules'=>'required','errors'=>[
					'required'=>'No puedes dejar en blanco tu apellido',
					'data_valid'=>'Debes elegir una fecha valida'
				]],
				'hora' => ['rules'=>'required','errors'=>[
					'required'=>'Escribe un numero de telefono',
				]],
				'menu' => ['rules'=>'required','errors'=>[
					'required'=>'Escribe un correo electronico'
				]]
			];
			if(!$this->validate($reglas))
			{
				$data['validation'] = $this->validator;
			}
			else
			{
				// guardamos el usuarios en la base de datos
				$model = new EventoModel();
				$newData=[
					'idUsuario' => $this->request->getVar('idUsuario'),
					'nombre' => $this->request->getVar('nombre'),
					'tipo' => $this->request->getVar('tipo'),
					'fecha' => $this->request->getVar('date'),
					'hora' => $this->request->getVar('hora'),
					'menu' => $this->request->getVar('menu')
				];
				$model->save($newData);
				/// creando la sesion
				return redirect()->to('/dashboard');
			}
		}
		$data['user'] = $model->where('idUsuario',session()->get('idUsuario'))->first();
		echo view('templates/header',$data);
		echo view('nuevo_evento');
		echo view('templates/footer');
	}

	public function verEvento($id)
	{

		$model = new UsuarioModel();
		$evento = new EventoModel();
		$manejador = new ManejoDB();
		helper(['form']);
		$data['user'] = $model->where('idUsuario',session()->get('idUsuario'))->first();
		$result = $manejador->getEventosEsp($data['user']['idUsuario'],$id);
		$data['evento'] = $result;
		$result = $manejador->getInvMesa(1,session()->get('idUsuario'),$id);
		$data['mesa1'] = $result;
		$result = $manejador->getInvMesa(2,session()->get('idUsuario'),$id);
		$data['mesa2'] = $result;;
		$result = $manejador->getInvMesa(3,session()->get('idUsuario'),$id);
		$data['mesa3'] = $result;;
		$result = $manejador->getInvMesa(4,session()->get('idUsuario'),$id);
		$data['mesa4'] = $result;
		$result = $manejador->getInvMesa(5,session()->get('idUsuario'),$id);
		$data['mesa5'] = $result;
		$result = $manejador->getInvMesa(6,session()->get('idUsuario'),$id);
		$data['mesa6'] = $result;


		echo view('templates/header',$data);
		echo view('ver_evento');
		echo view('templates/footer');
	}
	public function modificarEvento($id)
	{
		$model = new UsuarioModel();
		$evento = new EventoModel();
		$manejador = new ManejoDB();
		helper(['form']);
		$data['user'] = $model->where('idUsuario',session()->get('idUsuario'))->first();
		$result = $manejador->getEventosEsp($data['user']['idUsuario'],$id);
		$data['evento'] = $result;

		echo view('templates/header',$data);
		echo view('editar_evento');
		echo view('templates/footer');
	}

	public function generate_pdf()
	{
		$model = new UsuarioModel();
		$evento = new EventoModel();
		$manejador = new ManejoDB();
		helper(['form']);
		$data['user'] = $model->where('idUsuario',session()->get('idUsuario'))->first();
		$result = $manejador->getEventosEsp($data['user']['idUsuario'],$this->request->getVar('idEvento'));
		$data['evento'] = $result;
		$result = $manejador->getInvMesa(1,session()->get('idUsuario'));
		$data['mesa1'] = $result;
		$result = $manejador->getInvMesa(2,session()->get('idUsuario'));
		$data['mesa2'] = $result;;
		$result = $manejador->getInvMesa(3,session()->get('idUsuario'));
		$data['mesa3'] = $result;;
		$result = $manejador->getInvMesa(4,session()->get('idUsuario'));
		$data['mesa4'] = $result;
		$result = $manejador->getInvMesa(5,session()->get('idUsuario'));
		$data['mesa5'] = $result;
		$result = $manejador->getInvMesa(6,session()->get('idUsuario'));
		$data['mesa6'] = $result;

		if($this->request->getMethod() == 'post')
		{
			$pdf = new PdfGen();

			$html = view('pdfGen_evento',$data);

			$filename = 'evento_info';

			$pdf->generate($html,$filename,true,'Letter');

			return redirect()->to('/dashboard/eventos');
		}
		echo view('templates/header');
		echo view('ver_evento',$data);
		echo view('templates/footer');
		return redirect()->to('/');
	}
	
	public function modificarEv()
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
				'idUsuario' =>['rules' => 'required'],
				'nombre' => ['rules' =>'required|min_length[3]|max_length[15]','errors'=>[
					'required' => 'El campo nombre no puede estar vacio',
					'min_length'=>'El campo nombre no puede tener menos de 3 caracteres',
					'max_length' =>'El campo nombre no puede tener mas de 20 caracteres'
				]],
				'tipo' => ['rules'=>'required','errors'=>[
					'required'=>'No puedes dejar en blanco tu apellido',
					'min_length'=>'Tu apellido debe contener al menos 3 caracteres',
					'max_length'=>'Tu apelllido no puede contener mas de 20 caracteres'
				]],
				'date' => ['rules'=>'required','errors'=>[
					'required'=>'No puedes dejar en blanco tu apellido',
					'data_valid'=>'Debes elegir una fecha valida'
				]],
				'hora' => ['rules'=>'required','errors'=>[
					'required'=>'Escribe un numero de telefono',
				]],
				'menu' => ['rules'=>'required','errors'=>[
					'required'=>'Escribe un correo electronico'
				]]
			];
			if(!$this->validate($reglas))
			{
				$data['validation'] = $this->validator;
			}
			else
			{
				// guardamos el usuarios en la base de datos
				$manejador = new ManejoDB();
				$model = new EventoModel();
				$newData=[
					'idEvento' => $this->request->getVar('idEvento'),
					'idUsuario' => $this->request->getVar('idUsuario'),
					'nombre' => $this->request->getVar('nombre'),
					'tipo' => $this->request->getVar('tipo'),
					'fecha' => $this->request->getVar('date'),
					'hora' => $this->request->getVar('hora'),
					'menu' => $this->request->getVar('menu')
				];
				$result = $manejador->modificarEv($newData);
				/// creando la session_name()
				return redirect()->to('/dashboard/eventos');
			}
		}
		$data['user'] = $model->where('idUsuario',session()->get('idUsuario'))->first();
		echo view('templates/header',$data);
		echo view('editar_evento');
		echo view('templates/footer');
	}
	public function invitados($id)
	{
		$model = new UsuarioModel();
		$manejador = new ManejoDB();
		helper(['form']);
		$data['user'] = $model->where('idUsuario',session()->get('idUsuario'))->first();
		$result = $manejador->getInvitados($id,$data['user']['idUsuario']);
		$data['result'] = $result;
		$data['idEvento']=$id;
		$result = $manejador->getInvitados($id,$data['user']['idUsuario']);
		 
		echo view('templates/header',$data);
		echo view('crear_invitados');
		echo view('templates/footer');
	}
	public function nuevoInvitado()
	{
		$data = [];
		$manejador = new ManejoDB();
		$model = new UsuarioModel();
		$invitado = new InvitadoModel();
		$data['user'] = $model->where('idUsuario',session()->get('idUsuario'))->first();
		helper(['form']);
		if($this->request->getMethod() == 'post')
		{
			// registro en la base de datos
			// validamos los datos
			$reglas =
			[
				'idUsuario' => ['rules'=>'required'],
				'nombre' => ['rules' =>'required|min_length[3]|max_length[20]','errors'=>[
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
				'mesa' => ['rules'=>'required|numeric|validar_cupo[mesa,idUsuario]','errors'=>[
					'required'=>'Selecciona una mesa',
					'numeric' => 'Selecciona una mesa',
					'validar_cupo' => 'La mesa solo puede tener 8 invitados'
				]],
				'email' => ['rules'=>'required|min_length[6]|max_length[50]|valid_email','errors'=>[
					'required'=>'Escribe un correo electronico',
					'min_length'=>'Tu correo electronico no es valido debe contener mas de 6 caracteres',
					'max_length'=>'Escribe un correo electronico valido',
					'valid_email'=>'Escribe un correo electronico valido'
				]]
			];

			if(!$this->validate($reglas))
			{
				$data['validation'] = $this->validator;
			}
			else
			{
				// guardamos el usuarios en la base de datos
				$invitado = new InvitadoModel();
				$invitado=[
					'idEvento' => $this->request->getPost('idEvento'),
					'idUsuario' => session()->get('idUsuario'),
					'nombre' => $this->request->getPost('nombre'),
					'apeP' => $this->request->getPost('apeP'),
					'apeM' => $this->request->getPost('apeM'),
					'correo' => $this->request->getPost('email'),
					'numMesa' => $this->request->getPost('mesa')
				];
				$manejador->nuevoInvitado($invitado);
				return redirect()->to('/dashboard/eventos/invitados/'.$invitado['idEvento']);
			}
			$data['user'] = $model->where('idUsuario',session()->get('idUsuario'))->first();
			$result = $manejador->getInvitados($this->request->getPost('idEvento'),$data['user']['idUsuario']);
			$data['result'] = $result;
			$data['idEvento']=$this->request->getPost('idEvento');
			echo view('templates/header',$data);
			echo view('crear_invitados');
			echo view('templates/footer'); 
		}
	}
	public function modificarInv($idInv,$idEvento)
	{
		$data = [];
		$manejador = new ManejoDB();
		$model = new UsuarioModel();
		$invitado = new InvitadoModel();
		$data['user'] = $model->where('idUsuario',session()->get('idUsuario'))->first();
		helper(['form']);

		if($this->request->getMethod() == 'post')
		{
			// registro en la base de datos
			// validamos los datos
			$reglas =
			[
				'idUsuario' => ['rules'=>'required'],
				'nombre' => ['rules' =>'required|min_length[3]|max_length[20]','errors'=>[
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
				'mesa' => ['rules'=>'required|numeric|validar_cupo[mesa,idUsuario]','errors'=>[
					'required'=>'Selecciona una mesa',
					'numeric' => 'Selecciona una mesa',
					'validar_cupo' => 'La mesa solo puede tener 8 invitados'
				]],
				'email' => ['rules'=>'required|min_length[6]|max_length[50]|valid_email','errors'=>[
					'required'=>'Escribe un correo electronico',
					'min_length'=>'Tu correo electronico no es valido debe contener mas de 6 caracteres',
					'max_length'=>'Escribe un correo electronico valido',
					'valid_email'=>'Escribe un correo electronico valido'
				]]
			];

			if(!$this->validate($reglas))
			{
				$data['validation'] = $this->validator;
			}
			else
			{
				$invitado=[
					'idInvitado' => $idInv,
					'idEvento' => $this->request->getPost('idEvento'),
					'idUsuario' => session()->get('idUsuario'),
					'nombre' => $this->request->getPost('nombre'),
					'apeP' => $this->request->getPost('apeP'),
					'apeM' => $this->request->getPost('apeM'),
					'correo' => $this->request->getPost('email'),
					'numMesa' => $this->request->getPost('mesa')
				];
				$manejador->editarInvitado($invitado);
				return redirect()->to('/dashboard/eventos/invitados/'.$invitado['idEvento']);
			}
			$data['user'] = $model->where('idUsuario',session()->get('idUsuario'))->first();
			$data['invitado'] = $invitado->where('idInvitado',$idInv)->first();
			echo view('templates/header',$data);
			echo view('editar_invitado');
			echo view('templates/footer');
		} 

		if($this->request->getMethod() == 'get')
		{
			$data['user'] = $model->where('idUsuario',session()->get('idUsuario'))->first();
			$data['invitado'] = $invitado->where('idInvitado',$idInv)->first();
			echo view('templates/header',$data);
			echo view('editar_invitado');
			echo view('templates/footer');
		}
	}
	public function eliminarInv($idInv,$idEvento)
	{
		$manejador = new ManejoDB();
		$result = $manejador->eliminarInv($idEvento,$idInv);
		return redirect()->to('/dashboard/eventos/invitados/'.$idEvento);
	}
	public function eliminarEvento($idEvento)
	{
		$manejador = new ManejoDB();
		$result = $manejador->eliminarEvento(session()->get('idUsuario'),$idEvento);
		return redirect()->to('/dashboard/eventos');
	}
	public function eliminarCuenta()
	{
		$manejador = new ManejoDB();
		$result = $manejador->eliminarCuenta(session()->get('idUsuario'));
		session()->destroy();
		return redirect()->to('/');
	}
	
	// modulo de organizacion
	public function organizar($idEvento)
	{
		$model = new UsuarioModel();
		$evento = new EventoModel();
		$manejador = new ManejoDB();
		helper(['form']);
		$data['user'] = $model->where('idUsuario',session()->get('idUsuario'))->first();
		$result = $manejador->getEventosEsp($data['user']['idUsuario'],$idEvento);
		$data['evento'] = $result;
		$result = $manejador->getInvMesa(1,session()->get('idUsuario'),$idEvento);
		$data['mesa1'] = $result;
		$result = $manejador->getInvMesa(2,session()->get('idUsuario'),$idEvento);
		$data['mesa2'] = $result;;
		$result = $manejador->getInvMesa(3,session()->get('idUsuario'),$idEvento);
		$data['mesa3'] = $result;;
		$result = $manejador->getInvMesa(4,session()->get('idUsuario'),$idEvento);
		$data['mesa4'] = $result;
		$result = $manejador->getInvMesa(5,session()->get('idUsuario'),$idEvento);
		$data['mesa5'] = $result;
		$result = $manejador->getInvMesa(6,session()->get('idUsuario'),$idEvento);
		$data['mesa6'] = $result;
		$data['evento'] = $evento->where('idEvento',$idEvento)->first();

		echo view('templates/header2',$data);
		echo view('drag_and_drop');
		echo view('templates/footer2');


	}

}
?>