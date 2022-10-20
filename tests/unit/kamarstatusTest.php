<?php

use App\Database\Migrations\Kamarstatus;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class kamarstatusTest extends CIUnitTestCase{
    use FeatureTestTrait;
    
    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'kamarstatus', [
            'status'=>'siap huni',
            'keterangan'=>'2 orang',
            'urutan'=>'01102022',
            'aktif'=>'Y',
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id']> 0);

        $this->call('get', "kamarstatus/".$js['id'])
             ->assertStatus(200);

        $this->call('patch', 'kamarstatus',[
            'status'=>'siap huni',
            'keterangan'=>'2 orang',
            'urutan'=>'01102022',
            'aktif'=>'Y',
        ])->assertStatus(200);

        $this->call('delete','kamarstatus',[
            'id' =>$js['id']
        ])->assertStatus(200);
    }
    public function testRead(){
        $this->call('get', 'kamarstatus/all')
        ->assertStatus(200);
    }
}
