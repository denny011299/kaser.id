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
        Schema::create('staff', function (Blueprint $table) {
            $table->integerIncrements('st_id');
            $table->id('cs_id')->nullable();
            $table->string('st_name', 100);
            $table->string('st_nomer', 20);
            $table->string('st_email', 100);
            $table->text('st_address')->nullable();
            $table->string('st_profile', 255)->nullable();
            $table->date('st_birthdate')->nullable();
            $table->string('st_gender', 6)->nullable();
            $table->string('st_nik', 30)->nullable();
            $table->string('st_religion', 50)->nullable();
            $table->string('st_username', 100)->unique();
            $table->string('st_password', 255);
            $table->integer('st_age')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
