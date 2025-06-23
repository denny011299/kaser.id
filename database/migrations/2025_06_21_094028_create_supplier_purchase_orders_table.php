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
        Schema::create('supplier_purchase_orders', function (Blueprint $table) {
            $table->integerIncrements('spo_id');
            $table->string('spo_nomer');
            $table->integer('sp_id');
            $table->date('sp_tanggal');
            $table->string('spo_from_company',100);
            $table->string('spo_from_address',100);
            $table->string('spo_from_nomer',100);
            $table->string('spo_from_cp',100);
            $table->string('spo_to_company',100);
            $table->string('spo_to_address',100);
            $table->string('spo_to_nomer',100);
            $table->string('spo_to_cp',100);
            $table->string('spo_sign_by',100);
            $table->string('spo_status')->default("Submitted");
            $table->integer('spo_total')->default(0);
            $table->integer('spo_total_ppn')->default(0);
            $table->integer('customer_id');
            $table->integer('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_purchase_orders');
    }
};
