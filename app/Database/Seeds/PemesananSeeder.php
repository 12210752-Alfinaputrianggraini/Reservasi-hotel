<?php

namespace App\Database\Seeds;

use App\Models\PemesananModel;
use CodeIgniter\Database\Seeder;

class PemesananSeeder extends Seeder
{
    public function run()
    {
        $id = (new PemesananModel())->insert([
            'kamar_id' => 'deluxe',
            'tgl_mulai' => '15 oktober 2022',
            'tgl_selesai' => '17 oktober 2022',
            'pemesananStatus_id' => 'jadi',
            'tamu' => 'nama tamu'
        ]);
        echo "hasil id = $id";
    }
}
