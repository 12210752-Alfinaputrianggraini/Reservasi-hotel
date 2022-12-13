<?php 

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class MetodebayarTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'metodebayar', [
            'metode' => 'transfer',
            'aktif' => 'Y',
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "metodebayar/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'metodebayar', [
            'metode' => 'transfer',
            'aktif' => 'Y',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'metodebayar', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'metodebayar/all')
                ->assertStatus(200);
    }

}