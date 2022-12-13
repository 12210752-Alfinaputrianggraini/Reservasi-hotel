<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\MetodebayarModel;
use App\Models\PembayaranModel;
use App\Models\PenggunaModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PembayaranController extends BaseController
{
    public function index()
    {
        return view('backend/Pembayaran/table', [
            'data_metodebayar' => (new MetodebayarModel())->findAll(),
            'data_pengguna' => (new PenggunaModel())->findAll()
        ]);
    }

    public function all(){
        $pym = PembayaranModel::view();
        //$ksm->select('id, status, keterangan, urutan');

        return (new Datatable( $pym))
                ->setFieldFilter(['tgl', 'tagihan', 'dibayar', 'nama_pembayar', 'metode', 'nama_depan'])
                ->draw();
    }

    public function show($id){
        $r = (new PembayaranModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $pym     = new PembayaranModel();
        $sandi  = $this->request->getVar('sandi');

        $id = $pym->insert([
            'tgl'      => $this->request->getVar('tgl'),
            'tagihan'      => $this->request->getVar('tagihan'),
            'dibayar'    => $this->request->getVar('dibayar'),
            'nama_pembayar'      => $this->request->getVar('nama_pembayar'),
            'metodebayar_id'      => $this->request->getVar('metodebayar_id'),
            'pengguna_id'      => $this->request->getVar('pengguna_id'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode( intval($id) > 0 ? 200 : 406);
    }
    
    public function update(){
        $pym     = new PembayaranModel();
        $id     = (int)$this->request->getVar('id');
        
        if( $pym->find($id) == null )
        throw PageNotFoundException::forPageNotFound();
        
        $hasil     = $pym->update($id, [
            'tgl'      => $this->request->getVar('tgl'),
            'tagihan'      => $this->request->getVar('tagihan'),
            'dibayar'    => $this->request->getVar('dibayar'),
            'nama_pembayar'      => $this->request->getVar('nama_pembayar'),
            'metodebayar_id'      => $this->request->getVar('metodebayar_id'),
            'pengguna_id'      => $this->request->getVar('pengguna_id'),
            
        ]);
        return $this->response->setJSON(['result' => $hasil]);
    }

    public function delete(){
        $pym     = new PembayaranModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pym->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

}