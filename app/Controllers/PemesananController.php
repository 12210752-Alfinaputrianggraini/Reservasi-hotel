<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\PemesananModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PemesananController extends BaseController
{
    public function index()
    {
        return view('backend/pemesanan/table');
    }
    public function all(){
        $pm = new PemesananModel();
        $pm->select('id, kamar_id, tgl_mulai, tgl_selesai, pemesananstatus_id');

        return (new Datatable( $pm ))
                ->setFieldFilter(['tgl_mulai, tgl_selesai'])
                ->draw();
    }
    public function show($id){
        $r = (new PemesananModel())->where('id', $id)->first();
        if($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $pm     = new PemesananModel();
        $sandi  = $this->request->getVar('sandi');
        
        $id = $pm->insert([
            'kamar_id'        => $this->request->getVar('kamar_id'),
            'tgl_mulai'        => $this->request->getVar('tgl_mulai'),
            'tgl_selesai'        => $this->request->getVar('tgl_selesai'),
            'pemesananstatus_id'         => $this->request->getVar('pemesananstatus_id'),
            'tamu_id'        => $this->request->getVar('tamu_id'),
        ]);
        return $this->response->setJSON(['id' => $id])
                              ->setJSON( intval($id) > 0 ? 200 : 406 );
    }
    public function update(){
        $pm     = new PemesananModel();
        $id     = (int)$this->request->getVar('id');

        if( $pm->find($id) == null )
            throw PageNotFoundException::forPageNotFound();

        $hasil = $pm->update($id, [
            'kamar_id'           => $this->request->getVar('kamar_id'),
            'tgl_mulai'          => $this->request->getVar('tgl_mulai'),
            'tgl_selesai'        => $this->request->getVar('tgl_selesai'),
            'pemesananstatus_id' => $this->request->getVar('pemesananstatus_id'),
            'tamu_id'        => $this->request->getVar('tamu_id'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $pm     = new PemesananModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON([ 'result' => $hasil ]);
    }
}
