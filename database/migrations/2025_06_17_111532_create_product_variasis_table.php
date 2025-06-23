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
        Schema::create('product_variasis', function (Blueprint $table) {
            $table->integerIncrements('pvs_id');
            $table->integer('pr_id');
            $table->string('pvs_name');
            $table->string('pvs_sku',100);
            $table->integer('pvs_stok');
            $table->integer('status')->default(1)->comment('1 = active, 0 = dead');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variasis');
    }
};
