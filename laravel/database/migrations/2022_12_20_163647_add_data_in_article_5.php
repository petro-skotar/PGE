<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataInArticle5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $new_id = 82;
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
				'name' => 'Numer w rejestrze zarządzających ASI: PLZASI00331',
			));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'en',
				'name' => 'Number in the register of managers ASI: PLZASI00331',
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
