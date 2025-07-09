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
        Schema::create('stock_opname_details', function (Blueprint $table) {
            $table->integerIncrements('stpd_id');
            $table->integer('stp_id');
            $table->integer('pr_id')->nullable();
            $table->integer('sup_id')->nullable();
            $table->integer('stpd_stock');
            $table->integer('stpd_real_stock');
            $table->integer('stpd_selisih');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_opname_details');
    }
};
