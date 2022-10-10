<?php

namespace App\Database\Seeds;

use App\Models\TamuModel;
use CodeIgniter\Database\Seeder;

class TamuSeeder extends Seeder
{
    public function run()
    {
        $id = (new TamuModel())->insert([
            'nama_depan' => 'tamu',
            'nama_belakang' => 'tamu',
            'gender' => 'P',
            'alamat' => 'jl.rubini',
            'kota' => 'Singkawang',
            'negara' => 'Indonesia',
            'no_telp' => '081234567812',
            'no_hp' => '08456789012',
            'email' => 'priwidal@gmail.com',
            'sandi' => password_hash(123456789, PASSWORD_BCRYPT),
        ]);
        echo "hasil id = $id";
    }
}
