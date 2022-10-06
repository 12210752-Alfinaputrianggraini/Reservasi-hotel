<?php

namespace App\Database\Seeds;

use App\Models\TipetarifModel;
use CodeIgniter\Database\Seeder;

class TipetarifSeeder extends Seeder
{
    public function run()
    {
        $id = (new TipetarifModel())->insert([
            'tipe'  =>'tarif normal',
            'keterangan'    =>'tipe tarif normal',
            'urutan'    =>'1',
            'aktif' =>'y',
        ]);
        echo "hasil id = $id";
    }
}
