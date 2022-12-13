<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class KamarTest extends CIUnitTestCase{
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'kamar', [
            'kamartipe_id' => '1',
            'lantai' => '1',
            'nomor' => '101',
            'kamarstatus_id' => '1',
            'deskripsi' => 'kamar sudah dipersiapkan'
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "kamar/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'kamar', [
           'kamartipe_id' => '1',
            'lantai' => '1',
            'nomor' => '101',
            'kamarstatus_id' => '1',
            'deskripsi' => 'kamar sudah dipersiapkan',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'kamar', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'kamar/all')
                ->assertStatus(200);
    }

}