<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\TamuModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class TamuController extends BaseController
{
    public function index()
    {
        return view('tamu/table');
    }
    public function all(){
        $pm = new TamuModel();
        $pm->select('id, nama_depan, nama_belakang, gender, alamat, kota, negara_id, nohp, email, sandi, token_reset');

        return (new Datatable( $pm ))
                -> setFieldFilter(['alamat','kota'])
                ->draw();
    }
    public function show($id){
        $r = (new TamuModel())->where('id', $id)->first();
        if ($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $pm = new TamuModel();
        $sandi    = $this->request->getVar('sandi');

        $id = $pm->insert([
            'nama_depan'    => $this->request->getVar('nama_depan'),
            'nama_belakang' => $this->request->getVar('nama_belakang'),
            'gender'        => $this->request->getVar('gender'),
            'alamat'        => $this->request->getVar('alamat'),
            'kota'          => $this->request->getVar('kota'),
            //'negara_id'     => $this->request->getVar('negara_id'),
            'nohp  '        => $this->request->getVar('nohp'),
            'email'         => $this->request->getVar('email'),
            //'sandi'         => password_hash($sandi, PASSWORD_BCRYPT),
            //'token_reset'   => $this->request->getVar('token_reset'),
        ]);
    }
    public function update(){
        $pm = new TamuModel();
        $id = (int)$this->request->getVar('id');

        if( $pm->find($id) == null)
            throw PageNotFoundException::forPageNotFound();
        $hasil = $pm->update($id,[
            'nama_depan'    => $this->request->getVar('nama_depan'),
            'nama_belakang' => $this->request->getVar('nama_belakang'),
            'gender'        => $this->request->getVar('gender'),
            'alamat'        => $this->request->getVar('alamat'),
            'kota'          => $this->request->getVar('kota'),
            'negara_id'     => $this->request->getVar('negara_id'),
            'nohp  '        => $this->request->getVar('nohp'),
            'email'         => $this->request->getVar('email'),
            'token_reset'   => $this->request->getVar('token_reset'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $pm = new TamuModel();
        $id = $this->request->getVar('id');
        $hasil =$pm->delete($id);
        return $this->response->setJSON(['result'=> $hasil ]);
    }
}


