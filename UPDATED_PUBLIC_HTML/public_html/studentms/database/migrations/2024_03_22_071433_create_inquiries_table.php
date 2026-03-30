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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->date('enquiry_date')->nullable();
            $table->string('course_enquiry')->nullable();
            $table->string('city')->nullable();
            $table->string('education')->nullable();
            $table->string('branch_name')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('interest_level')->nullable();
            $table->string('followup_status')->nullable();
            $table->string('followup_action')->nullable();
            $table->date('followup_date')->nullable();
            $table->string('followup_time')->nullable();
            $table->date('last_followup')->nullable();
            $table->string('followups_count')->nullable();
            $table->string('seller_name')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->foreign('seller_id')->references('id')->on('faculties')->onDelete('cascade');
            $table->text('note')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
