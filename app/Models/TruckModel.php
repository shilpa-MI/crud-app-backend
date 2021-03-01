<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class TruckModel extends Model
{
    protected $table = 'truck';
    protected $allowedFields = [
        'name',
        'city',
        'state',
        'zip',
        'status_id',
    ];
    protected $updatedField = 'updated_at';

    public function findTruckById($id)
    {
        $truck = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$truck) throw new Exception('Could not find truck for specified ID');

        return $truck;
    }
}