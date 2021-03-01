<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $table = 'status';
    public static $ACTIVE = 1;
    public static $INACTIVE = 2;
    public static $DELETED = 3;
}