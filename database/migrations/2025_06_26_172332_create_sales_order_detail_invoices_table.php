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
        Schema::create('sales_order_detail_invoices', function (Blueprint $table) {
            $table->integerIncrements('sodi_id');
            $table->integer('so_id');
            $table->integer('sod_id');
            $table->string('sodi_nomer',200);
            $table->date('sodi_date');
            $table->date('sodi_due_date');
            $table->integer('sodi_total');
            $table->integer('sodi_status')->default(1)->comment('Unpaid, Half Paid, Paid, Canceled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_order_detail_invoices');
    }
};
