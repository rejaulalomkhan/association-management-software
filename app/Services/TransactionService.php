<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Str;

class TransactionService
{
    public function __construct(
        private SettingsService $settingsService
    ) {}

    /**
     * Create a new payment transaction.
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
     */
    public function generateTransactionId(): string
    {
        return 'TXN-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4));
    }

    /**
     * Approve a payment.
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
     * Get monthly summary statistics.
     */
    public function getMonthlySummary(string $month = null, int $year = null): array
    {
        if (!$month) {
            $month = now()->format('F');
        }
        if (!$year) {
            $year = now()->year;
        }

        $payments = Payment::where('month', $month)
            ->where('year', $year);

        $totalPaid = $payments->clone()->where('status', 'approved')->sum('amount');
        $totalPending = $payments->clone()->where('status', 'pending')->sum('amount');
        $totalRejected = $payments->clone()->where('status', 'rejected')->sum('amount');

        $paidCount = $payments->clone()->where('status', 'approved')->count();
        $pendingCount = $payments->clone()->where('status', 'pending')->count();
        $rejectedCount = $payments->clone()->where('status', 'rejected')->count();

        $totalMembers = User::where('status', 'active')->count();
        $unpaidCount = $totalMembers - $paidCount;

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
            'collection_rate' => $totalMembers > 0 ? round(($paidCount / $totalMembers) * 100, 2) : 0,
        ];
    }

    /**
     * Get yearly summary statistics.
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
     * Get member transactions.
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
