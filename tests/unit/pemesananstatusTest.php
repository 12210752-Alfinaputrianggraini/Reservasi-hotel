<?php

use App\Database\Migrations\pemesananstatus;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class pemesananstatusTest extends CIUnitTestCase{
    use FeatureTestTrait;
    
    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'pemesananstatus', [
            'status'=>'siap huni',
            'urutan'=>'01102022',
            'aktif'=>'Y',
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id']> 0);

        $this->call('get', "pemesananstatus/".$js['id'])
             ->assertStatus(200);

        $this->call('patch', 'pemesananstatus',[
            'status'=>'siap huni',
            'urutan'=>'01102022',
            'aktif'=>'Y',
        ])->assertStatus(200);

        $this->call('delete','pemesananstatus',[
            'id' =>$js['id']
        ])->assertStatus(200);
    }
    public function testRead(){
        $this->call('get', 'pemesananstatus/all')
        ->assertStatus(200);
    }
}
