<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\KamarModel;
use App\Models\KamarstatusModel;
use App\Models\KamartipeModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KamarController extends BaseController
{
    public function index()
    {
        return view('backend/Kamar/table' , [
            'data_kamartipe' => (new KamartipeModel())->findAll(),
            'data_kamarstatus' => (new KamarstatusModel())->findAll()
        ]);
    }

    public function all(){
        $kkm = KamarModel::view();
        //$ksm->select('id, status, keterangan, urutan');

        return (new Datatable( $kkm))
                ->setFieldFilter(['tipe', 'lantai', 'nomor', 'status', 'deskripsi'])
                ->draw();
    }

    public function show($id){
        $r = (new KamarModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $kkm     = new KamarModel();
        $sandi  = $this->request->getVar('sandi');

        $id = $kkm->insert([
            'kamartipe_id'      => $this->request->getVar('kamartipe_id'),
            'lantai'      => $this->request->getVar('lantai'),
            'nomor'    => $this->request->getVar('nomor'),
            'kamarstatus_id'      => $this->request->getVar('kamarstatus_id'),
            'deskripsi'      => $this->request->getVar('deskripsi'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode( intval($id) > 0 ? 200 : 406);
    }
    
    public function update(){
        $kkm     = new KamarModel();
        $id     = (int)$this->request->getVar('id');
        
        if( $kkm->find($id) == null )
        throw PageNotFoundException::forPageNotFound();
        
        $hasil     = $kkm->update($id, [
            'kamartipe_id'      => $this->request->getVar('kamartipe_id'),
            'lantai'      => $this->request->getVar('lantai'),
            'nomor'    => $this->request->getVar('nomor'),
            'kamarstatus_id'      => $this->request->getVar('kamarstatus_id'),
            'deskripsi'      => $this->request->getVar('deskripsi'),
        ]);
        return $this->response->setJSON(['result' => $hasil]);
    }

    public function delete(){
        $kkm     = new KamarModel();
        $id     = $this->request->getVar('id');
        $hasil  = $kkm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

}