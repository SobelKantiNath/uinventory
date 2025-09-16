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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('pf_no')->unique(); // PF No, unique for each employee
            $table->string('name'); // Employee Name
            $table->string('designation')->nullable(); // Designation
            $table->string('mobile')->nullable(); // Mobile No
            $table->string('email')->nullable()->unique(); // Email
            $table->string('department_name')->nullable(); // Department Name
            $table->date('joining_date')->nullable(); // Department Joining Date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};