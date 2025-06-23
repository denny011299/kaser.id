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
        Schema::create('bundlings', function (Blueprint $table) {
            $table->integerIncrements('bd_id');
            $table->string('bd_name')->comment('Name of the bundling package');
            $table->text('bd_img')->nullable()->comment('Image of the bundling package');
            $table->integer('bd_price')->comment('Price of the bundling package');
            $table->text('bd_desc')->nullable()->comment('Description of the bundling package');
            $table->longText('bd_products'); // JSON format of products included in the bundling package
            $table->integer('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bundlings');
    }
};
