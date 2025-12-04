<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Drop unique index on transaction_id if it exists
            try {
                $table->dropUnique('payments_transaction_id_unique');
            } catch (Throwable $e) {
                // Index might not exist; ignore
            }

            // Optionally keep a normal index for faster search
            $table->index('transaction_id');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Remove normal index and restore unique constraint
            $table->dropIndex(['transaction_id']);
            $table->unique('transaction_id');
        });
    }
};
