<?php

namespace App\Database\Seeds;

use App\Models\TamuModel;
use CodeIgniter\Database\Seeder;

class TamuSeeder extends Seeder
{
    public function run()
    {
        $id = (new TamuModel())->insert([
            'nama_depan' => 'Listia',
            'nama_belakang' => 'Priwida',
            'gender' => 'P',
            'alamat' => 'jl.rubini',
            'kota' => 'Singkawang',
            'negara_id' => '1',
            'nohp' => '081234567812',
            'email' => 'priwidal@gmail.com',
            'sandi' => password_hash(123456789, PASSWORD_BCRYPT),
        ]);
        echo "hasil id = $id";
    }
}
