<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class TipetarifTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testLogin(){
        $this->call('post', 'login', [
            'email' => 'desykashalu31@gmail.com',
            'sandi' => '123456789'
        ])->assertStatus(200);
    }
    
    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'tipetarif', [
            'tipe'  => 'Deluxe',
            'keterangan'    => 'Pemesanan Pertama',
            'urutan'    => '1',
            'aktif'    => 'Y',
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "tipetarif/".$js['id'])
            ->assertStatus(200);
        
        $this->call('patch', 'tipetarif', [
            'tipe'  => 'Deluxe',
            'keterangan'    => 'Pemesanan Pertama',
            'urutan'    => '1',
            'aktif'    => 'Y',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'tipetarif', [
            'id' => $js['id']
        ])->assertStatus(200);
    }


    public function testRead(){
        $this->call('get', 'tipetarif/all')
             ->assertStatus(200);
    }

    public function testLogout(){
        $this->call('delete', 'login')
             ->assertStatus(302);
    }
}