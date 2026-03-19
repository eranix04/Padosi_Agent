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
        if (!Schema::hasTable('agent_profiles') || Schema::hasColumn('agent_profiles', 'service_pincodes')) {
            return;
        }

        Schema::table('agent_profiles', function (Blueprint $table) {
            $table->json('service_pincodes')->nullable()->after('office_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('agent_profiles') || !Schema::hasColumn('agent_profiles', 'service_pincodes')) {
            return;
        }

        Schema::table('agent_profiles', function (Blueprint $table) {
            $table->dropColumn('service_pincodes');
        });
    }
};
