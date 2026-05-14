<?php

namespace App\Enums;

/**
 * Payment billing cadence for a member.
 *
 * This enum is the single source of truth for every "term" value used in
 * `settings.payment_term`, `users.payment_term` and `payments.term`.
 * Keep the strings short and DB-stable.
 */
final class PaymentTerm
{
    public const MONTHLY = 'monthly';
    public const YEARLY  = 'yearly';

    /**
     * All values, in display order (for dropdowns).
     *
     * @return array<int, string>
     */
    public static function all(): array
    {
        return [self::MONTHLY, self::YEARLY];
    }

    /**
     * Validate an arbitrary value; returns it if known, null otherwise.
     */
    public static function coerce(?string $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }
        $value = strtolower(trim($value));
        return in_array($value, self::all(), true) ? $value : null;
    }

    /**
     * Bangla human label for a term value (used in admin/member UI).
     */
    public static function label(string $term): string
    {
        return match ($term) {
            self::YEARLY => 'বাৎসরিক',
            default      => 'মাসিক',
        };
    }

    /**
     * Short CSS color theme name used by Tailwind badges.
     */
    public static function colorTheme(string $term): string
    {
        return match ($term) {
            self::YEARLY => 'blue',
            default      => 'green',
        };
    }
}
