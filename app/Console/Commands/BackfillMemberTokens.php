<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

/**
 * Generate verification tokens for active members that don't yet have one.
 * Idempotent – safe to run multiple times.
 */
class BackfillMemberTokens extends Command
{
    protected $signature = 'members:backfill-tokens
        {--all : Include non-active members as well}';

    protected $description = 'Issue public verification (QR) tokens to members that are missing one.';

    public function handle(): int
    {
        $query = User::whereNull('verification_token')
            ->whereHas('roles', function ($q) {
                $q->where('slug', 'member');
            });

        if (!$this->option('all')) {
            $query->where('status', 'active');
        }

        $total = (clone $query)->count();

        if ($total === 0) {
            $this->info('No members needed a token – everyone is already set.');
            return self::SUCCESS;
        }

        $this->info("Generating verification tokens for {$total} member(s)...");

        $bar = $this->output->createProgressBar($total);
        $bar->start();

        $query->chunkById(100, function ($users) use ($bar) {
            foreach ($users as $user) {
                $user->ensureVerificationToken();
                $bar->advance();
            }
        });

        $bar->finish();
        $this->newLine(2);
        $this->info('Done.');

        return self::SUCCESS;
    }
}
