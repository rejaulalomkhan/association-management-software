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
        Schema::table('payments', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['month_year', 'submitted_at']);

            // Add new columns
            $table->string('month', 20)->after('transaction_id'); // January, February, etc.
            $table->integer('year')->after('month'); // 2025, 2026
            $table->foreignId('payment_method_id')->nullable()->after('method')->constrained('payment_methods');
            $table->text('admin_note')->nullable()->after('description');

            // Rename columns
            $table->renameColumn('screenshot_path', 'proof_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->date('month_year');
            $table->timestamp('submitted_at');
            $table->dropForeign(['payment_method_id']);
            $table->dropColumn(['month', 'year', 'payment_method_id', 'admin_note']);
            $table->renameColumn('proof_path', 'screenshot_path');
        });
    }
};
