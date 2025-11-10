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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('pendidikan', ['S1', 'S2', 'S3']);
            $table->enum('divisi', ['Marketing', 'Produksi', 'SDM', 'IT', 'HRD', 'Finance', 'Operations', 'Quality Control', 'Research & Development', 'Legal', 'Procurement', 'Customer Service']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
