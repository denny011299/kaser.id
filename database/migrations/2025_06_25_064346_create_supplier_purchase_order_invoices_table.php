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
        Schema::create('supplier_purchase_order_invoices', function (Blueprint $table) {
            $table->integerIncrements('spoi_id');
            $table->integer('spo_id');
            $table->string('spoi_nomer',200);
            $table->date('spoi_date');
            $table->integer('spoi_total');
            $table->integer('spoi_status')->default(1)->comment('Unpaid, Half Paid, Paid, Canceled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_purchase_order_invoices');
    }
};
