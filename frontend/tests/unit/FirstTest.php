<?php namespace frontend\tests;


use frontend\models\ContactForm;

class FirstTest extends \Codeception\Test\Unit
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
        $this->assertTrue( 4 == 4 );
        $this->assertEquals( 4, 2 + 2);
        $this->assertLessThan( 4, 2 + 1 );
        $this->assertArrayHasKey( '4', [1,2,3,4,5]);
        
        $model = new ContactForm();

        $model->attributes = [
            'name' => 'Tester',
            'email' => 'tester@example.com',
            'subject' => 'very important letter subject',
            'body' => 'body of current message',
        ];
        
        $this->assertAttributeEquals('Tester', 'name', $model);
    }
}