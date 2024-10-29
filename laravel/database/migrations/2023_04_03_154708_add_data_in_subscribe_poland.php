<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataInSubscribePoland extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribe_poland', function (Blueprint $table) {
            DB::table('subscribe')->insert(array(['region'=>'Poland','name'=>'DDf 21.','city'=>'','email'=>'info@bras123co.2nl','site_url'=>'','position'=>'','active'=> 0]));
            DB::table('subscribe')->insert(array(['region'=>'Poland','name'=>'GLOBAL SALE FDE','city'=>'','email'=>'office@alo32i2sale.com','site_url'=>'','position'=>'','active'=> 0]));
            DB::table('subscribe')->insert(array(['region'=>'Poland','name'=>'Purchasing Group DD','city'=>'','email'=>'info@ipg11bv.nl','site_url'=>'','position'=>'','active'=> 0]));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribe_poland', function (Blueprint $table) {
            //
        });
    }
}
