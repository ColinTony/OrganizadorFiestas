<?php namespace App\Models;

use CodeIgniter\Model;

class InvitadoModel extends Model
{
    protected $table = 'invitados';
    protected $primaryKey = 'idInvitado';
    protected $allowedFields = ['update_at','idEvento','idUsuario','numMesa','nombre','apeP','apeM','correo'];
}


?>