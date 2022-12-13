<?php

namespace App\Models;

use CodeIgniter\Model;

class PemesananModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pemesanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

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
    public static function view(){
        $sq = (new PemesananModel())
                ->join('kamar', 'kamar_id=kamar.id', 'left')
                ->join('pemesananstatus', 'pemesananstatus_id=pemesananstatus.id', 'left')
                ->join('tamu', 'tamu_id=tamu.id', 'left')
                ->select('pemesanan.*, kamar.deskripsi , pemesananstatus.status, tamu.nama_depan')
                ->builder();

        $r = db_connect()->newQuery()->fromSubquery($sq, 'tb');
        $r->table = '';
        return $r;
    }
}
