<?php

namespace App\Database\Seeds;

use App\Models\PembayaranModel;
use CodeIgniter\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        $id = (new PembayaranModel())->insert([
            'id'=> 1,
            'tgl' => '2022-11-02',
            'tagihan' => '200000',
            'dibayar' => '200000',
            'nama_pembayar' => 'Tia',
            'metodebayar_id' => '1',
            'pengguna_id' => '1',
        ]);
        echo "hasil id = $id";
    }
}
