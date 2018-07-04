<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deductions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned();
            $table->integer('timesheet_id')->unsigned();
            $table->integer('job_id')->unsigned();
            $table->decimal('deduction');
            $table->date('date');
            $table->timestamps();

            $table->foreign('employee_id')
                    ->references('id')
                    ->on('employees')
                    ->onDelete('cascade');

            $table->foreign('timesheet_id')
                    ->references('id')
                    ->on('timesheets')
                    ->onDelete('cascade');

            $table->foreign('job_id')
                    ->references('id')
                    ->on('jobs')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deductions');
    }
}
