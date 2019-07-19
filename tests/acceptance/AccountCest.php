<?php

class AccountCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function testAccountSubmitWebsitesFailed(\step\acceptance\Customer $I)
    {
        $I->loginAsCustomer();
        $I->amOnPage('/index.php?controller=account&action=view');
        $I->see('Hi test@test.com');
        
        $I->fillField('websites[url][]', 'test.com');
        $I->fillField('websites[url][]', 'test');
        $I->click('Submit');
        
        $I->see('URL is not valid');
        $I->see('URL is not valid');
    }
}
