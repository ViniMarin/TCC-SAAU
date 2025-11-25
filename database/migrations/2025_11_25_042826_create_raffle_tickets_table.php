<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raffle_tickets', function (Blueprint $table) {
            $table->id();

            // Usuário que comprou
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // Rifa (uuid) à qual o bilhete pertence
            $table->uuid('raffle_id');

            // Número do bilhete dentro da rifa
            $table->unsignedInteger('number');

            $table->timestamps();

            // FK da rifa
            $table->foreign('raffle_id')
                ->references('id')
                ->on('raffles')
                ->onDelete('cascade');

            // Não permite número repetido na mesma rifa
            $table->unique(['raffle_id', 'number']);

            $table->index('user_id');
            $table->index('raffle_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raffle_tickets');
    }
};
