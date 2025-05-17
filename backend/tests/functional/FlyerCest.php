<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
class FlyerCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function testIndexPage(FunctionalTester $I)
    {
        $I->amOnPage('/flyers/index');
        $I->see('Flyer List');
    }

    public function testViewFlyer(FunctionalTester $I)
    {
        $I->amOnPage('/flyers/view?id=1');
        $I->see('Flyer Details');
    }

     public function testCreateFlyer(FunctionalTester $I)
    {
        $I->amOnPage('/flyer/create');
        $I->see('Create Flyer');
        $I->submitForm('#flyer-form', [
            'Flyer[title]' => 'Test Flyer',
            'Flyer[description]' => 'This is a test flyer.',
        ]);
        $I->see('Test Flyer');
    } 
}
