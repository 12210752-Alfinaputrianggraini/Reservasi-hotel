<?php

namespace App\Database\Seeds;

use App\Models\KamarDipesanModel;
use CodeIgniter\Database\Seeder;

class KamarDipesanSeeder extends Seeder
{
    public function run()
    {
        $id = (new KamarDipesanModel())->insert([
            'pemesanan_id' => 'nama pemesan',
            'kamar_id' => 'deluxe',
            'tarif' => 'harga perkamar',
            'pengguna' => 'nama pengguna',
        ]);
        echo "hasil id = $id";
    }
}
