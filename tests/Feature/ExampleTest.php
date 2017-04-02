<?php namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        // Seed the database before each run
        Artisan::call('db:seed', array('--class'=>'DatabaseSeeder'));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItCanRunItemUpdate()
    {
        Artisan::call('item:update');

        // If you need result of console output
        $resultAsText = Artisan::output();

        $this->assertRegExp("/Item #[0-9]* updated\\n/", $resultAsText);
    }
}
