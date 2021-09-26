<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_policies', function (Blueprint $table) {
            $table->id();
            $table->string('policy_name');
            $table->string('morning_start');
            $table->string('morning_end');
            $table->string('afternoon_start');
            $table->string('afternoon_end');
            $table->string('grace_period');
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
        Schema::dropIfExists('work_policies');
    }
}
