<?php

namespace App\Database\Seeds;

use App\Models\KamarDipesanModel;
use CodeIgniter\Database\Seeder;

class KamarDipesanSeeder extends Seeder
{
    public function run()
    {
        $id = (new KamarDipesanModel())->insert([
            'pemesanan_id' => '1',
            'kamar_id' => '1',
            'tarif' => '20000',
            'pengguna_id' => '1',
        ]);
        echo "hasil id = $id";
    }
}
