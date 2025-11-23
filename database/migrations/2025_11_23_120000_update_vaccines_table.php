<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vaccines', function (Blueprint $table) {
            if (!Schema::hasColumn('vaccines', 'vaccine_type')) {
                $table->string('vaccine_type')->after('animal_id');
            }

            if (!Schema::hasColumn('vaccines', 'application_date')) {
                $table->date('application_date')->after('vaccine_type');
            }

            if (!Schema::hasColumn('vaccines', 'next_dose_date')) {
                $table->date('next_dose_date')->nullable()->after('application_date');
            }

            if (!Schema::hasColumn('vaccines', 'created_by')) {
                $table->foreignId('created_by')
                    ->nullable()
                    ->after('notes')
                    ->constrained('users')
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('vaccines', function (Blueprint $table) {
            if (Schema::hasColumn('vaccines', 'created_by')) {
                $table->dropConstrainedForeignId('created_by');
            }

            if (Schema::hasColumn('vaccines', 'next_dose_date')) {
                $table->dropColumn('next_dose_date');
            }

            if (Schema::hasColumn('vaccines', 'application_date')) {
                $table->dropColumn('application_date');
            }

            if (Schema::hasColumn('vaccines', 'vaccine_type')) {
                $table->dropColumn('vaccine_type');
            }
        });
    }
};
