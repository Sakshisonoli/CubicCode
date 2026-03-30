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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('action');
            $table->unsignedBigInteger('student_affected')->nullable();
            $table->foreign('student_affected')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('faculty_affected')->nullable();
            $table->foreign('faculty_affected')->references('id')->on('faculties')->onDelete('cascade');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
