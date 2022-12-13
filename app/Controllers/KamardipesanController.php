<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\KamarDipesanModel;
use App\Models\KamarModel;
use App\Models\PemesananModel;
use App\Models\PenggunaModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KamarDipesanController extends BaseController
{
    public function index()
    {
        return view('backend/KamarDipesan/table' , [
            'data_pemesanan' => (new PemesananModel())->findAll(),
            'data_kamar' => (new KamarModel())->findAll(),
            'data_pengguna' => (new PenggunaModel())->findAll()
        ]);
    }

    public function all(){
        $kdm = KamarDipesanModel::view();
        //$ksm->select('id, status, keterangan, urutan');

        return (new Datatable( $kdm))
                ->setFieldFilter(['pemesananid', 'deskripsi', 'tarif', 'nama_depan'])
                ->draw();
    }

    public function show($id){
        $r = (new KamarDipesanModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $kdm     = new KamarDipesanModel();
        $sandi  = $this->request->getVar('sandi');

        $id = $kdm->insert([
            'pemesanan_id'      => $this->request->getVar('pemesanan_id'),
            'kamar_id'      => $this->request->getVar('kamar_id'),
            'tarif'    => $this->request->getVar('tarif'),
            'pengguna_id'      => $this->request->getVar('pengguna_id'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode( intval($id) > 0 ? 200 : 406);
    }
    
    public function update(){
        $kdm     = new KamarDipesanModel();
        $id     = (int)$this->request->getVar('id');
        
        if( $kdm->find($id) == null )
        throw PageNotFoundException::forPageNotFound();
        
        $hasil     = $kdm->update($id, [
            'pemesanan_id'      => $this->request->getVar('pemesanan_id'),
            'kamar_id'      => $this->request->getVar('kamar_id'),
            'tarif'    => $this->request->getVar('tarif'),
            'pengguna_id'      => $this->request->getVar('pengguna_id'),
            
        ]);
        return $this->response->setJSON(['result' => $hasil]);
    }

    public function delete(){
        $kdm     = new KamarDipesanModel();
        $id     = $this->request->getVar('id');
        $hasil  = $kdm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

}
