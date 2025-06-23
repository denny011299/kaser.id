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
        Schema::create('supplier_purchase_order_details', function (Blueprint $table) {
            $table->integerIncrements('spod_id');
            $table->integer('spo_id');
            $table->integer('spod_type')->comment("1= Bahan Baku, 2 = product");
            $table->integer('spod_value_id');
            $table->string('spod_nama',200);
            $table->string('spod_variasi',200)->nullable();
            $table->integer('spod_harga');
            $table->integer('spod_qty');
            $table->integer('spod_subtotal');
            $table->integer('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_purchase_order_details');
    }
};
