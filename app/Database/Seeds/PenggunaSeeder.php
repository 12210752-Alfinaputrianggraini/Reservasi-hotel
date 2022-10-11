<?php

namespace App\Database\Seeds;

use App\Models\PenggunaModel;
use CodeIgniter\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        $id = (new PenggunaModel())->insert([
            'nama_depan'    =>'administrator',
            'nama_belakang' =>'pengguna',
            'gender'    =>'P',
            'alamat'    =>'Jl. Abdurrahman Saleh',
            'kota'      =>'Pontianak',
            'tgl_lhr'   =>'12-12-2000',
            'no_telp'   =>'123456789',
            'no_hp' =>'08152345678',
            'email' =>'12210744@bsi.ac.id',
            'level' =>'Manager',
            'sandi' =>password_hash('123456789', PASSWORD_BCRYPT),
        ]);
        echo "hasil id = $id";
    }
}
