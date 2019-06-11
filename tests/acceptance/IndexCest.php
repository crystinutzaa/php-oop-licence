<?php

class IndexCest
{

    public function _before(AcceptanceTester $I)
    {
        
    }

    public function _after(AcceptanceTester $I)
    {
        
    }

    public function testEnterPage(AcceptanceTester $I)
    {

        $I->amOnPage('/index.php?controller=index&action=index');
        $I->see('License 1');
        $I->see('License 2');
        $I->see('License 3');
    }

    public function testLoginOk(AcceptanceTester $I)
    {

        $I->amOnPage('/index.php?controller=index&action=login');
        // Test Create account OK
        $I->fillField('login[email]', 'test@test.com');
        $I->fillField('login[password]', 'test');
        $I->click('Submit');
        $I->see('Hi test@test.com');
    }

    public function testCreateAccountFailed(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php?controller=index&action=createaccount');

        // Test empty data
        $I->fillField('createAccount[name]', '');
        $I->fillField('createAccount[email]', '');
        $I->fillField('createAccount[password]', '');
        $I->click('Submit');

        $I->see('Name is required');
        $I->see('Password is required');
        $I->see('Email is not valid');

        // Test wrong email
        $I->fillField('createAccount[name]', 'Name');
        $I->fillField('createAccount[email]', 'email');
        $I->fillField('createAccount[password]', 'pass');
        $I->click('Submit');

        $I->see('Email is not valid');

        // Test wrong email & missing password
        $I->fillField('createAccount[name]', 'Name');
        $I->fillField('createAccount[email]', 'email@em');
        $I->fillField('createAccount[password]', '');
        $I->click('Submit');

        $I->see('Email is not valid');
        $I->see('Password is required');

        // Test email already exists
        $I->fillField('createAccount[name]', 'Name');
        $I->fillField('createAccount[email]', 'test@test.com');
        $I->fillField('createAccount[password]', 'newpass');
        $I->click('Submit');

        $I->see('Customer already exists');
    }

    public function testLoginFailed(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php?controller=index&action=login');

        // Test Login email issue
        $I->fillField('login[email]', 'test');
        $I->fillField('login[password]', 'test');
        $I->click('Submit');

        $I->see('Email is not valid');

        // Email & pass are empty
        $I->fillField('login[email]', '');
        $I->fillField('login[password]', '');
        $I->click('Submit');

        $I->see('Password is required');
        $I->see('Email is not valid');

        // Good Email & pass is empty
        $I->fillField('login[email]', 'abc@abc.com');
        $I->fillField('login[password]', '');
        $I->click('Submit');

        $I->see('Password is required');

        // Good Email & pass - nothing in DB
        $I->fillField('login[email]', 'test1@test.com');
        $I->fillField('login[password]', 'abc');
        $I->click('Submit');

        $I->see('Email or Password not found');
    }

    public function testLogout(AcceptanceTester $I)
    {

        $I->amOnPage('/index.php?controller=index&action=login');
        // Test submit
        $I->fillField('login[email]', 'test@test.com');
        $I->fillField('login[password]', 'test');
        $I->click('Submit');
        $I->see('Hi test@test.com');

        $I->amOnPage('/index.php?controller=account&action=view');
        $I->click('Logout', '#logout');

        $I->see('Login');
    }

    public function testBuyLicenseFullFlow(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php?controller=index&action=index');
        $I->click('', '.buy-license');
        $I->see('Login');

        $I->amOnPage('/index.php?controller=index&action=login');
        // Test submit
        $I->fillField('login[email]', 'test@test.com');
        $I->fillField('login[password]', 'test');
        $I->click('Submit');
        $I->see('Hi test@test.com');

        $I->amOnPage('/index.php?controller=account&action=view');
        $I->click('License System', '.license-sys');
        $I->see('Hi test@test.com');

       
        $I->click('', '.buy-license');
        $I->see('Confirm Order');


        $I->click('Confirm Order', '.confirm-order');
        $I->see('Add Website URLs');
    }
}
