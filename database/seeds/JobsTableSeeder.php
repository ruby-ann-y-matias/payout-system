<?php

use Illuminate\Database\Seeder;
use App\Job;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
        	$job = new Job();
        	$job->job = $faker->unique()->jobTitle;
        	$job->description = $faker->unique()->catchPhrase;
        	$job->daily_rate = $faker->unique()->randomFloat(2, 10, 40);

        	$x =($job->daily_rate / 8);
        	$job->hourly_rate = round($x, 2);

        	$job->save();
        }
    }
}
