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
        Schema::create('project_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('project_id');
            $table->enum('offer', ['flats','offices','plots','shops']);
            $table->string('title')->nullable();            
            $table->decimal('area', 8, 0)->nullable(); 
            $table->string('area_type')->nullable(); 
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->decimal('price_from', 15, 2)->nullable();
            $table->decimal('price_to', 15, 2)->nullable();
            $table->string('price_from_in_format')->nullable();
            $table->string('price_to_in_format')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_offers', function (Blueprint $table) {
            
        });
    }
};
