<?php

namespace App\Livewire\Accountant;

use App\Models\Payment;
use App\Models\User;
use App\Helpers\NotificationHelper;
use Livewire\Component;
use Livewire\WithPagination;

class Transactions extends Component
{
    use WithPagination;

    public $selectedMonth = '';
    public $selectedYear = '';
    public $selectedStatus = '';
    public $processingNote = '';
    public $selectedPaymentId = null;

    public function mount()
    {
        $this->selectedMonth = date('n');
        $this->selectedYear = date('Y');
    }

    public function updatingSelectedMonth()
    {
        $this->resetPage();
    }

    public function updatingSelectedYear()
    {
        $this->resetPage();
    }

    public function updatingSelectedStatus()
    {
        $this->resetPage();
    }

    public function processPayment($paymentId, $action)
    {
        $payment = Payment::findOrFail($paymentId);

        if ($action === 'approve') {
            $payment->status = 'approved';
            $notificationMessage = "আপনার {$payment->month}/{$payment->year} মাসের পেমেন্ট অনুমোদিত হয়েছে";
        } else {
            $payment->status = 'rejected';
            $notificationMessage = "আপনার {$payment->month}/{$payment->year} মাসের পেমেন্ট প্রত্যাখ্যান করা হয়েছে";
        }

        $payment->save();

        // Send notification
        NotificationHelper::create(
            $payment->user_id,
            $action === 'approve' ? 'payment_approved' : 'payment_rejected',
            $notificationMessage
        );

        session()->flash('success', $action === 'approve' ? 'পেমেন্ট অনুমোদিত হয়েছে' : 'পেমেন্ট প্রত্যাখ্যান করা হয়েছে');
    }

    public function openNoteModal($paymentId)
    {
        $this->selectedPaymentId = $paymentId;
        $payment = Payment::find($paymentId);
        $this->processingNote = $payment->admin_note ?? '';
        $this->dispatch('open-note-modal');
    }

    public function saveNote()
    {
        if ($this->selectedPaymentId) {
            $payment = Payment::findOrFail($this->selectedPaymentId);
            $payment->admin_note = $this->processingNote;
            $payment->save();

            session()->flash('success', 'নোট সংরক্ষিত হয়েছে');
            $this->dispatch('close-note-modal');
            $this->reset(['selectedPaymentId', 'processingNote']);
        }
    }

    public function render()
    {
        $query = Payment::with(['user', 'paymentMethod']);

        if ($this->selectedMonth) {
            $query->where('month', $this->selectedMonth);
        }

        if ($this->selectedYear) {
            $query->where('year', $this->selectedYear);
        }

        if ($this->selectedStatus) {
            $query->where('status', $this->selectedStatus);
        }

        $transactions = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('livewire.accountant.transactions', [
            'transactions' => $transactions,
        ])->layout('layouts.app');
    }
}
