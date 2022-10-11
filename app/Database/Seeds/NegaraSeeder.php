<?php

namespace App\Database\Seeds;

use App\Models\NegaraModel;
use CodeIgniter\Database\Seeder;

class NegaraSeeder extends Seeder
{
    public function run()
    {
        $id = (new NegaraModel())->insert([
            'negara' => 'iINDONESIA',
        ]);
        echo "hasil id = $id";
    }
}
