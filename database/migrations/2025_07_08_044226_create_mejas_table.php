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
        Schema::create('mejas', function (Blueprint $table) {
            $table->integerIncrements('m_id');
            $table->integer('fl_id');
            $table->string('m_name',250);
            $table->integer('m_kapasitas');
            $table->integer('m_x');
            $table->integer('m_y');
            $table->integer('m_type')->comment("1= Horizontal, 2= Vertikal");
            $table->integer('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mejas');
    }
};
