<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class PenggunaTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testLogin(){
        $this->call('post', 'login', [
            'email' => 'firarahmi3@gmail.com',
            'sandi' => '123456789'
        ])->assertStatus(200);
    }
    
    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'pengguna', [
            'nama_depan'  => 'Testing nama',
            'gender'    => 'L',
            'email' => 'testing@gmail.com',
            'sandi' => 'testing'
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "pengguna/".$js['id'])
            ->assertStatus(200);
        
        $this->call('patch', 'pengguna', [
            'nama'  => 'Testing pengguna update',
            'gender' => 'L',
            'email' => 'testingupdate@email.com',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'pengguna', [
            'id' => $js['id']
        ])->assertStatus(200);
    }


    public function testRead(){
        $this->call('get', 'pengguna/all')
             ->assertStatus(200);
    }

    public function testLogout(){
        $this->call('delete', 'login')
             ->assertStatus(302);
    }
}