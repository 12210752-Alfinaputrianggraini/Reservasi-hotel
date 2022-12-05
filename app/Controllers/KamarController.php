<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\KamarModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KamarController extends BaseController
{
    public function index()
    {
        return view('backend/kamar/table');
    }
    public function all(){
        $pm = new KamarModel();
        $pm->select('id, kamartipe_id, lantai, nomor, kamarstatus_id, deskripsi');

        return (new Datatable( $pm ))
                ->setFieldFilter(['lantai', 'nomor'])
                ->draw();
    }
    public function show($id){
        $r = (new KamarModel())->where('id', $id)->first();
        if($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $pm     = new KamarModel();
        $sandi  = $this->request->getVar('sandi');
        
        $id = $pm->insert([
            'kamartipe_id'  => $this->request->getVar('kamartipe_id'),
            'lantai'        => $this->request->getVar('lantai'),
            'nomor'        => $this->request->getVar('nomor'),
            'kamarstatus_id' => $this->request->getVar('kamarstatus_id'),
            'deskripsi' => $this->request->getVar('deskripsi'),
        ]);
        return $this->response->setJSON(['id' => $id])
                              ->setJSON( intval($id) > 0 ? 200 : 406 );
    }
    public function update(){
        $pm     = new KamarModel();
        $id     = (int)$this->request->getVar('id');

        if( $pm->find($id) == null )
            throw PageNotFoundException::forPageNotFound();

        $hasil = $pm->update($id, [
            'kamartipe_id'  => $this->request->getVar('kamartipe_id'),
            'lantai'        => $this->request->getVar('lantai'),
            'nomor'        => $this->request->getVar('nomor'),
            'kamarstatus_id' => $this->request->getVar('kamarstatus_id'),
            'deskripsi' => $this->request->getVar('deskripsi'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $pm     = new KamarModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON([ 'result' => $hasil ]);
    }
}

