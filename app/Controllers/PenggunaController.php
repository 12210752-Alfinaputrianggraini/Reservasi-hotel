<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;
use CodeIgniter\Email\Email;
use Config\Email as ConfigEmail;
use SebastianBergmann\Type\FalseType;

class PenggunaController extends BaseController
{
    public function login()
    {
        $email      = $this->request->getPost('email');
        $password   = $this->request->getPost('sandi');

        $pengguna   = (new PenggunaModel())->where('email', $email)->first();

        if($pengguna == null){
            return $this->response->setJSON(['message'=>'Email Tidak Terdaftar'])
                        ->setStatusCode(404);
        }

        $cekPassword = password_verify($password, $pengguna['sandi']);
        if($cekPassword == false){
            return $this->response->setJSON(['message'=>'Email dan Sandi Tidak Cocok'])
                        ->setStatusCode(403);
        }

        $this->session->set('pengguna', $pengguna);
        return $this->response->setJSON(['message'=>"Selamat Datang {$pengguna['nama']}"])
                    ->setStatusCode(200);
    }
    public function viewLogin(){
        return view('login');
    }
    public function lupaPassword(){
        $email = $this->request->getPost('Email');

        $pengguna = (new PenggunaModel())->where('Email', $email)->first();

        if($pengguna == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                        ->setStatusCode(404);
        }

        $sandibaru = substr( md5( date('Y-m-dH:i:s')),5,5 );
        $pengguna['sandi'] = password_hash($sandibaru, PASSWORD_BCRYPT);
        $r = (new PenggunaModel())->update($pengguna['id'], $pengguna);

        if($r == False){
            return $this->response->setJSON(['message'=>'Gagal merubah sandi'])
                        ->setStatusCode(502);
        }

        $email = new Email(new ConfigEmail());
        $email->setFrom('priwidal@gmail.com', 'Aplikasi Reservasi Hotel');
        $email->setTo($pengguna['email']);
        $email->setSubject('Reset Sandi Pengguna');
        $email->setMessage("Hallo {$pengguna['nama']} telah meminta reset baru. Reset baru kamu adalah <b>$sandibaru</b>");
        $r = $email->send();

        if($r == true){
            return $this->response->setJSON(['message'=>"Sandi baru sudah dikirim ke alamat email $email"])
                        ->setStatusCode(200);
        }else{
            return $this->response->setJSON(['message'=>"Maaf ada kesalahan pengiriman email ke $email"])
                                ->setStatusCode(500);
        }
    }
    public function viewLupaPassword(){
        return view('lupa_password');
    }
    public function logout(){
        $this->session->destroy();
        return redirect()->to('login');
    }
    public function index(){
        
    }
}
