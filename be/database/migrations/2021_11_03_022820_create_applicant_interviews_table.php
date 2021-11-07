<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_opening_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('schedule', 50);
            $table->string('total_rating', 5)->nullable();
            $table->longText('remark1')->nullable();
            $table->longText('remark2')->nullable();
            $table->longText('remark3')->nullable();
            $table->longText('remark4')->nullable();
            $table->string('communication_skill_val', 1)->nullable();
            $table->string('experience_val', 1)->nullable();
            $table->string('job_related_skill_val', 1)->nullable();
            $table->string('education_training_val', 1)->nullable();
            $table->string('result', 20)->default('Pending');
            $table->string('assigned_interviewer', 50);
            $table->longText('comment')->nullable();
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
        Schema::dropIfExists('applicant_interviews');
    }
}
