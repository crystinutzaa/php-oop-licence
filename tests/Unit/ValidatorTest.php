<?php
use PHPUnit\Framework\TestCase;
use app\components\commons\Validator;

class ValidatorTest extends TestCase
{

    public function testIsRequired()
    {
        $text = "";
        $this->assertFalse(Validator::isRequired($text));

        $text = null;
        $this->assertFalse(Validator::isRequired($text));

        $text = "I'm not empty";
        $this->assertTrue(Validator::isRequired($text));
    }

    public function testIsEmail()
    {
        $email = "";
        $this->assertFalse(Validator::isEmail($email));

        $email = NULL;
        $this->assertFalse(Validator::isEmail($email));

        $email = "abc";
        $this->assertFalse(Validator::isEmail($email));

        $email = "@email.com";
        $this->assertFalse(Validator::isEmail($email));

        $email = "email@abc";
        $this->assertFalse(Validator::isEmail($email));        

    }

    public function testIsUrl()
    {
        $url = "";
        $this->assertFalse(Validator::isUrl($url));

        $url = NULL;
        $this->assertFalse(Validator::isUrl($url));

        $url = "abc";
        $this->assertFalse(Validator::isUrl($url));

        $url = "http://";
        $this->assertFalse(Validator::isUrl($url));

        $url = "https:/abc";
        $this->assertFalse(Validator::isUrl($url));

        $url = "abc.com";
        $this->assertFalse(Validator::isUrl($url));
    }
}
