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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->integerIncrements('vc_id');
            $table->integer('vc_name');
            $table->text('vc_deskripsi');
            $table->integer('vc_nominal')->nullable();
            $table->integer('vc_persen')->nullable();
            $table->integer('status')->default(1)->comment('1 = active, 0 = dead');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
