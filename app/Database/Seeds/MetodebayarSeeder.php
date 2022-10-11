<?php

namespace App\Database\Seeds;

use App\Models\MetodebayarModel;
use CodeIgniter\Database\Seeder;

class MetodebayarSeeder extends Seeder
{
    public function run()
    {
        $id = (new MetodebayarModel())->insert([
            'metode'    =>'cash',
            'aktif' =>'y',
        ]);
        echo "hasil id $id";
    }
}
