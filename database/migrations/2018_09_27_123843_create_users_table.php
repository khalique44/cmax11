<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->enum('type',['athlete','pro-athlete','non-athlete']);
            $table->string('category');
            $table->boolean('status')->default(true);
            $table->boolean('is_verified')->default(false);

            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable()->default(null);
            $table->string('last_name');
            $table->string('phone');
            $table->string('gender');
            $table->date('date_of_birth');

            $table->string('address_1');
            $table->string('address_2')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->string('state')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->integer('district_id');

            $table->integer('registration_type_id')->nullable()->default(null);
            $table->string('registration_year')->nullable()->default(null);
            $table->boolean('last_year_member')->nullable()->default(null);

            $table->string('membership_token')->nullable()->default(null);
            $table->date('application_date')->nullable()->default(null);
            $table->string('ack')->nullable()->default(null);
            $table->text('qr_code')->nullable()->default(null);

            $table->string('profile_pic_url')->nullable()->default(null);
            $table->string('facebook_url')->nullable()->default(null);
            $table->string('twitter_url')->nullable()->default(null);

            $table->string('password');
            $table->rememberToken();
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
