<?php

namespace App\Database\Seeds;

use App\Models\KamartipeModel;
use CodeIgniter\Database\Seeder;

class KamartipeSeeder extends Seeder
{
    public function run()
    {
        $id = (new KamartipeModel())->insert([
            'tipe' => 'deluxe',
            'keterangan' => 'besar',
            'urutan' => 'pertama',
            'aktif' => 'Y',
            'gambar' => 'foto kamar',
        ]);
        echo "hasil id = $id";
    }
}
