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
            $table->boolean('is_installment')->default(false)->after('floor');
            $table->decimal('installment_advance_amount',15, 2)->nullable()->after('is_installment');
            $table->integer('number_of_instalments')->nullable()->after('installment_advance_amount');
            $table->decimal('monthly_installment',15, 2)->nullable()->after('number_of_instalments');

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
