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
        if (!Schema::hasTable('agent_profiles')) {
            return;
        }

        Schema::table('agent_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('agent_profiles', 'software_name')) {
                $table->string('software_name')->nullable()->after('license_number');
            }
            if (!Schema::hasColumn('agent_profiles', 'portfolio_breakdown')) {
                $table->json('portfolio_breakdown')->nullable()->after('software_name');
            }
            if (!Schema::hasColumn('agent_profiles', 'desired_services')) {
                $table->json('desired_services')->nullable()->after('portfolio_breakdown');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('agent_profiles')) {
            return;
        }

        Schema::table('agent_profiles', function (Blueprint $table) {
            if (Schema::hasColumn('agent_profiles', 'software_name')) {
                $table->dropColumn('software_name');
            }
            if (Schema::hasColumn('agent_profiles', 'portfolio_breakdown')) {
                $table->dropColumn('portfolio_breakdown');
            }
            if (Schema::hasColumn('agent_profiles', 'desired_services')) {
                $table->dropColumn('desired_services');
            }
        });
    }
};
