<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOpeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_openings', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->longText('job_description');
            $table->longText('job_requirements');
            $table->longText('job_skills');
            $table->string('job_type');
            $table->string('job_min_experience');
            $table->string('job_min_qualification');
            $table->string('job_salary_from');
            $table->string('job_salary_to');
            $table->string('job_work_location');
            $table->timestamp('job_opening_expiration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_openings');
    }
}
