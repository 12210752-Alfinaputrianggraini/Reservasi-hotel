<?php

namespace App\Models;

use CodeIgniter\Model;

class KamarDipesanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kamardipesan';
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
        $sq = (new KamarDipesanModel())
                ->join('pemesanan', 'pemesanan_id=pemesanan.id', 'left')
                ->join('kamar', 'pemesanan.kamar_id=kamar.id', 'left')
                ->join('pengguna', 'pengguna_id=pengguna.id', 'left')
                ->select('kamardipesan.*, pemesanan.id as pemesananid, kamar.deskripsi, pengguna.nama_depan')
                ->builder();
        
        $r = db_connect()->newQuery()->fromSubquery($sq, 'tb');
        $r->table = '';
        return $r;
    }
}
