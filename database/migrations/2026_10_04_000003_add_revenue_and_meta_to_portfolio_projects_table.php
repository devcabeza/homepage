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
        Schema::table('portfolio_projects', function (Blueprint $table) {
            $table->decimal('monthly_revenue', 10, 2)->default(0)->after('sort_order');
            $table->string('status')->default('active')->after('monthly_revenue');
            $table->string('logo_url')->nullable()->after('status');
            $table->boolean('revenue_verified')->default(true)->after('logo_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolio_projects', function (Blueprint $table) {
            $table->dropColumn(['monthly_revenue', 'status', 'logo_url', 'revenue_verified']);
        });
    }
};
