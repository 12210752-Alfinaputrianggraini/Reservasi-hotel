<?php

namespace App\Database\Seeds;

use App\Models\KamarModel;
use CodeIgniter\Database\Seeder;

class KamarSeeder extends Seeder
{
    public function run()
    {
        $id = (new KamarModel())->insert([
            'kamartipe_id' => '1',
            'lantai' => 'marmer',
            'nomor' => '401',
            'kamarstatus_id' => '1',
            'deskripsi' => 'kamar sudah dipersiapakan',
        ]);
        echo "hasil id = $id";
    }
}
