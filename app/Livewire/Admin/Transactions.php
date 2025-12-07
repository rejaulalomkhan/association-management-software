<?php

namespace App\Livewire\Admin;

use App\Models\Payment;
use App\Models\User;
use App\Helpers\NotificationHelper;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class Transactions extends Component
{
    use WithPagination;

    public $selectedMonth = '';
    public $selectedYear = '';
    public $selectedMember = '';
    public $selectedStatus = '';
    public $adminNote = '';
    public $selectedPaymentId = null;
    public $selectedPaymentForView = null;
    public $selectedPaymentIdForApprove = null;

    public function mount()
    {
        // Initialize with current month and year as default
        // Use string type to match select option values
        $this->selectedMonth = date('n'); // Current month (1-12) as string
        $this->selectedYear = date('Y');  // Current year as string
    }

    public function updatingSelectedMonth()
    {
        $this->resetPage();
    }

    public function updatingSelectedYear()
    {
        $this->resetPage();
    }

    public function updatingSelectedMember()
    {
        $this->resetPage();
    }

    public function updatingSelectedStatus()
    {
        $this->resetPage();
    }

    public function approvePayment($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $payment->status = 'approved';
        $payment->processed_at = now();
        $payment->processed_by = auth()->id();
        $payment->save();

        // Send notification using helper service
        app(NotificationHelper::class)->sendPaymentApprovalNotification($payment);

        session()->flash('success', 'পেমেন্ট অনুমোদিত হয়েছে');
    }

    public function rejectPayment($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $payment->status = 'rejected';
        $payment->processed_at = now();
        $payment->processed_by = auth()->id();
        $payment->save();

        // Send notification using helper service
        app(NotificationHelper::class)->sendPaymentRejectionNotification($payment, $this->adminNote ?? '');

        session()->flash('success', 'পেমেন্ট প্রত্যাখ্যান করা হয়েছে');
    }

    public function openNoteModal($paymentId)
    {
        $this->selectedPaymentId = $paymentId;
        $payment = Payment::find($paymentId);
        $this->adminNote = $payment->admin_note ?? '';
        $this->dispatch('open-note-modal');
    }

    public function openApproveModal($paymentId)
    {
        $this->selectedPaymentIdForApprove = $paymentId;
        $this->dispatch('open-approve-modal');
    }

    public function saveNote()
    {
        if ($this->selectedPaymentId) {
            $payment = Payment::findOrFail($this->selectedPaymentId);
            $payment->admin_note = $this->adminNote;
            $payment->save();
            // Do not auto-flash here; rejecting will handle message
        }
    }

    public function exportReport()
    {
        $query = Payment::with(['user', 'paymentMethod']);

        if ($this->selectedMonth) {
            // month column stores English month name, dropdown gives numeric month
            $englishMonth = date('F', mktime(0, 0, 0, (int) $this->selectedMonth, 1));
            $query->where('month', $englishMonth);
        }

        if ($this->selectedYear) {
            $query->where('year', $this->selectedYear);
        }

        if ($this->selectedMember) {
            $query->where('user_id', $this->selectedMember);
        }

        if ($this->selectedStatus) {
            $query->where('status', $this->selectedStatus);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('pdf.transactions-report', [
            'transactions' => $transactions,
            'month' => $this->selectedMonth,
            'year' => $this->selectedYear,
        ]);

        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->stream();
        }, 'transactions-report-' . date('Y-m-d') . '.pdf');
    }

    public function viewPayment($paymentId)
    {
        $this->selectedPaymentForView = Payment::with(['user', 'paymentMethod', 'approver'])->findOrFail($paymentId);
        $this->dispatch('open-view-modal');
    }

    public function downloadReceipt($paymentId)
    {
        $payment = Payment::with(['user', 'paymentMethod', 'approver'])->findOrFail($paymentId);

        if ($payment->status !== 'approved') {
            session()->flash('success', 'শুধু অনুমোদিত পেমেন্টের রিসিপ্ট ডাউনলোড করা যাবে।');
            return;
        }

        $pdf = Pdf::loadView('pdf.payment-receipt', [
            'payment' => $payment,
        ]);

        $fileName = 'receipt-' . ($payment->transaction_id ?: ($payment->id)) . '.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $fileName);
    }

    public function render()
    {
        $query = Payment::with(['user', 'paymentMethod']);

        if ($this->selectedMonth && $this->selectedMonth !== '') {
            // month column stores English month name, dropdown gives numeric month
            $englishMonth = date('F', mktime(0, 0, 0, (int) $this->selectedMonth, 1));
            $query->where('month', $englishMonth);
        }

        if ($this->selectedYear && $this->selectedYear !== '') {
            $query->where('year', $this->selectedYear);
        }

        if ($this->selectedMember && $this->selectedMember !== '') {
            $query->where('user_id', $this->selectedMember);
        }

        if ($this->selectedStatus && $this->selectedStatus !== '') {
            $query->where('status', $this->selectedStatus);
        }

        $transactions = $query->orderBy('created_at', 'desc')->paginate(15);
        $members = User::whereHas('roles', function($q) {
                $q->where('slug', 'member');
            })
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('livewire.admin.transactions', [
            'transactions' => $transactions,
            'members' => $members,
        ])->layout('layouts.app');
    }
}
