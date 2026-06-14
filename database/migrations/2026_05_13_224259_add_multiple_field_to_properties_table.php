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
        Schema::table('properties', function (Blueprint $table) {
           
            $table->unsignedBigInteger('area_id')->nullable()->after('city_id');
            $table->unsignedBigInteger('sub_area_id')->nullable()->after('area_id');
            $table->unsignedBigInteger('featured_media_id')->nullable()->after('sub_area_id');
            $table->string('total_floors')->nullable()->after('floor');
            $table->string('furnish')->nullable()->after('installments');
            $table->string('video_url')->nullable()->after('furnish');
            $table->string('mobile_number')->nullable()->after('phone_number');
            $table->string('whatsapp_number')->nullable()->after('mobile_number');
            $table->string('landline_number')->nullable()->after('whatsapp_number');
            $table->string('listing_type')->nullable()->after('area_type');
            $table->string('company_name')->nullable()->after('listing_type');
            $table->string('project_name')->nullable()->after('company_name');
            $table->boolean('is_featured')->default(false)->after('is_active');
            $table->boolean('is_verified')->default(false)->after('is_featured');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            //
        });
    }
};
