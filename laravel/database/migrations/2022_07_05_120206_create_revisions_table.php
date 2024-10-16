<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisions', function (Blueprint $table) {
            $table->id();
            $table->string('module', 50)->nullable(true)->default('');
            $table->integer('user_id')->nullable(true)->default(0);
            $table->integer('parent_id')->nullable(true)->default(0);
            $table->string('type_visit',1)->nullable(true)->default('v');
            $table->string('ip', 20)->nullable(true)->default('');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revisions');
    }
}
