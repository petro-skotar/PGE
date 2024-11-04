<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StartDATA extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # === Main administrator ===
		DB::table('users')->insert(array(
			'email' => env('ROOT_EMAIL'),
			'password' => env('ROOT_PASSWORD'),
			'name' => 'Admin',
			'role' => 'admin',
			'role_id' => 1,
			'active' => 1,
		));
			# Roles
			DB::table('roles')->insert(array(
				'name' => 'Administrator',
			));
			# Opening access to modules
			DB::table('roles_modules')->insert(array(
				[
					'role_id' => 1,
					'module' => 'articles',
				],
				[
					'role_id' => 1,
					'module' => 'projects',
				],
				/*[
					'role_id' => 1,
					'module' => 'team',
				],*/
				[
                    'role_id' => 1,
					'module' => 'blog',
                ],
				[
                    'role_id' => 1,
					'module' => 'services',
                ],
                /*
				[
					'role_id' => 1,
					'module' => 'offers',
				],
				[
					'role_id' => 1,
					'module' => 'industries',
				],
				[
					'role_id' => 1,
					'module' => 'career',
				],
				[
					'role_id' => 1,
					'module' => 'our-team',
				],
				[
					'role_id' => 1,
					'module' => 'forms',
				],
				[
					'role_id' => 1,
					'module' => 'faq',
				],
				[
					'role_id' => 1,
					'module' => 'reviews',
				],
				[
					'role_id' => 1,
					'module' => 'benefits',
				],*/
				[
					'role_id' => 1,
					'module' => 'sections',
				],
				[
					'role_id' => 1,
					'module' => 'subscribe',
				],
				[
					'role_id' => 1,
					'module' => 'config',
				],
			));

		# Settings
		DB::table('setting')->insert(array(
			'desc' => 'Main email',
			'code' => 'system_email',
			'val' => env('ROOT_EMAIL'),
			'module' => 'custom',
		));
		DB::table('setting')->insert(array(
			'desc' => 'Priority language (for example, en)',
			'code' => 'priority_lang',
			'val' => 'en',
			'module' => 'custom',
		));
		DB::table('setting')->insert(array(
			'desc' => 'The code immediately after <head>',
			'code' => 'code_head',
			'val' => '',
			'module' => 'custom',
		));
		DB::table('setting')->insert(array(
			'desc' => 'The code immediately after <body>',
			'code' => 'code_body',
			'val' => '',
			'module' => 'custom',
		));
		DB::table('setting')->insert(array(
			'desc' => 'Contact Phone',
			'code' => 'contact_phone',
			'val' => '+1 250-627-7266',
			'module' => 'contacts',
		));
		DB::table('setting')->insert(array(
			'desc' => 'Contact Email',
			'code' => 'contact_email',
			'val' => env('ROOT_EMAIL'),
			'module' => 'contacts',
		));
		DB::table('setting')->insert(array(
			'desc' => 'Contact Address',
			'code' => 'contact_address',
			'val' => '801 Fraser St, Prince Rupert, BC V8J 1R1, Canada',
			'module' => 'contacts',
		));
		DB::table('setting')->insert(array(
			'desc' => 'Contact Instagram',
			'code' => 'contact_instagram',
			'val' => '',
			'module' => 'contacts',
		));
		DB::table('setting')->insert(array(
			'desc' => 'Contact Facebook',
			'code' => 'contact_facebook',
			'val' => 'https://www.facebook.com/profile.php?id=100088896532988',
			'module' => 'contacts',
		));


		# CONTENT

        $new_id = 1;

		# === Home page ===
		DB::table('articles')->insert(array(
			'id' => $new_id,
			'parent_id' => 0,
			'position' => $new_id,
			'active' => 1,
			'template' => 'main',
			'sub' => 'yes',
			'in_nav' => 1,
		));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'url' => '/',
				'lang' => 'en',
				'title' => 'PGE Construction',
				'name' => 'PGE Construction company',
				'description' => 'PGE Construction company',
				'bread' => 'Home',
				'short_name' => 'Home',
				'annotation' => '',
				'slogan' => '',
				'content' => '<p>By choosing us for all your construction needs, you gain a team of experienced professionals dedicated to delivering high quality at every stage of the project. We use only the best materials and modern technologies, ensuring the durability and reliability of your construction solutions. Our team of specialists not only carries out the work but also offers a personalized approach to each client, taking into account your preferences and budget.</p>',
			));

        /*
        $new_id++;
		# Zespół
		DB::table('articles')->insert(array(
			'id' => $new_id,
			'parent_id' => 1,
			'position' => $new_id,
			'active' => 1,
			'template' => 'team',
			'sub' => 'nav',
			'in_nav' => 1,
		));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'url' => 'team',
				'lang' => 'en',
				'title' => 'Team',
				'name' => 'Team',
				'description' => 'Team',
				'bread' => 'Team',
				'short_name' => 'Team',
				'annotation' => '',
				'slogan' => '',
				'content' => '',
			));
				$parent_id = 0;
				$new_id++;
				DB::table('articles')->insert(array(
					'id' => $new_id,
					'position' => $new_id,
					'parent_id' => $parent_id,
					'module' => 'team',
					'images' => '["templates/dist/img/team_1.webp"]',
				));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Jakub Paśniczek',
						'annotation' => 'Prezes zarządu',
						'content' => '<p>Ekspert ds. rynków finansowych z wieloletnim doświadczeniem zdobytym w czołowym podmiocie finansowym w kraju. Specjalizuje się transakcjach fuzji i przejęć, doradztwie regulacyjnym oraz obsłudze korporacyjnej podmiotów działających w Polsce i Wielkiej Brytanii, doradza podmiotom w zakresie bieżącej działalności gospodarczej a także w zaplanowaniu i zbudowaniu struktury odpowiadającej specyfice danej branży. Wspiera przedsiębiorców w procesach inwestycyjnych na etapie badań prawnych (due diligence) oraz w przygotowywaniu i negocjacji umów inwestycyjnych, a także w toku przekształceń oraz likwidacji. Brał udział w licznych procesach inwestycyjnych z branży venture capital, a także transakcjach związanych z nabywaniem i zbywaniem przedsiębiorstw, ich majątku oraz udziałów i akcji w spółkach kapitałowych.</p>',
					));
        */

		#  Projects
        $new_id++;
		DB::table('articles')->insert(array(
			'id' => $new_id,
			'parent_id' => 1,
			'position' => $new_id,
			'active' => 1,
			'template' => 'projects',
			'sub' => 'nav',
			'in_nav' => 1,
		));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'url' => 'projects',
				'lang' => 'en',
				'title' => 'Projects',
				'name' => 'Projects',
				'description' => 'Projects',
				'bread' => 'Projects',
				'short_name' => 'Projects',
				'annotation' => '',
				'slogan' => '',
				'content' => '',
			));
                $parent_id = 0;
                $new_id++;
                DB::table('articles')->insert(array(
                    'id' => $new_id,
                    'position' => $new_id,
                    'parent_id' => $parent_id,
                    'module' => 'projects',
                    'images' => '[
                        "templates/pgeconstruction/images/projects/18/05.jpg",
                        "templates/pgeconstruction/images/projects/18/02.jpg",
                        "templates/pgeconstruction/images/projects/18/01.jpg",
                        "templates/pgeconstruction/images/projects/18/03.jpg",
                        "templates/pgeconstruction/images/projects/18/04.jpg"
                    ]',
                ));
                    DB::table('articles_details')->insert(array(
                        'article_id' => $new_id,
                        'lang' => 'en',
                        'name' => 'Helping Homeowners Resolve Flooding with Drainage Upgrades',
                        'url' => 'helping-homeowners-resolve-flooding-drainage-upgrades',
                        'client' => 'Private house',
                        'location' => 'Prince Rupert',
                        'start_date' => '',
                        'end_date' => 'March/April 2024',
                        'annotation' => '',
                        'content' => '<p>Recently we have done a number of drainage improvements for homeowners who had flooding issues. Maintenance or construction needs? Call us for an estimate 250-627-7266</p>',
                    ));

                $parent_id = 0;
                $new_id++;
                DB::table('articles')->insert(array(
                    'id' => $new_id,
                    'position' => $new_id,
                    'parent_id' => $parent_id,
                    'module' => 'projects',
                    'images' => '[
                        "templates/pgeconstruction/images/projects/18/05.jpg",
                        "templates/pgeconstruction/images/projects/18/02.jpg",
                        "templates/pgeconstruction/images/projects/18/01.jpg",
                        "templates/pgeconstruction/images/projects/18/03.jpg",
                        "templates/pgeconstruction/images/projects/18/04.jpg"
                    ]',
                ));
                    DB::table('articles_details')->insert(array(
                        'article_id' => $new_id,
                        'lang' => 'en',
                        'name' => 'Helping Homeowners Resolve Flooding with Drainage Upgrades',
                        'url' => 'helping-homeowners-resolve-flooding-drainage-upgrades',
                        'client' => 'Private house',
                        'location' => 'Prince Rupert',
                        'start_date' => '',
                        'end_date' => 'March/April 2024',
                        'annotation' => '',
                        'content' => '<p>Recently we have done a number of drainage improvements for homeowners who had flooding issues. Maintenance or construction needs? Call us for an estimate 250-627-7266</p>',
                    ));
                $parent_id = 0;
                $new_id++;
                DB::table('articles')->insert(array(
                    'id' => $new_id,
                    'position' => $new_id,
                    'parent_id' => $parent_id,
                    'module' => 'projects',
                    'images' => '[
                        "templates/pgeconstruction/images/projects/19/01.jpg",
                        "templates/pgeconstruction/images/projects/19/02.jpg",
                        "templates/pgeconstruction/images/projects/19/03.jpg",
                        "templates/pgeconstruction/images/projects/19/04.jpg",
                        "templates/pgeconstruction/images/projects/19/05.jpg"
                    ]',
                ));
                    DB::table('articles_details')->insert(array(
                        'article_id' => $new_id,
                        'lang' => 'en',
                        'name' => 'Successfully Completed: Exterior Painting of a Tall House with Safety Precautions',
                        'url' => 'successfully-completed-exterior-painting-tall-house-safety-precautions',
                        'client' => 'Private house',
                        'location' => 'Prince Rupert',
                        'start_date' => 'July 01, 2024',
                        'end_date' => 'July 28, 2024',
                        'annotation' => '',
                        'content' => '<p>just completed the exterior painting a very tall house using safety harnesses, scaffolding and ladder jacks.  Working up high is not for everyone. <br>Our team is available for home renovations in Prince Rupert.  250-627-7266</p>',
                    ));
                $parent_id = 0;
                $new_id++;
                DB::table('articles')->insert(array(
                    'id' => $new_id,
                    'position' => $new_id,
                    'parent_id' => $parent_id,
                    'module' => 'projects',
                    'images' => '[
                        "templates/pgeconstruction/images/projects/20/01.jpg",
                        "templates/pgeconstruction/images/projects/20/02.jpg",
                        "templates/pgeconstruction/images/projects/20/03.jpg",
                        "templates/pgeconstruction/images/projects/20/04.jpg",
                        "templates/pgeconstruction/images/projects/20/05.jpg"
                    ]',
                ));
                    DB::table('articles_details')->insert(array(
                        'article_id' => $new_id,
                        'lang' => 'en',
                        'name' => 'Roof Replacement Success: Revitalizing a Home from the 1940s',
                        'url' => 'roof-replacement-success-revitalizing-home-1940s',
						'client' => 'Private house',
						'location' => 'Prince Rupert',
						'start_date' => 'July 05, 2024',
						'end_date' => 'August 07, 2024',
                        'annotation' => '',
                        'content' => '<p>Finishing up a roof replacement today. Ended up peeling off the old roof from the 1940s. Replaced the structural rot, sheeted, peel-and-stuck and then replaced flashing and re-shingled. The new roof will last longer than a lot of us... Job done! Call Ray for home renovation quotes 250-627-7266</p>',
                    ));
                $parent_id = 0;
                $new_id++;
                DB::table('articles')->insert(array(
                    'id' => $new_id,
                    'position' => $new_id,
                    'parent_id' => $parent_id,
                    'module' => 'projects',
                    'images' => '[
                        "templates/pgeconstruction/images/projects/21/01.jpg",
                        "templates/pgeconstruction/images/projects/21/02.jpg",
                        "templates/pgeconstruction/images/projects/21/03.jpg",
                        "templates/pgeconstruction/images/projects/21/04.jpg",
                        "templates/pgeconstruction/images/projects/21/05.jpg"
                    ]',
                ));
                    DB::table('articles_details')->insert(array(
                        'article_id' => $new_id,
                        'lang' => 'en',
                        'name' => 'Another Roof Replacement Complete: Quality Inspected and Team Tanned!',
                        'url' => 'another-roof-replacement-complete-quality-inspected-team-tanned',
                        'client' => 'Private house',
                        'location' => 'Prince Rupert',
                        'start_date' => 'July 10, 2024',
                        'end_date' => 'August 22, 2024',
                        'annotation' => '',
                        'content' => '<p>Just finished final inspection of another roof replacement. The team have all gotten really solid tans in the last couple of months! Call us for quality home renovations in Prince Rupert! 250-627-7266 </p>',
                    ));
                $parent_id = 0;
                $new_id++;
                DB::table('articles')->insert(array(
                    'id' => $new_id,
                    'position' => $new_id,
                    'parent_id' => $parent_id,
                    'module' => 'projects',
                    'images' => '[
                        "templates/pgeconstruction/images/projects/22/02.jpg",
                        "templates/pgeconstruction/images/projects/22/01.jpg",
                        "templates/pgeconstruction/images/projects/22/03.jpg",
                        "templates/pgeconstruction/images/projects/22/04.jpg",
                        "templates/pgeconstruction/images/projects/22/05.jpg",
                        "templates/pgeconstruction/images/projects/22/06.jpg",
                        "templates/pgeconstruction/images/projects/22/07.jpg",
                        "templates/pgeconstruction/images/projects/22/08.jpg",
                        "templates/pgeconstruction/images/projects/22/09.jpg",
                        "templates/pgeconstruction/images/projects/22/10.jpg"
                    ]',
                ));
                    DB::table('articles_details')->insert(array(
                        'article_id' => $new_id,
                        'lang' => 'en',
                        'name' => 'Project Completion: Pressure Treated Deck, Stairs and Engineered landing.',
                        'url' => 'project-completion-pressure-treated-deck-stairs-engineered-landing',
                        'client' => 'Private house',
                        'location' => 'Prince Rupert',
                        'start_date' => 'June 01, 2024',
                        'end_date' => 'August 23, 2024',
                        'annotation' => '',
                        'content' => '<p>Finishing up a pressure treated second floor deck, staircase and engineered landing. The home owner can now access the 2nd floor access door. total height of staircase in 3.1m. Now for wood stain! <br>Call us for a quote on quality home renovations in Prince Rupert 250-627-7266</p>',
                    ));
                $parent_id = 0;
                $new_id++;
                DB::table('articles')->insert(array(
                    'id' => $new_id,
                    'position' => $new_id,
                    'parent_id' => $parent_id,
                    'module' => 'projects',
                    'images' => '[
                        "templates/pgeconstruction/images/projects/23/01.jpg",
                        "templates/pgeconstruction/images/projects/23/02.jpg",
                        "templates/pgeconstruction/images/projects/23/03.jpg",
                        "templates/pgeconstruction/images/projects/23/04.jpg",
                        "templates/pgeconstruction/images/projects/23/05.jpg",
                        "templates/pgeconstruction/images/projects/23/06.jpg"
                    ]',
                ));
                    DB::table('articles_details')->insert(array(
                        'article_id' => $new_id,
                        'lang' => 'en',
                        'name' => 'Roof Replacement and Exterior Painting of a Heritage House in Prince Rupert',
                        'url' => 'roof-replacement-exterior-painting-heritage-house-prince-rupert',
                        'client' => 'Private house',
                        'location' => 'Prince Rupert',
                        'start_date' => 'August 01, 2024',
                        'end_date' => 'October 01, 2024',
                        'content' => '<p>Just wrapping up another roof replacement and exterior paint job in Prince Rupert. It was a pleasure to work on such a charming heritage house!<br>Call us for home renovations in Prince Rupert. 250-627-7266 <br>Kitchens, bathrooms, drywall, flooring, decks, etc. <br>Quality workmanship, quality customer service.</p>',
                    ));

		# Contacts
        $new_id++;
		DB::table('articles')->insert(array(
			'id' => $new_id,
			'parent_id' => 1,
			'position' => $new_id,
			'active' => 1,
			'template' => 'contacts',
			'sub' => 'no',
			'in_nav' => 1,
		));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'url' => 'contacts',
				'lang' => 'en',
				'title' => 'Contacts',
				'name' => 'Contacts',
				'description' => 'Contacts',
				'bread' => 'Contacts',
				'short_name' => 'Contacts',
				'annotation' => '',
				'slogan' => '',
				'content' => 'Contact us. <br>Do you have further questions about our company\'s activities? Feel free to contact us via contact form, email or give us a call.',
			));

        # Services
        $new_id++;
		DB::table('articles')->insert(array(
			'id' => $new_id,
			'parent_id' => 1,
			'position' => $new_id,
			'active' => 1,
			'template' => 'services',
			'sub' => 'yes',
			'in_nav' => 1,
		));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'url' => 'services',
				'lang' => 'en',
				'title' => 'Services PGE Construction Company',
				'name' => 'Services',
				'description' => 'Services PGE Construction Company',
				'bread' => 'Services',
				'short_name' => 'Services',
				'annotation' => '',
				'slogan' => 'Services PGE Construction Company',
				'content' => '<p>PGE Construction Company provides a full range of construction services, including design, new construction, renovation, and repair. Our experts ensure high standards of quality, adherence to deadlines, and a personalized approach to every client. We build strong and reliable structures that stand the test of time.</p>',
			));

        # Services
        $new_id++;
        DB::table('articles')->insert(array(
            'id' => $new_id,
            'parent_id' => 1,
            'position' => $new_id,
            'active' => 1,
            'template' => 'Blog',
			'sub' => 'nav',
			'in_nav' => 1,
        ));
            DB::table('articles_details')->insert(array(
                'article_id' => $new_id,
                'url' => 'Blog',
                'lang' => 'en',
                'title' => 'Blog PGE Construction Company',
                'name' => 'Blog',
                'description' => 'Blog PGE Construction Company',
                'bread' => 'Blog',
                'short_name' => 'Blog',
                'annotation' => '',
                'slogan' => 'Blog PGE Construction Company',
                'content' => '<p>The PGE Construction Company blog offers valuable tips, news, and insights from the world of construction. Here, you\'ll find information about modern technologies, building materials, design trends, and helpful advice for homeowners and developers. Learn more about our expertise and projects!</p>',
            ));

            $parent_id = 0;
            $new_id++;
            DB::table('articles')->insert(array(
                'id' => $new_id,
                'position' => $new_id,
                'parent_id' => $parent_id,
                'module' => 'blog',
                'images' => '["templates/pgeconstruction/images/temp/1.jpg"]',
            ));
                DB::table('articles_details')->insert(array(
                    'article_id' => $new_id,
                    'lang' => 'en',
                    'name' => 'Innovative <br>e-commerce <br>platform',
                    'url' => 'blog-post-1',
                    'annotation' => 'Development and launch of a modern marketplace platform offering a wide range of products from sellers throughout Europe.',
                    'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi id perspiciatis facilis nulla possimus quasi, amet qui. Ea rerum officia, aspernatur nulla neque nesciunt alias repudiandae doloremque, dolor, quam nostrum laudantium earum illum odio quasi excepturi mollitia corporis quas ipsa modi nihil, ad ex tempore.</p>',
                ));
            $parent_id = 0;
            $new_id++;
            DB::table('articles')->insert(array(
                'id' => $new_id,
                'position' => $new_id,
                'parent_id' => $parent_id,
                'module' => 'blog',
                'images' => '["templates/pgeconstruction/images/temp/2.jpg"]',
            ));
                DB::table('articles_details')->insert(array(
                    'article_id' => $new_id,
                    'lang' => 'en',
                    'name' => 'Project for construction of suburban BIO houses',
                    'url' => 'blog-post-2',
                    'annotation' => 'Construction of suburban wooden houses ideal for year-round residence.',
                    'content' => '<p>In recent years we observe an increased demand for short-term suburban rental housing. Based on the available data, the average annual growth rate of the market is about 12%. The main factor influencing the high scale of profitability of this type of investment is the convenient location and surrounding infrastructure of the facility. With the growing awareness, consumers are demanding more ecological & climate-friendly products and services. Nowadays, from the very first stage of planning and project implementation, it is important to select sustainable materials used during the construction of the property. These materials must not only be harmless to the environment but also be durable and cost-efficient.</p>',
                ));
            $parent_id = 0;
            $new_id++;
            DB::table('articles')->insert(array(
                'id' => $new_id,
                'position' => $new_id,
                'parent_id' => $parent_id,
                'module' => 'blog',
                'images' => '["templates/pgeconstruction/images/temp/3.jpg"]',
            ));
                DB::table('articles_details')->insert(array(
                    'article_id' => $new_id,
                    'lang' => 'en',
                    'name' => 'Construction of a steel structures production plant',
                    'url' => 'blog-post-3',
                    'annotation' => 'Construction of a factory near the Polish-German border, specializing in the production of steel structures.',
                    'content' => '<p>The factory is planned be located in West Pomeranian Voivodeship in Poland, about 25 km from the German border and approximately 100 km away from Berlin.</p><p>In the Federal Republic of Germany, the steel structure market maintains a stable level of demand. In fact, its importance seems to be growing every year, given the global deficits in the general availability of raw materials. Due to limited domestic supply, German companies import 40% to 60% of steel from other countries.</p><p>Therefore the convenient location of the planned factory in the West Pomeranian Voivodeship will allow the export of nearly 90% of the manufactured products to Western Europe, the Federal Republic of Germany in particular. </p>',
                ));

		// Get all the tables from your database
		$tables = \DB::select('SELECT table_name FROM information_schema.tables WHERE table_schema = \'public\' ORDER BY table_name;');
		// Set the tables in the database you would like to ignore
		$ignores = array('admin_setting', 'model_has_permissions', 'model_has_roles', 'password_resets', 'role_has_permissions', 'sessions');
		//loop through the tables
		foreach ($tables as $table) {
		   // if the table is not to be ignored then:
		   if (!in_array($table->table_name, $ignores)) {
			   //Get the max id from that table and add 1 to it
			   $seq = \DB::table($table->table_name)->max('id') + 1;
			   // alter the sequence to now RESTART WITH the new sequence index from above
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
        //
    }
}
