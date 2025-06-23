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
        Schema::create('product_prices', function (Blueprint $table) {
            $table->integerIncrements('pp_id');
            $table->integer('pr_id');
            $table->integer('pp_from'); 
            $table->integer('pp_to'); 
            $table->integer('pp_price'); 
            $table->integer('status')->default(1)->comment('1 = active, 0 = dead'); 
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('product_prices');
    }
};
