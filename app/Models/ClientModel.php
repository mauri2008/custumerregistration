<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'clients';
    protected $primaryKey           = 'client_id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';

    protected $allowedFields        = ['client_name'];

    // Dates
    protected $useTimestamps        = false;



}
