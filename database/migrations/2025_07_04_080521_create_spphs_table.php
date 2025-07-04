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
        Schema::create('spphs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pekerjaan');
            $table->date('tanggal_penawaran');
            $table->date('tanggal_penutupan');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('penyetuju_id');
            $table->string('status')->default('draft');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spphs');
    }
};
