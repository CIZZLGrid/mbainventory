<?php

namespace App\Models;

use CodeIgniter\Model;

class SimArchive extends Model
{
    protected $table            = 'sims_archive';
    protected $primaryKey       = 'archive_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['original_id', 'added_by', 'edited_by' ,'sim_gateway', 'sim_id', 'sim_no', 'operator', 'gateway', 'ip_address' , 'plan', 'call_to', 'sms_to', 'archived_by', 'archived_at', 
    'created_at', 'updated_at', 'restore_until_utc', 'deleted_at_utc'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
