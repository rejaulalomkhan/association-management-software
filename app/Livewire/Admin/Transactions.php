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
        $payment->save();

        // Send notification
        NotificationHelper::create(
            $payment->user_id,
            'payment_approved',
            "আপনার {$payment->month}/{$payment->year} মাসের পেমেন্ট অনুমোদিত হয়েছে"
        );

        session()->flash('success', 'পেমেন্ট অনুমোদিত হয়েছে');
    }

    public function rejectPayment($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $payment->status = 'rejected';
        $payment->save();

        // Send notification
        NotificationHelper::create(
            $payment->user_id,
            'payment_rejected',
            "আপনার {$payment->month}/{$payment->year} মাসের পেমেন্ট প্রত্যাখ্যান করা হয়েছে"
        );

        session()->flash('success', 'পেমেন্ট প্রত্যাখ্যান করা হয়েছে');
    }

    public function openNoteModal($paymentId)
    {
        $this->selectedPaymentId = $paymentId;
        $payment = Payment::find($paymentId);
        $this->adminNote = $payment->admin_note ?? '';
        $this->dispatch('open-note-modal');
    }

    public function saveNote()
    {
        if ($this->selectedPaymentId) {
            $payment = Payment::findOrFail($this->selectedPaymentId);
            $payment->admin_note = $this->adminNote;
            $payment->save();

            session()->flash('success', 'নোট সংরক্ষিত হয়েছে');
            $this->dispatch('close-note-modal');
            $this->reset(['selectedPaymentId', 'adminNote']);
        }
    }

    public function exportReport()
    {
        $query = Payment::with(['user', 'paymentMethod']);

        if ($this->selectedMonth) {
            $query->where('month', $this->selectedMonth);
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

    public function render()
    {
        $query = Payment::with(['user', 'paymentMethod']);

        if ($this->selectedMonth) {
            $query->where('month', $this->selectedMonth);
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

        $transactions = $query->orderBy('created_at', 'desc')->paginate(15);
        $members = User::whereHas('roles', function($q) {
                $q->where('slug', 'member');
            })
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('livewire.admin.transactions', [
            'transactions' => $transactions,
         