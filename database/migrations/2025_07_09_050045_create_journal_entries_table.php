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
        Schema::create('journal_entries', function (Blueprint $table) {
             $table->id('je_id');
            $table->date('je_date');
            $table->id('coa_id');
            $table->text('je_description')->nullable();
            $table->string('je_reference', 100)->nullable();
            $table->integer('je_debit')->default(0);
            $table->integer('je_credit')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_entries');
    }
};
