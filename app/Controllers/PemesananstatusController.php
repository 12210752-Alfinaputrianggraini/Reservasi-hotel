<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\PemesananstatusModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PemesananstatusController extends BaseController
{
    public function index()
    {
        return view('pemesananstatus/table');
    }
    public function all(){
        $pm = new PemesananstatusModel();
        $pm->select('id, status, urutan, aktif');

        return (new Datatable( $pm ))
                ->setFieldFilter(['status', 'urutan','aktif'])
                ->draw();
    }
    public function show($id){
        $r = (new PemesananstatusModel())->where('id', $id)->first();
        if($r == null) throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $pm     = new PemesananstatusModel();
        $sandi  = $this->request->getVar('sandi');
        
        $id = $pm->insert([
            'status'        => $this->request->getVar('status'),
            'urutan'        => $this->request->getVar('urutan'),
            'aktif'         => $this->request->getVar('aktif'),
        ]);
        return $this->response->setJSON(['id' => $id])
                              ->setJSON( intval($id) > 0 ? 200 : 406 );
    }
    public function update(){
        $pm     = new PemesananstatusModel();
        $id     = (int)$this->request->getVar('id');

        if( $pm->find($id) == null )
            throw PageNotFoundException::forPageNotFound();

        $hasil = $pm->update($id, [
            'status'        => $this->request->getVar('status'),
            'urutan'        => $this->request->getVar('urutan'),
            'aktif'         => $this->request->getVar('aktif'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $pm     = new PemesananstatusModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON([ 'result' => $hasil ]);
    }
}
