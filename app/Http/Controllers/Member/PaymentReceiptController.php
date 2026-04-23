<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentReceiptController extends Controller
{
    public function preview($paymentId)
    {
        $payment = Payment::with(['user', 'paymentMethod', 'approver'])
            ->where('user_id', auth()->id())
            ->findOrFail($paymentId);

        return view('member.payment-receipt-preview', compact('payment'));
    }

    public function download($paymentId)
    {
        $payment = Payment::with(['user', 'paymentMethod', 'approver'])
            ->where('user_id', auth()->id())
            ->findOrFail($paymentId);

        if ($payment->status !== 'approved') {
            abort(403, 'রসিদ শুধুমাত্র অনুমোদিত পেমেন্টের জন্য পাওয়া যায়।');
        }

        return redirect()->route('member.payments.receipt.preview', $payment->id);
    }
}
