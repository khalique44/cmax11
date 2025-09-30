<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_floor_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('project_id');            
            $table->string('title')->nullable();
            $table->text('media_url')->nullable();  
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_floor_plans', function (Blueprint $table) {
            //
        });
    }
};
