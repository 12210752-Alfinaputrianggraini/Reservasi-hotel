<?php

namespace App\Database\Seeds;

use App\Model\TipeKamarModel;
use App\Models\KamartipeModel;
use CodeIgniter\Database\Seeder;

class KamarTipe extends Seeder
{
    public function run()
    {
        $id = (new KamartipeModel())->insert([
            'kamartipe_id' =>'deluxe',
            'keterangan' =>'tipe deluxe',
            'urutan' =>'2',
            'aktif' =>'Y',
            'gambar' =>'foto',
        ]);
        echo "hasil id = $id";

    }
}
