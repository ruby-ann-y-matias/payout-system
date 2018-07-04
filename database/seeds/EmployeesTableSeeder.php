<?php

use Illuminate\Database\Seeder;
use App\Employee;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 50;

        for ($i = 0; $i < $limit; $i++) {

        	$employee = new Employee();
        	$employee->address = $faker->address;
        	$employee->mobile = $faker->tollFreePhoneNumber;
        	$employee->birth_date = $faker->date('Y-m-d', '2000-06-05');
        	$employee->email = $faker->unique()->safeEmail;
        	$employee->TIN = '4' . $faker->randomNumber(2) . '-' . $faker->randomNumber(3) . '-' . $faker->randomNumber(3) . '-000';
        	$employee->SSS = '34' . '-' . $faker->randomNumber(7) . '-2';
        	$employee->Pagibig = '12' . $faker->randomNumber(2) . '-' . $faker->randomNumber(4) . '-' . $faker->randomNumber(4);

        	if ($i % 2 == 0) {
	        	$employee->name = $faker->name('male');
	        	$employee->gender = 'male';
	        	$employee->image = 'img/male.jpg';
        	} else {
        		$employee->name = $faker->name('female');
	        	$employee->gender = 'female';
	        	$employee->image = 'img/female.jpg';
        	}

        	$employee->save();
        }
    }
}
