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
        if (!Schema::hasTable('agents')) {
            return;
        }

        Schema::table('agents', function (Blueprint $table) {
            if (!Schema::hasColumn('agents', 'registration_step')) {
                $table->integer('registration_step')->default(1)->after('mobile');
            }

            if (!Schema::hasColumn('agents', 'status')) {
                $table->string('status')->default('incomplete')->after('registration_step');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('agents')) {
            return;
        }

        Schema::table('agents', function (Blueprint $table) {
            if (Schema::hasColumn('agents', 'registration_step')) {
                $table->dropColumn('registration_step');
            }

            if (Schema::hasColumn('agents', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
