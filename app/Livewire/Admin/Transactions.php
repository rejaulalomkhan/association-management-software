<?php

namespace App\Livewire\Admin;

use App\Models\Payment;
use App\Models\User;
use App\Helpers\NotificationHelper;
use App\Services\PdfService;
use Livewire\Component;
use Livewire\WithPagination;

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
        // Check if there are pending transactions
        $pendingCount = Payment::where('status', 'pending')->count();

        // If pending transactions exist, show them by default
        if ($pendingCount > 0) {
            $this->selectedStatus = 'pending';
            $this->selectedMonth = '';
            $this->selectedYear = '';
        } else {
            // Otherwise, show current month and year as default
            $this->selectedMonth = date('n'); // Current month (1-12)
            $this->selectedYear = date('Y');  // Current year
        }
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

    public function approvePayment()
    {
        if (!$this->selectedPaymentIdForApprove) {
            return;
        }

        $payment = Payment::findOrFail($this->selectedPaymentIdForApprove);
        $payment->status = 'approved';
        $payment->processed_at = now();
        $payment->processed_by = auth()->id();
        $payment->save();

        // Send notification using helper service
        app(NotificationHelper::class)->sendPaymentApprovalNotification($payment);

        $this->isPaymentApproved = true;
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

    public $selectedPaymentForApprove = null;
    public $isPaymentApproved = false;

    public function openApproveModal($paymentId)
    {
        $this->selectedPaymentIdForApprove = $paymentId;
        $this->selectedPaymentForApprove = Payment::with('user')->find($paymentId);
        $this->isPaymentApproved = false;
        $this->dispatch('open-approve-modal');
    }

    public function rejectPaymentWithNote()
    {
        if (!$this->selectedPaymentId) {
            return;
        }

        $payment = Payment::findOrFail($this->selectedPaymentId);
        
        // Save admin note
        $payment->admin_note = $this->adminNote;
        
        // Reject payment
        $payment->status = 'rejected';
        $payment->processed_at = now();
        $payment->processed_by = auth()->id();
        $payment->save();

        // Send notification
        app(NotificationHelper::class)->sendPaymentRejectionNotification($payment, $this->adminNote ?? '');

        // Reset and close modal
        $this->selectedPaymentId = null;
        $this->adminNote = '';
        $this->dispatch('close-note-modal');

        session()->flash('success', 'পেমেন্ট প্রত্যাখ্যান করা হয়েছে');
    }

    public function exportReport(PdfService $pdfService)
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

        return $pdfService->generateTransactionsReport(
            $transactions,
            $this->selectedMonth ? date('F', mktime(0, 0, 0, (int) $this->selectedMonth, 1)) : null,
            $this->selectedYear ? (int) $this->selectedYear : null
        );
    }

    public function viewPayment($paymentId)
    {
        $this->selectedPaymentForView = Payment::with(['user', 'paymentMethod', 'approver'])->findOrFail($paymentId);
        $this->dispatch('open-view-modal');
    }

    public function downloadReceipt($paymentId, PdfService $pdfService)
    {
        $payment = Payment::with(['user', 'paymentMethod', 'approver'])->findOrFail($paymentId);

        if ($payment->status !== 'approved') {
            session()->flash('success', 'শুধু অনুমোদিত পেমেন্টের রিসিপ্ট ডাউনলোড করা যাবে।');
            return;
        }

        return $pdfService->generatePaymentReceipt($payment);
    }

    public function deletePayment($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);

        // Only pending payments can be deleted
        if ($payment->status !== 'pending') {
            session()->flash('success', 'শুধু অপেক্ষমান পেমেন্ট মুছে ফেলা যায়।');
            return;
        }

        $payment->delete();

        session()->flash('success', 'পেমেন্ট সফলভাবে মুছে ফেলা হয়েছে।');
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

        $settingsService = app(\App\Services\SettingsService::class);
        $establishedYear = (int) $settingsService->get('organization_established_year', 2024);
        $currentYear = (int) date('Y');
        
        // Ensure established year is not in the future
        if ($establishedYear > $currentYear) {
            $establishedYear = $currentYear;
        }

        $years = range($currentYear, $establishedYear);

        return view('livewire.admin.transactions', [
            'transactions' => $transactions,
            'members' => $members,
            'years' => $years,
        ])->layout('layouts.app');
    }
}
