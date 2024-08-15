<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('location_id');
            $table->string('file_name');
            $table->text('descriptions')->nullable();
            $table->string('file_path')->nullable(); // Path lokasi file di server
            $table->timestamps();

            // Relasi ke tabel categories
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // Relasi ke tabel locations
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archives');
    }
};
