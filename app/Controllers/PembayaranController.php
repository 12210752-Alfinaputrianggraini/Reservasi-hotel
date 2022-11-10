<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\PemesananModel;
use App\Models\TipetarifModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PembayaranController extends BaseController
{
    public function index()
    {
        return view('pemesanan/table');
    }
    public function all(){
        $pm = new PembayaranModel();
        $pm->select('tgl, tagihan, dibayar, nama_pembayar, metodebayar_id, pengguna_id');

        return (new Datatable( $pm ))
                ->setFieldFilter(['tgl', 'tagihan'])
                ->draw();
    }
    public function show($id){
        $r = (new PembayaranModel())->where('id', $id)->first();
        if($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $pm     = new PembayaranModel();
        $sandi  = $this->request->getVar('sandi');
        
        $id = $pm->insert([
            'tgl'          => $this->request->getVar('tgl'),
            'tagihan'    => $this->request->getVar('tagihan'),
            'dibayar'        => $this->request->getVar('dibayar'),
            'nama_pembayar'         => $this->request->getVar('nama_pembayar'),
            'metodebayar_id'         => $this->request->getVar('metodebayar_id'),
            'pengguna_id'         => $this->request->getVar('pengguna_id'),
        ]);
        return $this->response->setJSON(['id' => $id])
                              ->setJSON( intval($id) > 0 ? 200 : 406 );
    }
    public function update(){
        $pm     = new PembayaranModel();
        $id     = (int)$this->request->getVar('id');

        if( $pm->find($id) == null )
            throw PageNotFoundException::forPageNotFound();

        $hasil = $pm->update($id, [
            'tgl'          => $this->request->getVar('tgl'),
            'tagihan'    => $this->request->getVar('tagihan'),
            'dibayar'        => $this->request->getVar('dibayar'),
            'nama_pembayar'         => $this->request->getVar('nama_pembayar'),
            'metodebayar_id'         => $this->request->getVar('metodebayar_id'),
            'pengguna_id'         => $this->request->getVar('pengguna_id'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $pm     = new PembayaranModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON([ 'result' => $hasil ]);
    }
}