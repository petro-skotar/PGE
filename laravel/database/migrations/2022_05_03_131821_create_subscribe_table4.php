<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribeTable4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribe', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->nullable(true)->default('');
            $table->string('name', 255)->nullable(true)->default('');
            $table->string('city', 255)->nullable(true)->default('');
            $table->string('region', 255)->nullable(true)->default('');
            $table->string('site_url', 255)->nullable(true)->default('');
            $table->text('position')->nullable(true);
            $table->integer('active')->nullable(true)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
