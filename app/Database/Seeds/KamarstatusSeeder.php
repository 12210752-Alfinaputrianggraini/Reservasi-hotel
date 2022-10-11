<?php

namespace App\Database\Seeds;

use App\Models\KamarstatusModel;
use CodeIgniter\Database\Seeder;

class KamarstatusSeeder extends Seeder
{
    public function run()
    {
        $id = (new KamarstatusModel())->insert([
            'status' => 'siap huni',
            'keterangan' => 'kamar sudah disiapkan',
            'urutan' => '3',
            'aktif' => 'Y',
        ]);
        echo "hasil id = $id";
    }
}
