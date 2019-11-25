<?php namespace frontend\tests;


use frontend\models\ContactForm;

class SecondTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        expect( 4 == 4 )->true();
        expect_that( 4 == 4 );
        expect(4)->equals( 2 + 2 );
        expect(4)->greaterThan( 2 + 1 );
        expect([1,2,3,3,5])->hasKey('4');
        
        $model = new ContactForm();
        $model->attributes = [
            'name' => 'Tester',
            'email' => 'tester@example.com',
            'subject' => 'very important letter subject',
            'body' => 'body of current message',
        ];
        expect($model['name'])->equals('Tester');

    }
}