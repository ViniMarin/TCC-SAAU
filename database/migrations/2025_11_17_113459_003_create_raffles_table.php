<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raffles', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('title');
            $table->text('description');
            $table->text('prize');

            // Valor do bilhete
            $table->decimal('ticket_price', 10, 2);

            // Quantidade total de bilhetes disponíveis na rifa
            $table->unsignedInteger('total_tickets')->default(0);

            // Data do sorteio
            $table->date('draw_date');

            // Status da rifa
            $table->enum('status', ['ativa', 'pausada', 'encerrada'])->default('ativa');

            // Imagem ilustrativa
            $table->string('image_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raffles');
    }
};
