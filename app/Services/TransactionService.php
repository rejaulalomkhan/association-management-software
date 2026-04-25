<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * Service for handling payment transactions.
 *
 * This service manages payment creation, approval, rejection,
 * and statistics generation for the payment system.
 */
class TransactionService
{
    /**
     * Create a new TransactionService instance.
     *
     * @param SettingsService $settingsService The settings service instance
     */
    public function __construct(
        private SettingsService $settingsService
    ) {}

    /**
     * Create a new payment transaction.
     *
     * @param User $user The user making the payment
     * @param array $data Payment data including amount, method, month, year
     * @return Payment The created payment record
     */
    public function createPayment(User $user, array $data): Payment
    {
        $data['user_id'] = $user->id;
        $data['transaction_id'] = $this->generateTransactionId();
        $data['status'] = 'pending';

        return Payment::create($data);
    }

    /**
     * Generate unique transaction ID.
     *
     * Format: TXN-YYYYMMDDHHMMSS-XXXX (e.g., TXN-20260425143000-A1B2)
     *
     * @return string The generated transaction ID
     */
    public function generateTransactionId(): string
    {
        return 'TXN-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4));
    }

    /**
     * Approve a payment.
     *
     * @param Payment $payment The payment to approve
     * @param User $approver The admin/accountant approving the payment
     * @param string|null $note Optional admin note for the approval
     * @return bool True if approval was successful
     */
    public function approvePayment(Payment $payment, User $approver, ?string $note = null): bool
    {
        $payment->status = 'approved';
        $payment->processed_by = $approver->id;
        $payment->processed_at = now();

        if ($note) {
            $payment->admin_note = $note;
        }

        return $payment->save();
    }

    /**
     * Reject a payment.
     *
     * @param Payment $payment The payment to reject
     * @param User $approver The admin/accountant rejecting the payment
     * @param string $reason The reason for rejection
     * @return bool True if rejection was successful
     */
    public function rejectPayment(Payment $payment, User $approver, string $reason): bool
    {
        $payment->status = 'rejected';
        $payment->processed_by = $approver->id;
        $payment->processed_at = now();
        $payment->admin_note = $reason;

        return $payment->save();
    }

    /**
     * Get summary statistics based on filters.
     *
     * Returns paid/pending/rejected amounts and counts, plus collection rate
     * when a specific month and year are provided.
     *
     * @param string|null $month Month name filter (e.g., 'January')
     * @param int|null $year Year filter
     * @return array Statistics array with keys: total_paid, total_pending, etc.
     */
    public function getStatsSummary(?string $month = null, ?int $year = null): array
    {
        $payments = Payment::query();

        if ($month) {
            $payments->where('month', $month);
        }
        if ($year) {
            $payments->where('year', $year);
        }

        $totalPaid = $payments->clone()->where('status', 'approved')->sum('amount');
        $totalPending = $payments->clone()->where('status', 'pending')->sum('amount');
        $totalRejected = $payments->clone()->where('status', 'rejected')->sum('amount');

        $paidCount = $payments->clone()->where('status', 'approved')->count();
        $pendingCount = $payments->clone()->where('status', 'pending')->count();
        $rejectedCount = $payments->clone()->where('status', 'rejected')->count();

        $totalMembers = User::where('status', 'active')
            ->whereHas('roles', function($q) {
                $q->where('name', 'member');
            })->count();

        // Calculate unpaid count only if specific month/year is selected
        // Otherwise, it doesn't make sense to subtract transaction count from member count
        $unpaidCount = 0;
        $collectionRate = 0;

        if ($month && $year) {
            $unpaidCount = max(0, $totalMembers - $paidCount);
            $collectionRate = $totalMembers > 0 ? round(($paidCount / $totalMembers) * 100, 2) : 0;
        }

        return [
            'month' => $month,
            'year' => $year,
            'total_paid' => $totalPaid,
            'total_pending' => $totalPending,
            'total_rejected' => $totalRejected,
            'paid_count' => $paidCount,
            'pending_count' => $pendingCount,
            'rejected_count' => $rejectedCount,
            'unpaid_count' => $unpaidCount,
            'total_members' => $totalMembers,
            'collection_rate' => $collectionRate,
        ];
    }

    /**
     * Get yearly summary statistics.
     *
     * @param int|null $year Year filter (defaults to current year)
     * @return array Statistics array for the specified year
     */
    public function getYearlySummary(int $year = null): array
    {
        if (!$year) {
            $year = now()->year;
        }

        $payments = Payment::where('year', $year);

        $totalPaid = $payments->clone()->where('status', 'approved')->sum('amount');
        $totalPending = $payments->clone()->where('status', 'pending')->sum('amount');
        $totalRejected = $payments->clone()->where('status', 'rejected')->sum('amount');

        $paidCount = $payments->clone()->where('status', 'approved')->count();
        $pendingCount = $payments->clone()->where('status', 'pending')->count();
        $rejectedCount = $payments->clone()->where('status', 'rejected')->count();

        return [
            'year' => $year,
            'total_paid' => $totalPaid,
            'total_pending' => $totalPending,
            'total_rejected' => $totalRejected,
            'paid_count' => $paidCount,
            'pending_count' => $pendingCount,
            'rejected_count' => $rejectedCount,
        ];
    }

    /**
     * Get member transactions with optional filters.
     *
     * @param User $user The user to get transactions for
     * @param array $filters Optional filters: month, year, status
     * @return \Illuminate\Database\Eloquent\Collection Collection of Payment models
     */
    public function getMemberTransactions(User $user, array $filters = []): \Illuminate\Database\Eloquent\Collection
    {
        $query = $user->payments()->with(['paymentMethod', 'approver']);

        if (isset($filters['month'])) {
            $query->where('month', $filters['month']);
        }

        if (isset($filters['year'])) {
            $query->where('year', $filters['year']);
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->orderBy('year', 'desc')
            ->orderByRaw("FIELD(month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December') DESC")
            ->get();
    }
}
