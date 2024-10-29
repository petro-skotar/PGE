<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->default(0);
            $table->integer('position')->nullable(true)->default(0);
            $table->integer('active')->default(1);
            $table->string('template', 100)->nullable(true)->default('');
            $table->string('sub_template', 100)->nullable(true)->default('');
			$table->string('module',30)->nullable(true)->default('articles');
			$table->string('sub',3)->nullable(true)->default('no');
			$table->integer('in_nav')->nullable(true)->default(0);
			$table->integer('faq_category')->nullable(true)->default(0);
			$table->integer('faq_categories')->nullable(true)->default(1);
			$table->string('filepath',250)->nullable(true)->default('');
			$table->string('logopath',250)->nullable(true)->default('');
			$table->json('images')->nullable(true);
			$table->json('files')->nullable(true);
			$table->integer('open_comments')->nullable(true)->default(0);
			$table->string('employmenttype',500)->nullable(true)->default('');
            $table->timestamps();
        });

        Schema::create('articles_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('article_id')->default(0);
            $table->string('url', 255)->nullable(true);
            $table->string('lang',3)->nullable(true)->default('');
            $table->string('title',255)->nullable(true)->default('');
            $table->string('name',500)->nullable(true)->default('');
            $table->string('short_name',255)->nullable(true)->default('');
            $table->string('bread',255)->nullable(true)->default('');
            $table->text('description',500)->nullable(true);
            $table->text('annotation')->nullable(true);
            $table->text('slogan')->nullable(true);
            $table->text('content')->nullable(true);
            $table->text('content_2')->nullable(true);
            $table->text('content_3')->nullable(true);
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
        Schema::dropIfExists('articles');
        Schema::dropIfExists('articles_details');
    }
}
