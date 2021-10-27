<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 30);
            $table->string('middle_name', 30)->nullable();
            $table->string('last_name', 30);
            $table->string('contact_number', 20)->nullable();
            $table->string('civil_status', 20)->nullable();
            $table->string('nationality', 30)->nullable();
            $table->string('birthplace')->nullable();
            $table->string('gender', 10);
            $table->string('age')->nullable();
            $table->string('address');
            $table->string('birthday');
            $table->string('emergency_contact_person')->nullable();
            $table->string('emergency_contact_number', 20)->nullable();
            $table->string('edu_tertiary', 100)->nullable();
            $table->string('edu_secondary', 100)->nullable();
            $table->string('edu_primary', 100)->nullable();
            $table->longText('skills')->nullable();
            $table->longText('seminars_trainings')->nullable();
            $table->longText('work_experiences')->nullable();
            $table->boolean('isAdmin');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('user_infos');
    }
}
