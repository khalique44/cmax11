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
        Schema::table('projects', function (Blueprint $table) {
            $table->text('head_scripts')->nullable()->after('payment_plan_duration');
            $table->unsignedBigInteger('bitrix_project_id')->default(0)->after('head_scripts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('head_scripts');
            $table->dropColumn('bitrix_project_id');
        });
    }
};
