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
        if (!Schema::hasTable('agents') || Schema::hasColumn('agents', 'registration_draft')) {
            return;
        }

        Schema::table('agents', function (Blueprint $table) {
            $table->json('registration_draft')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('agents') || !Schema::hasColumn('agents', 'registration_draft')) {
            return;
        }

        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn('registration_draft');
        });
    }
};
