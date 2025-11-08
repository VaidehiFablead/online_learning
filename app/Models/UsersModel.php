<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields    = [
        'name',
        'email',
        'password',
        'role',
        'created_at',
        'updated_at'
    ];
    protected $returnType = 'array';
}
