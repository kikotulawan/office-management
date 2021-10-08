<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeEmploymentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_employment_infos', function (Blueprint $table) {
            $table->id();
            $table->string('date_hired', 30);
            $table->string('wage', 30);
            $table->string('overtime', 30);
            $table->string('regular_holiday_rate', 30);
            $table->string('holiday', 30);
            $table->string('position', 80);
            $table->string('status', 20);
            $table->foreignId('work_policy_id')->constrained()->onDelete('cascade');
            $table->foreignId('over_time_policy_id')->constrained()->onDelete('cascade');
            $table->foreignId('branches_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('employee_employment_infos');
    }
}
