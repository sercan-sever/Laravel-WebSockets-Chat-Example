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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sender_id')->unsigned()->index(); // Gönderen
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade'); // Gönderen

            $table->bigInteger('receiver_id')->unsigned()->index(); // Alıcı
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade'); // Alıcı

            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
