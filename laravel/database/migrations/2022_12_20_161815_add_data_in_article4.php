<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataInArticle4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $new_id = 80;
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
				'name' => 'Zamieść swoje CV',
			));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'en',
				'name' => 'Post your CV',
			));
        $new_id++;
        DB::table('articles')->insert(array(
            'id' => $new_id,
            'position' => $new_id,
            'parent_id' => $parent_id,
            'module' => 'sections',
        ));
            DB::table('articles_details')->insert(array(
                'article_id' => $new_id,
                'lang' => 'pl',
                'name' => 'Dopuszczalne formaty',
            ));
            DB::table('articles_details')->insert(array(
                'article_id' => $new_id,
                'lang' => 'en',
                'name' => 'Acceptable formats',
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
