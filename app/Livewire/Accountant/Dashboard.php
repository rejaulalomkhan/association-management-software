<?php

namespace App\Livewire\Accountant;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payment;
use App\Services\TransactionService;

class Dashboard extends Component
{
    use WithPagination;

    public $selectedPayment = null;
    public $showDetailsModal = false;
    public $approvalNote = '';
    public $rejectionReason = '';
    public $filterMonth = '';
    public $filterYear = '';

    protected $transactionService;

    public function boot(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function updatingFilterMonth()
    {
        $this->resetPage();
    }

    public function updatingFilterYear()
    {
        $this->resetPage();
    }

    public function viewDetails($paymentId)
    {
        $this->selectedPayment = Payment::with(['user', 'paymentMethod'])->findOrFail($paymentId);
        $this->showDetailsModal = true;
    }

    public function closeModal()
    {
        $this->showDetailsModal = false;
        $this->selectedPayment = null;
        $this->approvalNote = '';
        $this->rejectionReason = '';
    }

    public function approvePayment()
    {
        if (!$this->selectedPayment) {
            return;
        }

        $this->transactionService->approvePayment($this->selectedPayment->id, $this->approvalNote);

        session()->flash('success', 'পেমেন্ট সফলভাবে অনুমোদিত হয়েছে!');
        $this->closeModal();
        $this->resetPage();
    }

    public function rejectPayment()
    {
        if (!$this->selectedPayment || !$this->rejectionReason) {
            session()->flash('error', 'প্রত্যাখ্যানের কারণ প্রদান করুন।');
            return;
        }

        $this->transactionService->rejectPayment($this->selectedPayment->id, $this->rejectionReason);

        session()->flash('success', 'পেমেন্ট প্রত্যাখ্যাত হয়েছে।');
        $this->closeModal();
        $this->resetPage();
    }

    public function render()
    {
        $query = Payment::where('status', 'pending')->with(['user', 'paymentMethod']);

        if ($this->filterMonth) {
            $query->where('month', $this->filterMonth);
        }

        if ($this->filterYear) {
            $query->where('year', $this->filterYear);
        }

        $pendingPayments = $query->latest()->paginate(15);

        $stats = [
            'pending' => Payment::where('status', 'pending')->count(),
            'approved_today' => Payment::where('status', 'approved')
                ->whereDate('approved_at', today())
                ->count(),
            'total_amount_today' => Payment::where('status', 'approved')
                ->whereDate('approved_at', today())
                ->sum('amount'),
            'rejected_today' => Payment::where('status', 'rejected')
                ->whereDate('updated_at', today())
                ->count(),
        ];

        $months = [
            'January' => 'জানুয়ারি',
            'February' => 'ফেব্রুয়ারি',
            'March' => 'মার্চ',
            'April' => 'এপ্রিল',
            'May' => 'মে',
            'June' => 'জুন',
            'July' => 'জুলাই',
            'August' => 'আগস্ট',
            'September' => 'সেপ্টেম্বর',
            'October' => 'অক্টোবর',
            'November' => 'নভেম্বর',
            'December' => 'ডিসেম্বর'
        ];

        $years = range(date('Y'), date('Y') - 5);

        return view('livewire.accountant.dashboard', [
            'pendingPayments' => $pendingPayments,
            'stats' => $stats,
            'months' => $months,
            'years' => $years
        ])->layout('layouts.app');
    }
}
