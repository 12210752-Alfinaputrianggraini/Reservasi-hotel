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
            'nama_depan' => 'Fira',
            'nama_belakang' => 'Rahmi',
            'gender' => 'P',
            'alamat' => 'Jl. Abdurahman Saleh',
            'kota' => 'Pontianak',
            'tgl_lhr' => '2000-02-03',
            'notelp' => '081234567812',
            'nohp' => '08456789012',
            'email' => 'firarahmi3@gmail.com',
            'level' => 'M',
            'sandi' => password_hash('123456789', PASSWORD_BCRYPT),
        ]);
        echo "hasil id = $id";
        
    }
}
