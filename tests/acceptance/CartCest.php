<?php

class CartCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function testBuyLicences(\step\acceptance\Customer $I)
    {
        $I->loginAsCustomer();
        $I->amOnPage('index.php?controller=cart&action=buy&id=3');
       
        $I->click('Confirm Order');
        
        $I->see('License 3');
        $I->see('39.99 / year');
        $I->see('9 allowed websites');
    }
}
