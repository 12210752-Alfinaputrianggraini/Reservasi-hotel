<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\KamartipeModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KamartipeController extends BaseController
{
    public function index()
    {
        return view('backend/Kamartipe/table');
    }
    public function all(){
        $pm = new KamartipeModel();
        $pm->select('id, tipe, keterangan, urutan, aktif', 'gambar');

        return (new Datatable( $pm ))
                ->setFieldFilter(['tipe', 'keterangan', 'urutan', 'aktif', 'gambar'])
                ->draw();
    }
    public function show($id){
        $r = (new KamartipeModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $pm     = new KamartipeModel();
        
        $id = $pm->insert([
            'tipe'          => $this->request->getVar('tipe'),
            'keterangan'    => $this->request->getVar('keterangan'),
            'urutan'        => $this->request->getVar('urutan'),
            'aktif'         => $this->request->getVar('aktif'),
            'gambar'        => $this->request->getVar('gambar'),
        ]);
    }
    public function update(){
        $pm     = new KamartipeModel();
        $id     = (int)$this->request->getVar('id');

        if($pm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

        $hasil = $pm->update($id, [
            'tipe'    => $this->request->getVar('tipe'),
            'keterangan'     => $this->request->getVar('keterangan'),
            'urutan'     => $this->request->getVar('urutan'),
            'aktif'     => $this->request->getVar('aktif'),
            'gambar'     => $this->request->getVar('gambar'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $pm     = new KamartipeModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON([ 'result'=>$hasil ]);
    }
}
