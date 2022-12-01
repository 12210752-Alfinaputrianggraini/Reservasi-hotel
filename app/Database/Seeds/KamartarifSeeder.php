<?php

namespace App\Database\Seeds;

use App\Models\KamartarifModel;
use CodeIgniter\Database\Seeder;

class KamartarifSeeder extends Seeder
{
    public function run()
    {
        $r = (new KamartarifModel())->insert([
            'kamartipe_id' => '1',
            'tarif' => 2000000,
            'tgl_mulai' => '2022-11-02',
            'tgl_selesai' => '2022-11-05',
            'tipetarif_id' => '1',
        ]);
        echo "hasil id = $r";
    }
}
