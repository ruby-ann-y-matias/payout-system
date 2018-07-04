<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new Status();
        $status->status = 'pending';
        $status->save();

        $status = new Status();
        $status->status = 'released';
        $status->save();
    }
}
