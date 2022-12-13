<?php 

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class NegaraTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'negara', [
            'negara' => 'INDONESIA',
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "negara/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'negara', [
            'negara' => 'INDONESIA',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'negara', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'negara/all')
                ->assertStatus(200);
    }

}