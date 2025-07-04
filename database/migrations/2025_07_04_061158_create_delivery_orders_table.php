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
        Schema::create('delivery_orders', function (Blueprint $table) {
            $table->integerIncrements('do_id');
            $table->integer('so_id')->nullable();
            $table->date('do_date')->nullable();
            $table->string('do_sender_name',250)->nullable();
            $table->string('do_receiver_name',250)->nullable();
            $table->string('do_note',250)->nullable();
            $table->integer('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_orders');
    }
};
