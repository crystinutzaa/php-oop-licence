<?php

namespace step\acceptance;

class Customer extends \AcceptanceTester
{

    public function loginAsCustomer()
    {
        $I = $this;
        $I->amOnPage('/index.php?controller=index&action=login');
        $I->fillField('login[email]', 'test@test.com');
        $I->fillField('login[password]', 'test');
        $I->click('Submit');
    }
}
