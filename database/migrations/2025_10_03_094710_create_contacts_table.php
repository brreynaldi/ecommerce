<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');            // Nama pengirim
            $table->string('email');           // Email pengirim
            $table->string('subject');         // Subjek pesan
            $table->text('message');           // Isi pesan
            $table->boolean('is_read')->default(false); // status dibaca
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
