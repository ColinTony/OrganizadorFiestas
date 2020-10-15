<?php namespace App\Models;

use CodeIgniter\Model;

class EventoModel extends Model
{
    protected $table = 'eventos';
    protected $primaryKey = 'idEvento';
    protected $allowedFields = ['update_at','idUsuario','tipo','nombre','fecha','hora','menu'];
}


?>