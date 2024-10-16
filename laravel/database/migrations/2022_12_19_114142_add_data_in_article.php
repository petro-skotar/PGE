<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataInArticle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting', function (Blueprint $table) {
            $table->json('files')->nullable(true);
        });
		DB::table('setting')->insert(array(
			'desc' => 'Policy file',
			'code' => 'policy_file',
			'val' => '',
			'module' => 'custom',
		));

        $new_id = 71;
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
				'name' => 'Wyrażam zgodę na przetwarzanie moich danych osobowych przez FIN ASI Sp. z o.o., ul. Wspólna 70, V Piętro, 00-687 Warszawa, w celu i w zakresie niezbędnym do realizacji obsługi niniejszego zgłoszenia. ',
				'content' => '<p>Wyrażam zgodę na przetwarzanie moich danych osobowych przez FIN ASI Sp. z o.o., ul. Wspólna 70, V Piętro, 00-687 Warszawa, w celu i w zakresie niezbędnym do realizacji obsługi niniejszego zgłoszenia.</p>',
			));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'en',
				'name' => 'I consent to the processing of my personal data by FIN ASI Sp. z o.o., 70 Wspólna St., 5th Floor, 00-687 Warsaw, for  the purpose and to the extent necessary to carry out the service of this application.',
				'content' => '<p>I consent to the processing of my personal data by FIN ASI Sp. z o.o., 70 Wspólna St., 5th Floor, 00-687 Warsaw, for  the purpose and to the extent necessary to carry out the service of this application.</p>',
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
                'name' => 'Zapoznałem się z treścią informacji o sposobie przetwarzania moich danych osobowych przez FIN ASI Sp. z o.o., ul. Wspólna 70, V Piętro, 00-687 Warszawa, zawartych w Polityce Prywatności',
                'content' => '<p>Zapoznałem się z treścią informacji o sposobie przetwarzania moich danych osobowych przez FIN ASI Sp. z o.o., ul. Wspólna 70, V Piętro, 00-687 Warszawa, zawartych w <a href="[setting-policy_file]">Polityce Prywatności</a></p>',
            ));
            DB::table('articles_details')->insert(array(
                'article_id' => $new_id,
                'lang' => 'en',
                'content' => 'I have read the Privacy Policy and the information clause, including the information on the aims and manners of processing my personal data by FIN ASI Sp. z o.o., 70 Wspólna St., 5th Floor, 00-687 Warsaw. ',
                'content' => '<p>I have read the <a href="[setting-policy_file]">Privacy Policy</a> and the information clause, including the information on the aims and manners of processing my personal data by FIN ASI Sp. z o.o., 70 Wspólna St., 5th Floor, 00-687 Warsaw.</p>',
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
                'name' => 'Wyrażam zgodę na przetwarzanie moich danych osobowych przez FIN ASI Sp. z o.o., ul. Wspólna 70, V Piętro, 00-687 Warszawa, w celu i w zakresie niezbędnym do otrzymywania newslettera FIN ASI Sp. z o.o.',
                'content' => '<p>Wyrażam zgodę na przetwarzanie moich danych osobowych przez FIN ASI Sp. z o.o., ul. Wspólna 70, V Piętro, 00-687 Warszawa, w celu i w zakresie niezbędnym do otrzymywania newslettera FIN ASI Sp. z o.o.</p>',
            ));
            DB::table('articles_details')->insert(array(
                'article_id' => $new_id,
                'lang' => 'en',
                'name' => 'I consent to the processing of my personal data by FIN ASI Sp. z o.o., 70 Wspólna St., 5th Floor, 00-687 Warsaw, for the perpose and within the scope required to send the FIN ASI Sp. z o.o. newsletter containing commercial information.',
                'content' => '<p>I consent to the processing of my personal data by FIN ASI Sp. z o.o., 70 Wspólna St., 5th Floor, 00-687 Warsaw, for the perpose and within the scope required to send the FIN ASI Sp. z o.o. newsletter containing commercial information.</p>',
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
                'name' => 'Wyrażam zgodę na otrzymywanie od FIN ASI Sp. z o.o., ul. Wspólna 70, V Piętro, 00-687 Warszawa, informacji handlowych oraz marketingowych drogą elektroniczną na wskazany adres e-mail.',
                'content' => '<p>Wyrażam zgodę na otrzymywanie od FIN ASI Sp. z o.o., ul. Wspólna 70, V Piętro, 00-687 Warszawa, informacji handlowych oraz marketingowych drogą elektroniczną na wskazany adres e-mail.</p>',
            ));
            DB::table('articles_details')->insert(array(
                'article_id' => $new_id,
                'lang' => 'en',
                'name' => 'I consent to receive from FIN ASI Sp. z o.o., 70 Wspólna St., 5th Floor, 00-687 Warsaw, commercial and marketing information, by electronic means at the indicated e-mail address.',
                'content' => '<p>I consent to receive from FIN ASI Sp. z o.o., 70 Wspólna St., 5th Floor, 00-687 Warsaw, commercial and marketing information, by electronic means at the indicated e-mail address.</p>',
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
                'name' => 'Wyrażam zgodę na otrzymywanie od FIN ASI Sp. z o.o., ul. Wspólna 70, V Piętro, 00-687 Warszawa, informacji handlowych oraz marketingowych drogą telefoniczną na wskazany numer telefonu.',
                'content' => '<p>Wyrażam zgodę na otrzymywanie od FIN ASI Sp. z o.o., ul. Wspólna 70, V Piętro, 00-687 Warszawa, informacji handlowych oraz marketingowych drogą telefoniczną na wskazany numer telefonu.</p>',
            ));
            DB::table('articles_details')->insert(array(
                'article_id' => $new_id,
                'lang' => 'en',
                'name' => 'I consent to receive from FIN ASI Sp. z o.o., 70 Wspólna St., 5th Floor, 00-687 Warsaw, commercial and marketing information, by telephone to the indicated phone number.',
                'content' => '<p>I consent to receive from FIN ASI Sp. z o.o., 70 Wspólna St., 5th Floor, 00-687 Warsaw, commercial and marketing information, by telephone to the indicated phone number.</p>',
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
                'name' => 'Wyrażam zgodę na otrzymywanie od FIN ASI Sp. z o.o., ul. Wspólna 70, V Piętro, 00-687 Warszawa, informacji handlowych oraz marketingowych drogą telefoniczną na wskazany numer telefonu, przy wykorzystaniu automatycznych systemów wywołujących.',
                'content' => '<p>Wyrażam zgodę na otrzymywanie od FIN ASI Sp. z o.o., ul. Wspólna 70, V Piętro, 00-687 Warszawa, informacji handlowych oraz marketingowych drogą telefoniczną na wskazany numer telefonu, przy wykorzystaniu automatycznych systemów wywołujących.</p>',
            ));
            DB::table('articles_details')->insert(array(
                'article_id' => $new_id,
                'lang' => 'en',
                'name' => 'I consent to receive from FIN ASI Sp. z o.o., 70 Wspólna St., 5th Floor, 00-687 Warsaw, commercial and marketing information, by telephone to the indicated phone number, including through the use of automatic calling systems.',
                'content' => '<p>I consent to receive from FIN ASI Sp. z o.o., 70 Wspólna St., 5th Floor, 00-687 Warsaw, commercial and marketing information, by telephone to the indicated phone number, including through the use of automatic calling systems.</p>',
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
        Schema::table('article', function (Blueprint $table) {
            //
        });
    }
}
