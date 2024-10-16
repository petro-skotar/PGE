<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('module', 50)->nullable(true)->default('');
            $table->integer('parent_id')->nullable(true)->default(0);
            $table->integer('page_id')->nullable(true)->default(0);
            $table->integer('user_id')->nullable(true)->default(0);
            $table->text('name')->nullable(true);
            $table->integer('active')->nullable(true)->default(0);
			$table->text('comment')->nullable(true);
            $table->string('ip', 20)->nullable(true)->default('');
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
		Schema::dropIfExists('comments');
    }
}
