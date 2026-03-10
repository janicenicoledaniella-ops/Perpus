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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');        // judul buku
            $table->string('author');       // penulis
            $table->string('publisher');    // penerbit
            $table->year('year');           // tahun terbit
            $table->string('isbn')->nullable(); // ISBN (boleh kosong)
            $table->integer('stock');       // jumlah stok buku
            $table->text('description')->nullable(); // deskripsi buku
            $table->timestamps();           // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};