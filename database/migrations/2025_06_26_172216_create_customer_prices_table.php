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
        Schema::create('customer_prices', function (Blueprint $table) {
            $table->integerIncrements('cp_id');
            $table->integer('pr_id');
            $table->integer('cus_id');
            $table->integer('cp_price');
            $table->integer('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_prices');
    }
};
