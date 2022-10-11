<?php

namespace App\Database\Seeds;

use App\Models\PembayaranModel;
use CodeIgniter\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        $id = (new PembayaranModel())->insert([
            'tgl' => '15 oktober 2022',
            'tagihan' => 'yang dibayar',
            'dibayar' => 'lunas',
            'nama_pembayar' => 'nama pengguna',
            'metodebayar_id' => 'trasfer',
            'pengguna_id' => 'nama pengguna',
        ]);
        echo "hasil id = $id";
    }
}
