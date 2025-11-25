<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('raffles')) {
            return;
        }

        Schema::table('raffles', function (Blueprint $table) {
            if (!Schema::hasColumn('raffles', 'total_tickets')) {
                $table->unsignedInteger('total_tickets')
                    ->default(0)
                    ->after('ticket_price');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('raffles')) {
            return;
        }

        Schema::table('raffles', function (Blueprint $table) {
            if (Schema::hasColumn('raffles', 'total_tickets')) {
                $table->dropColumn('total_tickets');
            }
        });
    }
};
