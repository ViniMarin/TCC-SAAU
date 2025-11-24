<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    public function up(): void
    {
        // Convert old status values to the new nomenclature before changing the enum
        DB::table('animals')
            ->where('status', 'em_processo')
            ->update(['status' => 'em_tratamento']);

        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE animals MODIFY status ENUM('disponivel', 'adotado', 'em_tratamento') NOT NULL DEFAULT 'disponivel'");
        }
    }

    public function down(): void
    {
        DB::table('animals')
            ->where('status', 'em_tratamento')
            ->update(['status' => 'em_processo']);

        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE animals MODIFY status ENUM('disponivel', 'em_processo', 'adotado') NOT NULL DEFAULT 'disponivel'");
        }
    }
};
