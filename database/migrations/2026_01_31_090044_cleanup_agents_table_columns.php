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

        $columnsToDrop = [
            'razorpay_order_id',
            'razorpay_payment_id',
            'razorpay_signature',
            'payment_status',
            'selected_plan',
            'registration_amount',
            'registration_type',
            'portfolio_breakdown',
            'desired_services',
            'software_name',
            'license_number',
            'pan_number',
        ];

        $existingColumns = array_values(array_filter($columnsToDrop, fn ($column) => Schema::hasColumn('agents', $column)));

        if (empty($existingColumns)) {
            return;
        }

        Schema::table('agents', function (Blueprint $table) {
            $columnsToDrop = [
                'razorpay_order_id',
                'razorpay_payment_id',
                'razorpay_signature',
                'payment_status',
                'selected_plan',
                'registration_amount',
                'registration_type',
                'portfolio_breakdown',
                'desired_services',
                'software_name',
                'license_number',
                'pan_number',
            ];

            $existingColumns = array_values(array_filter($columnsToDrop, fn ($column) => Schema::hasColumn('agents', $column)));

            if (!empty($existingColumns)) {
                $table->dropColumn($existingColumns);
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
            if (!Schema::hasColumn('agents', 'razorpay_order_id')) {
                $table->string('razorpay_order_id')->nullable();
            }
            if (!Schema::hasColumn('agents', 'razorpay_payment_id')) {
                $table->string('razorpay_payment_id')->nullable();
            }
            if (!Schema::hasColumn('agents', 'razorpay_signature')) {
                $table->string('razorpay_signature')->nullable();
            }
            if (!Schema::hasColumn('agents', 'payment_status')) {
                $table->string('payment_status')->nullable();
            }
            if (!Schema::hasColumn('agents', 'selected_plan')) {
                $table->json('selected_plan')->nullable();
            }
            if (!Schema::hasColumn('agents', 'registration_amount')) {
                $table->decimal('registration_amount', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('agents', 'registration_type')) {
                $table->string('registration_type')->nullable();
            }
            if (!Schema::hasColumn('agents', 'portfolio_breakdown')) {
                $table->json('portfolio_breakdown')->nullable();
            }
            if (!Schema::hasColumn('agents', 'desired_services')) {
                $table->json('desired_services')->nullable();
            }
            if (!Schema::hasColumn('agents', 'software_name')) {
                $table->string('software_name')->nullable();
            }
            if (!Schema::hasColumn('agents', 'license_number')) {
                $table->string('license_number')->nullable();
            }
            if (!Schema::hasColumn('agents', 'pan_number')) {
                $table->string('pan_number')->nullable();
            }
        });
    }
};
