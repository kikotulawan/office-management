<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_modules', function (Blueprint $table) {
            $table->id();
            $table->boolean('has_work_module');
            $table->boolean('has_human_resource');
            $table->boolean('has_sales_marketing');
            $table->boolean('has_accounting');
            $table->boolean('has_purchasing');
            $table->boolean('has_corporate_directory');
            $table->boolean('has_project_manager');
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
        Schema::dropIfExists('employee_modules');
    }
}
