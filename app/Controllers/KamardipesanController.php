<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\KamarDipesanModel;
use App\Models\TipetarifModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KamarDipesanController extends BaseController
{
    public function index()
    {
        return view('tipetarif/table');
    }
    public function all(){
        $pm = new KamardipesanModel();
        $pm->select('id, pemesanan_id, kamar_id, tarif, pengguna_id');

        return (new Datatable( $pm ))
                ->setFieldFilter(['pemesanan_id', 'kamar_id'])
                ->draw();
    }
    public function show($id){
        $r = (new KamarDipesanModel())->where('id', $id)->first();
        if($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $pm     = new KamarDipesanModel();
        $sandi  = $this->request->getVar('sandi');
        
        $id = $pm->insert([
            'pemesanan_id'          => $this->request->getVar('pemesanan_id'),
            'kamar_id'    => $this->request->getVar('kamar_id'),
            'tarif'        => $this->request->getVar('tarif'),
            'pengguna_id'         => $this->request->getVar('pengguna_id'),
        ]);
        return $this->response->setJSON(['id' => $id])
                              ->setJSON( intval($id) > 0 ? 200 : 406 );
    }
    public function update(){
        $pm     = new KamarDipesanModel();
        $id     = (int)$this->request->getVar('id');

        if( $pm->find($id) == null )
            throw PageNotFoundException::forPageNotFound();

        $hasil = $pm->update($id, [
            'pemesanan_id'          => $this->request->getVar('pemesanan_id'),
            'kamar_id'    => $this->request->getVar('kamar_id'),
            'tarif'        => $this->request->getVar('tarif'),
            'pengguna_id'         => $this->request->getVar('pengguna_id'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $pm     = new KamarDipesanModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON([ 'result' => $hasil ]);
    }
}