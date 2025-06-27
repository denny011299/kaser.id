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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->integerIncrements('so_id');
            $table->string('so_nomer');
            $table->date('so_tanggal');
            $table->string('so_from_company',100);
            $table->string('so_from_address',100);
            $table->string('so_from_nomer',100);
            $table->string('so_from_cp',100);
            $table->string('so_to_company',100);
            $table->string('so_to_address',100);
            $table->string('so_to_nomer',100);
            $table->string('so_to_cp',100);
            $table->string('so_sign_by',100);
            $table->string('so_status')->default("Submitted");
            $table->integer('so_total')->default(0);
            $table->integer('so_total_ppn')->default(0);
            $table->integer('cus_id');
            $table->integer('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
