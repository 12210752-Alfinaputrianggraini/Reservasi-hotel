<?php

use CodeIgniter\Email\Email;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Email as ConfigEmail;

/**
 * @internal
 */
class EmailTest extends CIUnitTestCase{

    public function testKirimEmail(){
        $email = new Email( new ConfigEmail());
        $email-> setFrom('firarahmi3@gmail.com');
        $email-> setTo('firarahmi323@gmail.com');
        $email-> setSubject('Testing Kirim Email');
        $email-> setMessage('Hallo firaaa <b>selamat bergabung</b>');

        $this->assertTrue( $email->send());
    }
}