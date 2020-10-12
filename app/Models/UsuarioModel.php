<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuario';
    protected $allowedFields = ['update_at','usuario','nombre','apeP','apeM','tel','correo','pass'];
    protected $beforeInsert=['beforeInsert'];
    protected $beforeUpdate=['beforeUpdate'];

    protected function beforeInsert (array $data)
    {
        $data = $this->passHash($data);
        return $data;
    }

    protected function beforeUpdate (array $data)
    {
        $data = $this->passHash($data);
        return $data;
    }

    protected function passHash(array $data)
    {
        if(isset($data['data']['pass']))
            $data['data']['pass'] = password_hash($data['data']['pass'],PASSWORD_DEFAULT);
        return $data;
    }
}


?>