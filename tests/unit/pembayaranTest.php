<?php 

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class PembayaranTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'pembayaran', [
            'tgl' => '2022-11-02',
            'tagihan' => '200000',
            'dibayar' => '200000',
            'nama_pembayar' => 'Tia',
            'metodebayar_id' => '1',
            'pengguna_id' => '1'
            ])->getJSON();
            $js = json_decode($json, true);
            
            $this->assertTrue($js['id'] > 0);
            
            $this->call('get', "pembayaran/".$js['id'])
            ->assertStatus(200);
            
            $this->call('patch', 'pembayaran', [
                'tgl' => '2022-11-02',
                'tagihan' => '200000',
                'dibayar' => '200000',
                'nama_pembayar' => 'Tia',
                'metodebayar_id' => '1',
                'pengguna_id' => '1',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'pembayaran', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'pembayaran/all')
                ->assertStatus(200);
    }

}