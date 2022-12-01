<?php

namespace App\Database\Seeds;

use App\Models\PemesananModel;
use CodeIgniter\Database\Seeder;

class PemesananSeeder extends Seeder
{
    public function run()
    {
        $id = (new PemesananModel())->insert([
            'kamar_id' => '1',
            'tgl_mulai' => '2022-11-02',
            'tgl_selesai' => '2022-11-05',
            'pemesananstatus_id' => '0',
            'tamu_id' => '1'
        ]);
        echo "hasil id = $id";
    }
}
