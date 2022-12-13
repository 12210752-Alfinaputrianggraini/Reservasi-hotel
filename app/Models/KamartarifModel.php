<?php

namespace App\Models;

use CodeIgniter\Model;

class KamartarifModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kamartarif';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = true;
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

    public static function view(){
        $sq = (new KamartarifModel())
                ->join('kamartipe', 'kamartipe_id=kamartipe.id', 'left')
                ->join('tipetarif', 'tipetarif_id=tipetarif.id', 'left')
                ->select('kamartarif.*, kamartipe.tipe, tipetarif.tipe as tipetarif')
                ->builder();
        $r = db_connect()->newQuery()->fromSubquery($sq, 'tb');
        $r->table = '';
        return $r;
    }
}

