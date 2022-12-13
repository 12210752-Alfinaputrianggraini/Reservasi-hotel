<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\KamarModel;
use App\Models\PemesananModel;
use App\Models\PemesananstatusModel;
use App\Models\TamuModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PemesananController extends BaseController
{
    public function index()
    {
        return view('backend/Pemesanan/table' , [
            'data_kamar' => (new KamarModel())->findAll(),
            'data_pemesananstatus' => (new PemesananstatusModel())->findAll(),
            'data_tamu' => (new TamuModel())->findAll()
        ]);
    }

    public function all(){
        $pmm = PemesananModel::view();
        //$ksm->select('id, status, keterangan, urutan');

        return (new Datatable( $pmm))
                ->setFieldFilter(['deskripsi', 'tgl_mulai', 'tgl_selesai', 'status', 'nama_depan'])
                ->draw();
    }

    public function show($id){
        $r = (new PemesananModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $pmm     = new PemesananModel();
        $sandi  = $this->request->getVar('sandi');

        $id = $pmm->insert([
            'kamar_id'      => $this->request->getVar('kamar_id'),
            'tgl_mulai'      => $this->request->getVar('tgl_mulai'),
            'tgl_selesai'    => $this->request->getVar('tgl_selesai'),
            'pemesananstatus_id'      => $this->request->getVar('pemesananstatus_id'),
            'tamu_id'      => $this->request->getVar('tamu_id'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode( intval($id) > 0 ? 200 : 406);
    }
    
    public function update(){
        $pmm     = new PemesananModel();
        $id     = (int)$this->request->getVar('id');
        
        if( $pmm->find($id) == null )
        throw PageNotFoundException::forPageNotFound();
        
        $hasil     = $pmm->update($id, [
            'kamar_id'      => $this->request->getVar('kamar_id'),
            'tgl_mulai'      => $this->request->getVar('tgl_mulai'),
            'tgl_selesai'    => $this->request->getVar('tgl_selesai'),
            'pemesananstatus_id'      => $this->request->getVar('pemesananstatus_id'),
            'tamu_id'      => $this->request->getVar('tamu_id'),
            
        ]);
        return $this->response->setJSON(['result' => $hasil]);
    }

    public function delete(){
        $pmm     = new PemesananModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pmm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

}