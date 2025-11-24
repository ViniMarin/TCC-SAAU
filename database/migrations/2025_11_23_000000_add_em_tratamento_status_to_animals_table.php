<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Intentionally left empty. The enum was already updated in
        // 2025_11_17_210000_update_animal_status_enum.php to include "em_tratamento",
        // and running another ALTER with a different set of values would cause churn.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op
    }
};
