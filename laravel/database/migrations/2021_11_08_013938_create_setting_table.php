<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->id();
			$table->string('desc', 255)->nullable(true)->default('');
			$table->string('code', 255)->nullable(true)->default('');
			$table->text('val')->nullable(true);
			$table->string('module', 20)->nullable(true)->default('');
			$table->string('lang', 3)->nullable(true)->default('ru');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting');
    }
}
