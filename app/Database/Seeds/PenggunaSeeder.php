<?php

namespace App\Database\Seeds;

use App\Database\Migrations\Pengguna;
use App\Models\PenggunaModel;
use CodeIgniter\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        $id = (new PenggunaModel())->insert([
            'nama_depan' => 'administrator',
            'nama_belakang' => 'pengguna',
            'gender' => 'P',
            'alamat' => 'Jl. Abdurahman Saleh',
            'kota' => 'Pontianak',
            'tgl_lahir' => '12-12-2000',
            'no_telp' => '081234567812',
            'no_hp' => '08456789012',
            'email' => 'desykashalu31@gmail.com',
            'level' => 'manager',
            'sandi' => password_hash(123456789, PASSWORD_BCRYPT),
        ]);
        echo "hasil id = $id";
        
    }
}
