<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Adds payment-term awareness to the schema.
 *
 * - `users.payment_term`   nullable string — per-member override. NULL means
 *                          "follow the organization-wide default from
 *                          `settings.payment_term`".
 * - `payments.term`        string with default 'monthly' — records what
 *                          kind of payment this row represents so dues
 *                          calculation can tell a yearly lump sum apart
 *                          from a single month.
 *
 * All existing `payments` rows are backfilled to 'monthly' (the only
 * flow the app supported before this migration).
 */
return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'payment_term')) {
                $table->string('payment_term', 20)
                    ->nullable()
                    ->after('monthly_fee')
                    ->comment('Per-member payment-term override: monthly|yearly. NULL = use settings default.');
            }
        });

        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn('payments', 'term')) {
                $table->string('term', 20)
                    ->default('monthly')
                    ->after('year')
                    ->index()
                    ->comment('What kind of payment this row represents: monthly|yearly.');
            }
        });

        // Safety net: stamp every pre-existing row as 'monthly' so the
        // new term-aware dues calculation keeps matching historical data.
        DB::table('payments')->whereNull('term')->update(['term' => 'monthly']);
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            if (Schema::hasColumn('payments', 'term')) {
                $table->dropColumn('term');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'payment_term')) {
                $table->dropColumn('payment_term');
            }
        });
    }
};
