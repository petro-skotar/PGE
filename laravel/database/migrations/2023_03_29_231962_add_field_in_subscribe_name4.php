<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldInSubscribeName4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::table('subscribe')->insert(array(['region'=>'England','name'=>'iTechArt Group, London','city'=>'London','email'=>'hello@itechart1-group.com','site_url'=>'https://www.itechart.com/uk','position'=>'']));
        DB::table('subscribe')->insert(array(['region'=>'England','name'=>'Intellectsoft, London, UK','city'=>'London','email'=>'info@intellectsoft2.co.uk','site_url'=>'https://www.intellectsoft.co.uk/','position'=>'']));

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
