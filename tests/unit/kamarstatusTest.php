<?php 

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class KamarstatusTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'kamarstatus', [
            'status' => 'Ditempati',
            'keterangan' => 'Ada',
            'urutan' => '2'
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "kamarstatus/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'kamarstatus', [
            'status' => 'Ditempati',
            'keterangan' => 'Ada',
            'urutan' => '2',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'kamarstatus', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'kamarstatus/all')
                ->assertStatus(200);
    }

}