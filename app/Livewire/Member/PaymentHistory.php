<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentHistory extends Component
{
    use WithPagination;

    public $filterMonth = '';
    public $filterYear = '';
    public $filterStatus = '';
    public $selectedPayment = null;
    public $showDetailsModal = false;

    protected $queryString = [
        'filterMonth' => ['except' => ''],
        'filterYear' => ['except' => ''],
        'filterStatus' => ['except' => '']
    ];

    public function updatingFilterMonth()
    {
        $this->resetPage();
    }

    public function updatingFilterYear()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function viewDetails($paymentId)
    {
        $this->selectedPayment = Payment::with('paymentMethod')->findOrFail($paymentId);

        if ($this->selectedPayment->user_id !== Auth::id()) {
            abort(403);
        }

        $this->showDetailsModal = true;
    }

    public function closeModal()
    {
        $this->showDetailsModal = false;
        $this->selectedPayment = null;
    }

    public function downloadReceipt($paymentId)
    {
        $payment = Payment::with(['user', 'paymentMethod'])->findOrFail($paymentId);

        if ($payment->user_id !== Auth::id()) {
            abort(403);
        }

        if ($payment->status !== 'approved') {
            session()->flash('error', 'রসিদ শুধুমাত্র অনুমোদিত পেমেন্টের জন্য পাওয়া যায়।');
            return;
        }

        $pdf = Pdf::loadView('pdf.receipt', ['payment' => $payment]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'receipt-' . $payment->transaction_id . '.pdf');
    }

    public function render()
    {
        $query = Auth::user()->payments()->with('paymentMethod');

        if ($this->filterMonth) {
            $query->where('month', $this->filterMonth);
        }

        if ($this->filterYear) {
            $query->where('year', $this->filterYear);
        }

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        $payments = $query->latest()->paginate(15);

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

        return view('livewire.member.payment-history', [
            'payments' => $payments,
            'months' => $months,
            'years' => $years
        ])->layout('layouts.app');
    }
}
