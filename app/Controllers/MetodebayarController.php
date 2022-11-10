<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\MetodebayarModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class MetodebayarController extends BaseController
{
    public function index()
    {
        return view('metodebayar/table');
    }
    public function all(){
        $pm = new MetodebayarModel();
        $pm->select('id, metode, aktif');

        return (new Datatable( $pm ))
                ->setFieldFilter(['metode'])
                ->draw();
    }
    public function show($id){
        $r = (new MetodebayarModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $pm     = new MetodebayarModel();
        
        $id = $pm->insert([
            'metode'    => $this->request->getVar('metode'),
            'aktif'     => $this->request->getVar('aktif'),
        ]);
        return $this->response->setJSON(['id' => $id])
                ->setStatusCode(intval($id) > 0 ? 200 : 406);
    }
    public function update(){
        $pm     = new MetodebayarModel();
        $id     = (int)$this->request->getVar('id');

        if($pm->find($id) == null)
        throw PageNotFoundException::forPageNotFound();

        $hasil = $pm->update($id, [
            'metode'    => $this->request->getVar('metode'),
            'aktif'     => $this->request->getVar('aktif'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $pm     = new MetodebayarModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON([ 'result'=>$hasil ]);
    }
}
