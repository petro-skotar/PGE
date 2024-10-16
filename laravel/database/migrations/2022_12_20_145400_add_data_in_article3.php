<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataInArticle3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $new_id = 79;
        $parent_id = 31;
		DB::table('articles')->insert(array(
			'id' => $new_id,
			'position' => $new_id,
            'parent_id' => $parent_id,
			'module' => 'sections',
		));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'pl',
				'name' => 'Akceptuję pliki cookie',
			));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'en',
				'name' => 'I accept cookies',
			));
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
