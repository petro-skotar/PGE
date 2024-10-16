<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataInArticleLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_links', function (Blueprint $table) {

            $new_id = 90;
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
                    'name' => 'Nie wiesz w co zainwestować 50000 - zainwestuj w Finasi',
                    'content' => '<a href="https://fin-asi.com/oferta-dla-inwestora">Nie wiesz w co zainwestować 50000 - zainwestuj w Finasi</a>',
                ));
                DB::table('articles_details')->insert(array(
                    'article_id' => $new_id,
                    'lang' => 'en',
                    'name' => 'Nie wiesz w co zainwestować 50000 - zainwestuj w Finasi',
                    'content' => '<a href="https://fin-asi.com/oferta-dla-inwestora">Nie wiesz w co zainwestować 50000 - zainwestuj w Finasi</a>',
                ));

            $new_id = 91;
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
                    'name' => 'Nie wiesz w co zainwestować 30 tyś - zainwestuj w Finasi',
                    'content' => '<a href="https://fin-asi.com/oferta-dla-inwestora">Nie wiesz w co zainwestować 30 tyś - zainwestuj w Finasi</a>',
                ));
                DB::table('articles_details')->insert(array(
                    'article_id' => $new_id,
                    'lang' => 'en',
                    'name' => 'Nie wiesz w co zainwestować 30 tyś - zainwestuj w Finasi',
                    'content' => '<a href="https://fin-asi.com/oferta-dla-inwestora">Nie wiesz w co zainwestować 30 tyś - zainwestuj w Finasi</a>',
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_links', function (Blueprint $table) {
            //
        });
    }
}
