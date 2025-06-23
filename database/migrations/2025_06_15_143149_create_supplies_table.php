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
        Schema::create('supplies', function (Blueprint $table) {
            $table->integerIncrements('sup_id');
            $table->string('sup_sku',250);
            $table->string('sup_name',250);
            $table->string('sup_unit',250);
            $table->integer('sup_stock');
            $table->integer('sup_buy_price');
            $table->integer('sup_min_stok');
            $table->integer('status')->default(1)->comment('1 = active, 0 = dead');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplies');
    }
};
