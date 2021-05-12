<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employments', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 60);
            $table->string('lastname', 60);
            $table->string('middle_name', 60)->nullable(true);
            $table->string('address', 60);

            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');

            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states');

            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');

            $table->char('zip', 10);
            $table->date('birth_date')->nullable(true);
            $table->date('date_hired')->nullable(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employments');
    }
}
