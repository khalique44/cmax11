<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->string('title',191)->nullable()->default('NULL');
		$table->string('short_description',191)->nullable()->default('NULL');
		$table->integer('category_id',)->nullable()->default(0);
		$table->string('file_url',191)->nullable()->default('NULL');
		$table->string('header_image',191)->nullable()->default('NULL');
		$table->enum('status',['yes','no'])->default('yes');
		$table->integer('position',)->nullable()->default(0);
		$table->timestamp('deleted_at')->nullable();
		$table->timestamp('created_at')->nullable();
		$table->timestamp('updated_at')->nullable();		

        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}