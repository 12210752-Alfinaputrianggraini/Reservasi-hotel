<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Database\Migrations\Kamartarif;
use App\Models\KamartarifModel;
use App\Models\PenggunaModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use PhpParser\Node\Stmt\Return_;

class KamartarifController extends BaseController
{
    public function index()
    {
        return view('kamartarif/all');
    }
    public function all(){
        $pm = new KamartarifModel();
        $pm->select('id', 'kamartipe', 'tarif', 'tgl_mulai', 'tgl_selesai', 'tipetarif');
        
        return (new Datatable( $pm ))
                -> setFieldFilter(['kamartipe','tarif','tgl_mulai','tgl_selesai','tipetarif'])
                ->draw();
    }
    public function show($id){
        $r = (new KamartarifModel())->where('id', $id)->first();
        if ($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $pm = new KamartarifModel();

        $id = $pm->insert([
            'kamartipe' => $this->request->getVar('kamartipe'),
            'tarif' => $this->request->getVar('tarif'),
            'tgl_mulai' => $this->request->getVar('tgl_selesai'),
            'tgl_selesai' => $this->request->getVar('tgl_selesai'),
            'tipetarif' => $this->request->getVar('tipetarif'),
        ]);
    }
    public function update(){
        $pm = new KamartarifModel();
        $id = (int)$this->request->getVar('id');

        if( $pm->find($id) == null)
            throw PageNotFoundException::forPageNotFound();
        $hasil = $pm->update($id,[
            'kamartipe' => $this->request->getVar('kamartipe'),
            'tarif' => $this->request->getVar('tarif'),
            'tgl_mulai' => $this->request->getVar('tgl_selesai'),
            'tgl_selesai' => $this->request->getVar('tgl_selesai'),
            'tipetarif' => $this->request->getVar('tipetarif'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $pm = new KamartarifModel();
        $id = $this->request->getVar('id');
        $hasil =$pm->delete($id);
        return $this->response->setJSON(['result'=> $hasil ]);
    }
}
