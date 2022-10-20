<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Database\Migrations\Kamar;
use App\Models\KamarModel;
use App\Models\PenggunaModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use PhpParser\Node\Stmt\Return_;

class KamarController extends BaseController
{
    public function index()
    {
        return view('kamar/all');
    }
    public function all(){
        $pm = new KamarModel();
        $pm->select('id', 'kamartipe', 'lantai', 'nomor', 'kamarstatus', 'deskripsi');
        
        return (new Datatable( $pm ))
                -> setFieldFilter(['kamartipe', 'lantai', 'nomor', 'kamarstatus', 'deskripsi'])
                ->draw();
    }
    public function show($id){
        $r = (new KamarModel())->where('id', $id)->first();
        if ($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    public function store(){
        $pm = new KamarModel();

        $id = $pm->insert([
            'kamartipe' => $this->request->getVar('kamartipe'),
            'lantai' => $this->request->getVar('lantai'),
            'nomor' => $this->request->getVar('nomor'),
            'kamarstatus' => $this->request->getVar('kamarstatus'),
            'deskripsi' => $this->request->getVar('deskripsi'),
    
        ]);
    }
    public function update(){
        $pm = new KamarModel();
        $id = (int)$this->request->getVar('id');

        if( $pm->find($id) == null)
            throw PageNotFoundException::forPageNotFound();
        $hasil = $pm->update($id,[
            'kamartipe' => $this->request->getVar('kamartipe'),
            'lantai' => $this->request->getVar('lantai'),
            'nomor' => $this->request->getVar('nomor'),
            'kamarstatus' => $this->request->getVar('kamarstatus'),
            'deskripsi' => $this->request->getVar('deskripsi'),
    
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }
    public function delete(){
        $pm = new KamarModel();
        $id = $this->request->getVar('id');
        $hasil =$pm->delete($id);
        return $this->response->setJSON(['result'=> $hasil ]);
    }
}
