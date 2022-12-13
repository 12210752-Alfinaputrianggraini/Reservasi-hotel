<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\NegaraModel;
use App\Models\TamuModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class TamuController extends BaseController
{
    public function index()
    {
        return view('backend/tamu/table',[
            'data_negara'=>(new NegaraModel())->findAll(),
        ]);
    }
    public function all(){
        $tm =  TamuModel::view();
        
        return (new Datatable( $tm ))
                -> setFieldFilter(['alamat','kota','negara'])
                ->draw();
    }
    public function show($id){
        $r = (new TamuModel())->where('id', $id)->first();
        if ($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $tm = new TamuModel();
        $sandi    = $this->request->getVar('sandi');

        $id = $tm->insert([
            'nama_depan'    => $this->request->getVar('nama_depan'),
            'nama_belakang' => $this->request->getVar('nama_belakang'),
            'gender'        => $this->request->getVar('gender'),
            'alamat'        => $this->request->getVar('alamat'),
            'kota'          => $this->request->getVar('kota'),
            'negara_id'     => $this->request->getVar('negara_id'),
            'nohp  '        => $this->request->getVar('nohp'),
            'email'         => $this->request->getVar('email'),
            //'sandi'         => password_hash($sandi, PASSWORD_BCRYPT),
            //'token_reset'   => $this->request->getVar('token_reset'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode( intval($id) > 0 ? 200 : 406);
    }
    public function update(){
        $tm = new TamuModel();
        $id = (int)$this->request->getVar('id');

        if( $tm->find($id) == null)
            throw PageNotFoundException::forPageNotFound();
        $hasil = $tm->update($id,[
            'nama_depan'    => $this->request->getVar('nama_depan'),
            'nama_belakang' => $this->request->getVar('nama_belakang'),
            'gender'        => $this->request->getVar('gender'),
            'alamat'        => $this->request->getVar('alamat'),
            'kota'          => $this->request->getVar('kota'),
            'negara_id'     => $this->request->getVar('negara_id'),
            'nohp  '        => $this->request->getVar('nohp'),
            'email'         => $this->request->getVar('email'),
            //'token_reset'   => $this->request->getVar('token_reset'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $tm = new TamuModel();
        $id = $this->request->getVar('id');
        $hasil =$tm->delete($id);
        return $this->response->setJSON(['result'=> $hasil ]);
    }
}


