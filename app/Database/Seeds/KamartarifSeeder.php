<?php

namespace App\Database\Seeds;

use App\Models\KamartarifModel;
use CodeIgniter\Database\Seeder;

class KamartarifSeeder extends Seeder
{
    public function run()
    {
        $r = (new KamartarifModel())->insert([
            'kamartipe_id' => 'deluxe',
            'tarif' => 2000000,
            'tgl_mulai' => '15 oktober 2022',
            'tgl_selesai' => '17 oktober 2022',
            'tipetarif_id' => 4000000,
        ]);
        echo "hasil id = $r";
    }
}
