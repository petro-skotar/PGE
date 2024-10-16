<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
			$table->integer('active')->default(0);
            $table->string('name');
			$table->string('surname',255)->nullable(true)->default('');
			$table->string('patronymic',255)->nullable(true)->default('');
			$table->string('phone',50)->nullable(true)->default('');
			$table->string('place_of_work',255)->nullable(true)->default('');
			$table->string('post',255)->nullable(true)->default('');
			$table->string('country',255)->nullable(true)->default('');
			$table->string('city',255)->nullable(true)->default('');
			$table->string('comments',255)->nullable(true)->default('');
			$table->dateTime('birthday', $precision = 0)->nullable(true);
			$table->string('role',12)->nullable()->default('user');
			$table->integer('role_id')->nullable(true)->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
			$table->integer('send_verify_registration')->nullable(true)->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
