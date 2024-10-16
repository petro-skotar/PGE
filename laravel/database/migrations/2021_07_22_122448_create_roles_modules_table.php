<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_modules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('role_id')->nullable(true)->default(0);
            $table->string('module', 255)->nullable(true)->default('');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(roles_modules);
    }
}
