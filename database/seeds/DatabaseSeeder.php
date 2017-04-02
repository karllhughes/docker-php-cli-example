<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the items database seeder.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->truncate();

        $numberOfItems = rand(10, 100);

        for ($i = 0; $i < $numberOfItems; $i++) {

            // Create a datetime in the past 100 minutes
            $lastChecked = Carbon::now()
                ->subMinutes(rand(1, 100))
                ->toDateTimeString();

            // Insert a new record in the database
            DB::table('items')->insert([
                'checked_at' => $lastChecked,
            ]);
        }
    }
}
