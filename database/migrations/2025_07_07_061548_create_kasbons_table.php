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
        Schema::create('kasbons', function (Blueprint $table) {
            $table->integerIncrements('ks_id');
            $table->string('ks_nomer',250);
            $table->integer('st_id');
            $table->date('ks_date');
            $table->string('ks_tujuan',250);
            $table->integer('ks_jumlah');
            $table->text('ks_notes');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasbons');
    }
};
