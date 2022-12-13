<?php 

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class KamardipesanTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'kamardipesan', [
            'pemesanan_id' => '1',
            'kamar_id' => '1',
            'tarif' => '20000',
            'pengguna_id' => '1',
            ])->getJSON();
            $js = json_decode($json, true);
            
            $this->assertTrue($js['id'] > 0);
            
            $this->call('get', "kamardipesan/".$js['id'])
            ->assertStatus(200);
            
            $this->call('patch', 'kamardipesan', [
            'pemesanan_id' => '1',
            'kamar_id' => '1',
            'tarif' => '20000',
            'pengguna_id' => '1',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'kamardipesan', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'kamardipesan/all')
                ->assertStatus(200);
    }

}