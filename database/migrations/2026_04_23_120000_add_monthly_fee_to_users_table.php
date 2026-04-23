<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds a nullable per-member monthly fee override.
 *
 * When `users.monthly_fee` is NULL, the member pays the organization-wide
 * default fee from settings (`monthly_fee`). When it is set, that amount
 * overrides the default everywhere: payment form, dues calculation,
 * WhatsApp reminders, receipts, etc.
 */
return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'monthly_fee')) {
                $table->decimal('monthly_fee', 10, 2)
                    ->nullable()
                    ->after('position')
                    ->comment('Per-member monthly fee override. NULL means use settings default.');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'monthly_fee')) {
                $table->dropColumn('monthly_fee');
            }
        });
    }
};
