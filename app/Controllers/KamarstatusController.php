<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Database\Migrations\Kamarstatus;
use App\Models\KamarstatusModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KamarstatusController extends BaseController
{
    public function index()
    {
        return view('kamarstatus/table');
    }
    public function all(){
        $pm = new KamarstatusModel();
        $pm->select('id, status, keterangan, urutan, aktif');

        return (new Datatable( $pm ))
                -> setFieldFilter(['status',])
                ->draw();
    }
    public function show($id){
        $r = (new KamarstatusModel())->where('id', $id)->first();
        if ($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $pm = new KamarstatusModel();

        $id = $pm->insert([
            'status'        => $this->request->getVar(''),
            'keterangan'    => $this->request->getVar('keterangan'),
            'urutan'        => $this->request->getVar('urutan'),
            'aktif'         => $this->request->getVar('aktif'),
        ]);
    }
    public function update(){
        $pm = new KamarstatusModel();
        $id = (int)$this->request->getVar('id');

        if( $pm->find($id) == null)
            throw PageNotFoundException::forPageNotFound();
        $hasil = $pm->update($id,[
            'status'        => $this->request->getVar(''),
            'keterangan'    => $this->request->getVar('keterangan'),
            'urutan'        => $this->request->getVar('urutan'),
            'aktif'         => $this->request->getVar('aktif'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $pm = new KamarstatusModel();
        $id = $this->request->getVar('id');
        $hasil =$pm->delete($id);
        return $this->response->setJSON(['result'=> $hasil ]);
    }
}

