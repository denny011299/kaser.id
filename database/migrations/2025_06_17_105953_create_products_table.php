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
        Schema::create('products', function (Blueprint $table) {
            $table->integerIncrements('pr_id');
            $table->string('pr_name',250);
            $table->text('pr_sku');
            $table->text('pr_deskripsi');
            $table->integer('pr_stock')->default(0)->nullable();
            $table->integer('pr_price')->default(0)->nullable();
            $table->integer('pr_berat')->nullable();
            $table->date('pr_exp')->nullable();
            $table->integer('c_id');
            $table->integer('pu_id');
            $table->integer('pr_alert_stok');
            $table->text('pr_img');
            $table->integer('status')->default(1)->comment('1 = active, 0 = dead');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
