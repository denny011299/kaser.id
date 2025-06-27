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
        Schema::create('supplier_purchase_order_payments', function (Blueprint $table) {
            $table->integerIncrements('spop_id');
            $table->integer('spoi_id');
            $table->integer('spop_total');
            $table->string('spop_type',100);
            $table->integer('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_purchase_order_payments');
    }
};
