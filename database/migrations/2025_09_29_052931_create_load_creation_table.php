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
        Schema::create('load_creation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('load_number')->nullable();
            $table->string('search_terms')->nullable();
            $table->string('dispatcher')->nullable();
            $table->string('load_status')->nullable();
            $table->string('wo')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('type')->nullable();
            $table->decimal('shipper_rate', 10, 2)->nullable();
            $table->string('pds')->nullable();
            $table->string('fsc_per')->nullable();
            $table->decimal('fsc', 10, 2)->nullable();
            $table->decimal('adv_payment', 10, 2)->nullable();
            $table->string('load_type')->nullable();
            $table->string('bill_type')->nullable();
            $table->string('mc_no')->nullable();
            $table->string('carrier_name')->nullable();
            $table->string('equipment_type')->nullable();
            $table->decimal('carrier_fee', 10, 2)->nullable();
            $table->string('currency', 10)->nullable();
            $table->string('carrier_pds')->nullable();
            $table->string('final_shipper_rate')->nullable();
            $table->boolean('carrierrate_check')->default(false);
            $table->decimal('carrierrate', 10, 2)->nullable();
            $table->decimal('final_carrier_fee', 10, 2)->nullable();
            $table->decimal('other_charge_id', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('load_creation');
    }
};
