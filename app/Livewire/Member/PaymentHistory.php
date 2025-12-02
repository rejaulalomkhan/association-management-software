<?php

namespace App\Livewire\Member;

use Livewire\Component;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentHistory extends Component
{
    public function downloadReceipt($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);

        if ($payment->user_id !== Auth::id()) {
            abort(403);
        }

        if ($payment->status !== 'approved') {
            session()->flash('error', 'Receipt is only available for approved payments.');
            return;
        }

        $pdf = Pdf::loadView('pdf.receipt', ['payment' => $payment]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'receipt-' . $payment->transaction_id . '.pdf');
    }

    public function render()
    {
        $payments = Auth::user()->payments()->latest()->paginate(10);

        return view('livewire.member.payment-history', [
            'payments' => $payments
        ])->layout('layouts.app');
    }
}
