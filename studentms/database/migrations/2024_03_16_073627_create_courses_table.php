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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->string('duration')->nullable();
            $table->string('fees')->nullable();
            $table->text('doc_link')->nullable();
            $table->string('teaching_mode')->nullable();
            $table->string('max_fees')->nullable();
            $table->string('tech_fees_payable')->nullable();
            $table->string('tech_fees_percentage')->nullable();
            $table->string('status')->nullable();
            $table->string('cid')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
