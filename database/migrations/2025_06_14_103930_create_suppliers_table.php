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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->integerIncrements('sp_id');
            $table->string('sp_name', 255);
            $table->string('sp_cp_name', 255)->nullable();
            $table->string('sp_cp_nomer', 255)->nullable();
            $table->string('sp_nomer', 50)->nullable();
            $table->string('sp_email', 100)->nullable();
            $table->text('sp_address')->nullable();
            $table->id('city_id')->nullable();
            $table->string('sp_bank_name', 100)->nullable();
            $table->string('sp_bank_account', 100)->nullable();
            $table->text('sp_notes')->nullable();
            $table->text('sp_img')->nullable();
            $table->integer('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
