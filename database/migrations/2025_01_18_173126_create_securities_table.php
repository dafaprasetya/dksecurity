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
        Schema::create('securities', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik');
            $table->timestamp('waktu')->default(now());
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->char('kodeunik');
            $table->foreign('kodeunik')->references('kodeunik')->on('point_q_r_s')->onDelete('cascade');
            $table->enum('status',['valid','invalid'])->default('invalid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('securities');
    }
};
