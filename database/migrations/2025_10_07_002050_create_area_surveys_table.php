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
        Schema::create('area_surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('sub_area_id');
            $table->string('file_url')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->date('survey_date');
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_surveys');
    }
};
