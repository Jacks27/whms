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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('speciality');
            $table->string('experience');
            $table->string('qualification');
            $table->foreignId('dep_id');
            $table->foreignId('prof_id');
            $table->boolean('status')->default(1);
            $table->foreign('prof_id')->references('id')->on('user_profiles')->onDelete('cascade');
            $table->foreign('dep_id')->references('id')->on('departments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
