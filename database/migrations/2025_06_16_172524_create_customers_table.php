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
        Schema::create('customers', function (Blueprint $table) {
            $table->integerIncrements('cus_id');
            $table->string('cus_code',250);
            $table->string('cus_name',250);
            $table->string('cus_nomer',250);
            $table->string('cus_address',250);
            $table->string('cus_gender',250);
            $table->date('cus_dob',250);
            $table->integer('city_id');
            $table->integer('cus_total_spent')->default(0);
            $table->integer('cus_total_piutang')->default(0);
            $table->text('cus_notes')->nullable();
            $table->text('cus_img')->nullable();
            $table->integer('status')->default(1)->comment('1 = active, 0 = dead');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
