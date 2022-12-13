<?php 

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class PemesananTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'pemesanan', [
            'kamar_id' => '1',
            'tgl_mulai' => '2022-11-02',
            'tgl_selesai' => '2022-11-05',
            'pemesananstatus_id' => '0',
            'tamu_id' => '1'
            ])->getJSON();
            $js = json_decode($json, true);
            
            $this->assertTrue($js['id'] > 0);
            
            $this->call('get', "pemesanan/".$js['id'])
            ->assertStatus(200);
            
            $this->call('patch', 'pemesanan', [
                'kamar_id' => '1',
                'tgl_mulai' => '2022-11-02',
                'tgl_selesai' => '2022-11-05',
                'pemesananstatus_id' => '0',
                'tamu_id' => '1',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'pemesanan', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'pemesanan/all')
                ->assertStatus(200);
    }

}