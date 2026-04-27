<?php

namespace App\Models;

use CodeIgniter\Model;

class NameModel extends Model
{
    protected $table = 'names';
    protected $primaryKey = 'id';
    protected $allowedFields = ['first_name', 'last_name', 'email', 'password'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
} 