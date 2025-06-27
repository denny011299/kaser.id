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
        Schema::create('sales_order_detail_payments', function (Blueprint $table) {
            $table->integerIncrements('sodp_id');
            $table->integer('sodi_id');
            $table->integer('sodp_total');
            $table->string('sodp_type',100);
            $table->integer('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_order_detail_payments');
    }
};
