<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldInSettingFileInvestFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $new_id = 77;
        $parent_id = 31;
		DB::table('articles')->insert(array(
			'id' => $new_id,
			'position' => $new_id,
            'parent_id' => $parent_id,
			'module' => 'sections',
		));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'en',
				'name' => 'Pprivacy policy',
			));

        # ================================================
		$tables = \DB::select('SELECT table_name FROM information_schema.tables WHERE table_schema = \'public\' ORDER BY table_name;');
		$ignores = array('admin_setting', 'model_has_permissions', 'model_has_roles', 'password_resets', 'role_has_permissions', 'sessions');
		foreach ($tables as $table) {
		   if (!in_array($table->table_name, $ignores)) {
			   $seq = \DB::table($table->table_name)->max('id') + 1;
			   \DB::select('ALTER SEQUENCE ' . $table->table_name . '_id_seq RESTART WITH ' . $seq);
			}
		}
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
