<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StartSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
		// $new_id = DB::table('articles')->max('id');
		$new_id = 10;
			
		# 11 Dlaczego warto <br>w nas zainwestować? ========================================
		$new_id++;
		DB::table('articles')->insert(array(
			'id' => $new_id,
			'position' => $new_id,
			'module' => 'sections',
			'sub' => 'yes',
		));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'pl',
				'name' => 'Dlaczego warto <br>w nas zainwestować?',
			));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'en',
				'name' => 'Why are we <br>worth investing in?',
			));
				$parent_id = $new_id;
				$new_id++;
				DB::table('articles')->insert(array(
					'id' => $new_id,
					'position' => $new_id,
					'parent_id' => $parent_id,
					'module' => 'sections',
					'images' => '["templates/dist/img/invest_1.webp"]',
				));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'pl',
						'name' => 'P1',
						'annotation' => 'Profesjonalizm i doświadczenie',
						'content' => '<p>O sile naszej spółki świadczy przede wszystkim profesjonalny i rzetelny zespół.</p>',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'P1',
						'annotation' => 'Professionalism and experience',
						'content' => '<p>Our company\'s strength is primarily demonstrated by our professionalism and reliability.</p>',
					));
				$new_id++;
				DB::table('articles')->insert(array(
					'id' => $new_id,
					'position' => $new_id,
					'parent_id' => $parent_id,
					'module' => 'sections',
					'filepath' => '',
				));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'pl',
						'name' => 'F2',
						'annotation' => 'Finansowanie <br>projektu',
						'content' => '<p>Finansujemy inwestycje wyłącznie z kapitału prywatnego, dzięki czemu proces inwestycji i dezinwestycji przebiega znacznie szybciej i sprawniej, niż przypadku inwestycji wspieranych udziałem organizacji państwowych. Na nasze inwestycje wpływa dogłębna analiza i wykazany potencjał wzrostu wartości, a nie czynnik polityczny.</p>',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'F2',
						'annotation' => 'Project <br>financing',
						'content' => '<p>We finance investments exclusively from private capital, which makes the process of investment and disinvestment much faster and efficient than investments supported by the participation of state organizations. Our investments are influenced by in-depth </p>',
					));
				$new_id++;
				DB::table('articles')->insert(array(
					'id' => $new_id,
					'position' => $new_id,
					'parent_id' => $parent_id,
					'module' => 'sections',
					'images' => '["templates/dist/img/invest_2.webp"]',
				));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'pl',
						'name' => 'K3',
						'annotation' => 'Kontakty <br>biznesowe',
						'content' => '<p>Znajomość rynku kapitałowego oraz mnogość przeanalizowanych projektów pozwoliła nam na nawiązanie kontaktów biznesowych z ekspertami z wielu branż. Dzięki nim mamy zapewnione wsparcie na wszystkich etapach procesu inwestycyjnego.</p>',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'K3',
						'annotation' => 'Business <br>relations',
						'content' => '<p> Our knowledge on the equity market has allowed us to establish business contacts with experts in many industries. Thanks to them, we have secured support and assistance at all stages of the investment process.</p>',
					));
					
			
		# 15 JAK DZIAŁA FIN ASI ========================================
		$new_id++;
		DB::table('articles')->insert(array(
			'id' => $new_id,
			'position' => $new_id,
			'module' => 'sections',
			'sub' => 'yes',
		));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'pl',
				'name' => 'Jak działa fin asi',
			));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'en',
				'name' => 'How does fin asi work?',
			));
				$parent_id = $new_id;
				$new_id++;
				DB::table('articles')->insert(array(
					'id' => $new_id,
					'position' => $new_id,
					'parent_id' => $parent_id,
					'module' => 'sections',
					'images' => '["templates/dist/img/how_work_1.webp"]',
				));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'pl',
						'name' => 'Analiza <br>projektu',
						'annotation' => 'Jednym z ważniejszych etapów naszej pracy jest wieloaspektowa analiza projektu, podczas której plan oceniany jest pod względem polityki inwestycyjnej, otoczenia rynkowego, biznesplanu, dostępnego budżetu, a także konkurencji na rynku.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Project <br>analisis',
						'annotation' => 'One of the most important stages of our work is a multifaceted project analysis, during which the plan is evaluated in terms of investment policy, market environment, business plan, available budget, as well as competition on the market.',
					));
				$new_id++;
				DB::table('articles')->insert(array(
					'id' => $new_id,
					'position' => $new_id,
					'parent_id' => $parent_id,
					'module' => 'sections',
					'images' => '["templates/dist/img/how_work_2.webp"]',
				));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'pl',
						'name' => 'Zestawienie',
						'annotation' => 'Zestawienie kluczowych warunków biznesowych, dotyczących przeprowadzania transakcji, a także analizowanie projektu w celu jego wyceny przez inwestora.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Overview',
						'annotation' => 'Summarizing the key business conditions for the future transaction, as well as analyzing the project for its valuation by the investor.',
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
						'name' => 'Umowa <br>inwestycyjna',
						'annotation' => 'Stworzenie i podpisanie umowy inwestycyjnej świadczącej o inwestycji funduszy w projekt. Określany jest w niej między innymi przedmiot umowy, warunki oraz struktura właścicielska.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Investment <br>agreement',
						'annotation' => 'Creation and signing the investment agreement evidencing the investment of funds in the project. Among other things, it specifies the subject of the agreement, conditions, and the ownership structure.',
					));
				$new_id++;
				DB::table('articles')->insert(array(
					'id' => $new_id,
					'position' => $new_id,
					'parent_id' => $parent_id,
					'module' => 'sections',
					'images' => '["templates/dist/img/how_work_1_2.webp"]',
				));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'pl',
						'name' => 'Współpraca <br>z fin asi',
						'annotation' => 'Po podpisaniu umowy oficjalnie inwestor współpracuje wraz ze spółką, mając wgląd w realizację bieżących planów, wspierając w rozwoju, a także kontrolując finanse.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'COOPERATION <br>WITH FIN ASI',
						'annotation' => 'Once the agreement is signed, the investor officially works together with the company, provided with an insight into the implementation of current plans, support at all stages of development, and full control over the finances.',
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
						'name' => 'Wyjście z <br>inwestycji',
						'annotation' => 'Wspólna sprzedaż do inwestora strategicznego, finansowego i IPO. Sprzedaż akcji umożliwia inwestorom osiągnięcie najlepszej stopy zwrotu z inwestycji. Premia wynika z efektu komplementarności, co kreuje dodatkową wartość.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Exit from the agreement',
						'annotation' => 'Joint sales to a strategic investor, financial investor and IPO. Selling shares enables investors to achieve the best return on investment. The revenue results from the effect of complementarity, which generates additional value.',
					));
			
			
		# 21 NASZE MOCNE STRONY ========================================
		$new_id++;
		DB::table('articles')->insert(array(
			'id' => $new_id,
			'position' => $new_id,
			'module' => 'sections',
			'sub' => 'yes',
		));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'pl',
				'name' => 'Nasze mocne strony',
			));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'en',
				'name' => 'Our strengths',
			));
				$parent_id = $new_id;
				$new_id++;
				DB::table('articles')->insert(array(
					'id' => $new_id,
					'position' => $new_id,
					'parent_id' => $parent_id,
					'module' => 'sections',
					'images' => '["templates/dist/img/strenghts_1.webp"]',
				));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'pl',
						'name' => 'Niezależność',
						'annotation' => 'Dzięki finansowaniu projektu jedynie z prywatnych funduszy proces inwestycji i dezinwestycji przebiega znacznie szybciej, a wszelkie lokaty funduszu są wynikiem wnikliwej analizy i udowodnionego potencjału wzrostu wartości, na które nie mają wpływu żadne czynniki polityczne.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Independence',
						'annotation' => 'By funding the project only from private funds, the process of investment and disinvestment appears to be much faster: any fund placements are the result of careful analysis and proven value growth potential, which are not influenced by any political factors. ',
					));
				$new_id++;
				DB::table('articles')->insert(array(
					'id' => $new_id,
					'position' => $new_id,
					'parent_id' => $parent_id,
					'module' => 'sections',
					'images' => '["templates/dist/img/strenghts_2.webp"]',
				));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'pl',
						'name' => 'Zespół zarządzający',
						'annotation' => 'Silny i doświadczony zespół pozytywnie wpływa na rozwój naszej marki, zapewniając nieograniczony dostęp do projektów, mogących poprawić jakość życia.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Management team',
						'annotation' => 'Our powerful and experienced team positively influences the development of our brand, providing unlimited access to projects that can improve the quality of life. ',
					));
				$new_id++;
				DB::table('articles')->insert(array(
					'id' => $new_id,
					'position' => $new_id,
					'parent_id' => $parent_id,
					'module' => 'sections',
					'images' => '["templates/dist/img/strenghts_3.webp"]',
				));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'pl',
						'name' => 'Doświadczenie',
						'annotation' => 'Jesteśmy spółką, którą niezaprzeczalnie wyróżnia doświadczenie zarówno zespołu zarządzającego, jak i wszystkich specjalistów z nią związanych. Dostępnym funduszem zarządzają jedynie osoby, które przez wiele lat zdobywały umiejętności na rynku kapitałowym.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Experience',
						'annotation' => 'We are a company that undoubtedly stands out with our experience of both the management team and all the specialists working in it. The funds are managed only by people who have been gaining skills in the investment market for many years. ',
					));
				$new_id++;
				DB::table('articles')->insert(array(
					'id' => $new_id,
					'position' => $new_id,
					'parent_id' => $parent_id,
					'module' => 'sections',
					'images' => '["templates/dist/img/strenghts_1.webp"]',
				));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'pl',
						'name' => 'Kontakty',
						'annotation' => 'Nasz zespół cieszy się nie tylko umiejętnościami zarządzania i rozwoju biznesu, ale także znajomością szerokiego grona ekspertów, którzy wspierają nas na wszystkich etapach procesu inwestycyjnego.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Contacts',
						'annotation' => 'Our team is pleased to offer not only management and business development skills but also the knowledge of a wide range of experts, supporting us at all stages of the investment process.',
					));
				$new_id++;
				DB::table('articles')->insert(array(
					'id' => $new_id,
					'position' => $new_id,
					'parent_id' => $parent_id,
					'module' => 'sections',
					'images' => '["templates/dist/img/strenghts_2.webp"]',
				));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'pl',
						'name' => 'Fundusze vc',
						'annotation' => 'Przez lata pracy na rynku venture capital zbieraliśmy zarówno bezcenne doświadczenie, jak i kontakty przydatne w dalszej pracy. To właśnie aktywna współpraca z innymi funduszami pozwala na wspólne inwestowanie i zarządzanie rozwojem biznesu.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Vc funds',
						'annotation' => 'Over the years of working in the venture capital market, we have gathered invaluable experience and business contacts useful in this sphere. It is the active cooperation with other funds that enable joint investment and business development management.',
					));
				$new_id++;
				DB::table('articles')->insert(array(
					'id' => $new_id,
					'position' => $new_id,
					'parent_id' => $parent_id,
					'module' => 'sections',
					'images' => '["templates/dist/img/strenghts_3.webp"]',
				));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'pl',
						'name' => 'Komunikatywność I otwartość',
						'annotation' => 'Ciągły kontakt z naszymi klientami sprawia, że stajemy się marką zaufaną, a dodatkowo zaraz po podpisaniu umowy inwestor oficjalnie współpracuje wraz z FIN ASI, mając wgląd w realizację wszystkich bieżących planów, wspierając w rozwoju, a także kontrolując finanse.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Communicativeness and openness',
						'annotation' => 'Cooperation and ongoing contact with our clients makes us a trustworthy brand, and in addition. Once the agreement is signed, the investor officially works with FIN ASI, and has an insight into the implementation of current plans, support at all stages of ',
					));
		
		
		# 28 Baner na stronie głównej ===========================================
		$new_id++;
		DB::table('articles')->insert(array(
			'id' => $new_id,
			'position' => $new_id,
			'module' => 'sections',
			'sub' => 'no',
			'images' => '["templates/dist/img/main_slide_1.webp","templates/dist/img/main_slide_2.webp","templates/dist/img/main_slide_3.webp","templates/dist/img/main_slide_4.webp","templates/dist/img/main_slide_5.webp"]',
		));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'pl',
				'name' => 'Baner na stronie głównej',
			));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'en',
				'name' => 'Baner na stronie głównej',
			));
		
		# 29 Pliki na strone OFERTA DLA INWESTORA ===========================================
		$new_id++;
		DB::table('articles')->insert(array(
			'id' => $new_id,
			'position' => $new_id,
			'module' => 'sections',
			'sub' => 'yes',
		));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'pl',
				'name' => 'Pliki na strone OFERTA DLA INWESTORA',
			));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'en',
				'name' => 'Files on the page OFFER FOR INVESTOR',
			));
				$parent_id = $new_id;
				$new_id++;
				DB::table('articles')->insert(array(
					'id' => $new_id,
					'position' => $new_id,
					'parent_id' => $parent_id,
					'module' => 'sections',
					'files' => '["templates/dist/img/files/p2.pdf"]',
				));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'pl',
						'name' => 'Jak zostać inwestorem',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'How to become an investor',
					));		

		# 31 Текстовые фразы
		$new_id++;
		DB::table('articles')->insert(array(
			'id' => $new_id,
			'position' => $new_id,
			'module' => 'sections',
			'sub' => 'yes',
		));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'pl',
				'name' => 'Frazy',
			));
			DB::table('articles_details')->insert(array(
				'article_id' => $new_id,
				'lang' => 'en',
				'name' => 'Frazy',
			));
				$parent_id = $new_id;
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
						'name' => 'Czytaj więcej',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Read more',
						'annotation' => '',
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
						'name' => 'Dołącz',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Join',
						'annotation' => '',
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
						'name' => 'Zobacz nasze proekty',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'See our projects',
						'annotation' => '',
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
						'name' => 'Wyślij',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Send',
						'annotation' => '',
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
						'name' => 'Wyślij formularz',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Submit form',
						'annotation' => '',
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
						'name' => 'Imię',
						'annotation' => 'Wpisz swoje imię',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Name',
						'annotation' => 'Please enter your name',
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
						'name' => 'Nazwisko',
						'annotation' => 'Wpisz swoje nazwisko',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Last name',
						'annotation' => 'Please enter your last name',
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
						'name' => 'Email',
						'annotation' => 'Wprowadź swój email',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Email',
						'annotation' => 'Enter your email',
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
						'name' => 'Firma',
						'annotation' => 'Wpisz swoje Wpisz nazwę firmy',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Company',
						'annotation' => 'Enter yours Enter company name',
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
						'name' => 'Telefon',
						'annotation' => '+48',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Phone',
						'annotation' => '+48',
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
						'name' => 'Treść pytania',
						'annotation' => 'Wpisz swoje pytanie',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'The content of the question',
						'annotation' => 'Enter your question',
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
						'name' => 'Formularz kontaktowy',
						'content' => '<p>*W ramach wysyłania informacji handlowych będą wykorzystywane Państwa telekomunikacyjne urządzenia końcowe (np. telefon/komputer) oraz mogą być wykorzystywane automatyczne systemy wywołujące, o których mowa w Ustawie z dnia 16 lipca 2004 r. Prawo telekomunikacyjne</p><p>**Powyższe zgody są dobrowolne i mogą zostać wycofane w każdej chwili poprzez wysłanie oświadczenia woli w postaci wiadomości e-mail pod adres: ___________ .</p><p>Wycofanie zgody nie wpływa na zgodność z prawem przetwarzania, którego dokonano na podstawie zgody przed jej wycofaniem.</p>',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Contact form',
						'content' => '<p>*The marketing information can be sent via telecommunications terminal equipment (e.g., telephone/computer) and marketing calls (including via automated calling systems), referred to in the Telecommunications Act of 16 July 2004 r.</p>',
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
						'name' => 'Wyrażam zgodę na przesłanie na podany przeze mnie adres e-mail prezentacji inwestorskiej oraz kompletu wzorów dokumentów.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'I agree to receive the investor presentation and a set of sample documents on the provided email address.',
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
						'name' => 'Chcę zapisać się do Newslettera i wyrażam zgodę na otrzymywanie informacji handlowych oraz marketingowych na podany w formularzu adres e-mail.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'I agree to receive the investor presentation and a set of sample documents on the provided email address.',
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
						'name' => 'Aby na bieżąco otrzymywać dodatkowe informacje związane z działaniami, wydarzeniami, jak i publikacjami na temat spółki FIN ASI sp. z.o.o., zapisz się na do naszego newslettera!',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'If you wish to be regularly updated on our activities, events, as well as publications about FIN ASI sp.z.o.o., sign up to our newsletter!',
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
						'name' => 'Chcę zapisać się do Newslettera i wyrażam zgodę na otrzymywanie informacji handlowych oraz marketingowych na podany w formularzu adres e-mail.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'I agree to receive the investor presentation and a set of sample documents on the provided email address.',
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
						'name' => 'Język',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Language',
						'annotation' => '',
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
						'name' => 'Cena',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Price',
						'annotation' => '',
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
						'name' => '% w skali roku',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => '% per year',
						'annotation' => '',
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
						'name' => 'Nasze projekty',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Our projects',
						'annotation' => '',
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
						'name' => 'Formularz zgłoszeniowy <br>dla inwestora',
						'content' => '<p>Jeśli jesteś zainteresowany inwestycją razem z nami w przyszłość, wypełnij formularz zgłoszeniowy, abyśmy mogli zaprezentować Ci więcej informacji związanych z nami, w tym naszą prezentację inwestorską oraz komplet wzorów dokumentów.</p>',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Investor application <br>form',
						'content' => '<p>If you are interested in investing together with us in the future, please fill out the application form so that we can present you with detailed information about us, including our investor presentation and a set of sample documents.</p>',
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
						'name' => 'Skontaktuj się z nami',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Contact us',
						'annotation' => '',
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
						'name' => 'Media społecznościowe',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Social media',
						'annotation' => '',
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
						'name' => 'Cel projektu',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Aim of the project',
						'annotation' => '',
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
						'name' => 'Kwota dofinansowania',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Amount of funding',
						'annotation' => '',
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
						'name' => 'Okres zwrotu',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Return period',
						'annotation' => '',
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
						'name' => 'Oczekiwany zwrot',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Expected return',
						'annotation' => '',
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
						'name' => 'Opis',
						'annotation' => '',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Description',
						'annotation' => '',
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
						'name' => 'Dane kontaktowe spółki',
						'annotation' => 'FIN ALTERNATYWNA SPÓŁKA INWESTYCYJNA SP. Z O.O.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Company contact information',
						'annotation' => 'FIN ALTERNATYWNA SPÓŁKA INWESTYCYJNA SP. Z O. O.',
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
						'name' => 'Adres spółki',
						'annotation' => 'Warsaw office, Park Avenue Wspólna 70, 00-687 Warsaw',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Company address',
						'annotation' => 'Warsaw office, Park Avenue Wspólna 70, 00-687 Warsaw',
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
						'name' => 'Numer telefonu',
						'annotation' => '+48 XXX XXX XXX',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Phone number',
						'annotation' => '+48 XXX XXX XXX',
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
						'name' => 'Adres e-mail',
						'annotation' => 'info@fin-asi.com',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'E-mail address',
						'annotation' => 'info@fin-asi.com',
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
						'name' => 'Nie znaleziono strony',
						'content' => '<p>Strona, której szukasz nie istnieje lub została przeniesiona. Możesz przejść do strony głównej lub zapoznać się z naszymi projektami:</p>',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'Page not found',
						'content' => '<p> The page you are looking for does not exist or has been moved. You can go to the home page or see our projects: </p> ',
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
						'name' => 'Oświadczam, że zapoznałem się z klauzulą RODO.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'I declare that I have read the GDPR Information Clause',
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
						'name' => 'Wyrażam zgodę na przetwarzanie danych osobowych w celach związanych z udziałem w projektach realizowanych przez spółkę FIN Alternatywna Spółka Inwestycyjna Sp. z o.o.',
					));
					DB::table('articles_details')->insert(array(
						'article_id' => $new_id,
						'lang' => 'en',
						'name' => 'I consent to the processing of personal data for purposes related to participation in projects implemented by FIN Alternatywna Spółka Inwestycyjna Sp. z o.o..',
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
