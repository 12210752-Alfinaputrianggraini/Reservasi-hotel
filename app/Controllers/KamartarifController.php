<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\KamartarifModel;
use App\Models\KamartipeModel;
use App\Models\TipetarifModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KamartarifController extends BaseController
{
    public function index()
    {
        return view('backend/Kamartarif/table', [
            'data_kamartipe' => (new KamartipeModel())->findAll(),
            'data_tipetarif' => (new TipetarifModel())->findAll()
        ]);
    }

    public function all(){
        $ktm = KamartarifModel::view();

        return (new Datatable( $ktm))
                ->setFieldFilter(['tipe', 'tipetarif', 'tgl_mulai', 'tgl_selesai'])
                ->draw();
    }

    public function show($id){
        $r = (new KamartarifModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $ktm     = new KamartarifModel();
        $sandi  = $this->request->getVar('sandi');

        $id = $ktm->insert([
            'kamartipe_id'      => $this->request->getVar('kamartipe_id'),
            'tarif'      => $this->request->getVar('tarif'),
            'tgl_mulai'    => $this->request->getVar('tgl_mulai'),
            'tgl_selesai'      => $this->request->getVar('tgl_selesai'),
            'tipetarif_id'      => $this->request->getVar('tipetarif_id'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode( intval($id) > 0 ? 200 : 406);
    }
    
    public function update(){
        $ktm     = new KamartarifModel();
        $id     = (int)$this->request->getVar('id');
        
        if( $ktm->find($id) == null )
        throw PageNotFoundException::forPageNotFound();
        
        $hasil     = $ktm->update($id, [
            'kamartipe_id'      => $this->request->getVar('kamartipe_id'),
            'tarif'      => $this->request->getVar('tarif'),
            'tgl_mulai'    => $this->request->getVar('tgl_mulai'),
            'tgl_selesai'      => $this->request->getVar('tgl_selesai'),
            'tipetarif_id'      => $this->request->getVar('tipetarif_id'),
            
        ]);
        return $this->response->setJSON(['result' => $hasil]);
    }

    public function delete(){
        $ktm     = new KamartarifModel();
        $id     = $this->request->getVar('id');
        $hasil  = $ktm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

}