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
        Schema::create('spph_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spph_id');
            $table->text('deskripsi');
            $table->integer('qty');
            $table->string('satuan');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('spph_id')->references('id')->on('spphs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spph_items');
    }
};
