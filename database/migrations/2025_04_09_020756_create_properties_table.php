<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('properties')) {
            Schema::create('properties', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('builder_id');
                $table->string('property_title');
                $table->text('description');
                $table->enum('property_type', ['home', 'apartment', 'plot', 'commercial']);
                $table->enum('purpose', ['rent', 'sell']);
                //$table->string('progress');
                $table->string('location');
                $table->decimal('price', 15, 2);
                $table->decimal('area', 8, 2); 
                $table->string('area_type'); 
                $table->string('bedrooms')->nullable();
                $table->string('bathrooms')->nullable();
                $table->string('floor')->nullable();
                $table->string('installments')->nullable();
                $table->text('utilities');
                $table->boolean('is_lease')->default(true);
                $table->boolean('is_active')->default(true);
                $table->text('email');
                $table->text('phone_number');
                $table->text('listed_by');
                $table->unsignedBigInteger('added_by');               
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
}
