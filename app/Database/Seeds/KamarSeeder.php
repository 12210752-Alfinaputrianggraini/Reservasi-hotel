<?php

namespace App\Database\Seeds;

use App\Models\KamarModel;
use CodeIgniter\Database\Seeder;

class KamarSeeder extends Seeder
{
    public function run()
    {
        $id = (new KamarModel())->insert([
            'kamartipe_id' => 'deluxe',
            'lantai' => 'marmer',
            'nomor' => '401',
            'kamarstatus_id' => 'siap huni',
            'deskripsi' => 'kamar sudah dipersiapakan',
        ]);
        echo "hasil id = $id";
    }
}
