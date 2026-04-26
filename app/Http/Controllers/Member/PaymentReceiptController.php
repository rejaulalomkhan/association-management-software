<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\PdfService;

class PaymentReceiptController extends Controller
{
    public function preview($paymentId)
    {
        $payment = Payment::with(['user', 'paymentMethod', 'approver'])->findOrFail($paymentId);

        // Check if payment belongs to the user (for member access) or user is admin
        $user = auth()->user();
        $isAdmin = $user->hasRole('admin') || $user->hasRole('super-admin') || $user->hasRole('accountant');

        if (!$isAdmin && $payment->user_id !== $user->id) {
            abort(403, 'আপনি এই রিসিপ্ট দেখার অনুমোদন নেই।');
        }

        return view('member.payment-receipt-preview', compact('payment'));
    }

    public function download($paymentId)
    {
        $payment = Payment::with(['user', 'paymentMethod', 'approver'])->findOrFail($paymentId);

        // Check if payment belongs to the user (for member access) or user is admin
        $user = auth()->user();
        $isAdmin = $user->hasRole('admin') || $user->hasRole('super-admin') || $user->hasRole('accountant');

        if (!$isAdmin && $payment->user_id !== $user->id) {
            abort(403, 'আপনি এই রিসিপ্ট ডাউনলোড করার অনুমোদন নেই।');
        }

        if ($payment->status !== 'approved') {
            abort(403, 'রসিদ শুধুমাত্র অনুমোদিত পেমেন্টের জন্য পাওয়া যায়।');
        }

        $fileName = 'receipt-' . ($payment->transaction_id ?: $payment->id) . '.pdf';

        return app(PdfService::class)->downloadFromView(
            'pdf.payment-receipt',
            ['payment' => $payment],
            $fileName,
            'A4',
            'P',
            [
                'margin_left' => 0,
                'margin_right' => 0,
                'margin_top' => 0,
                'margin_bottom' => 0,
                'margin_header' => 0,
                'margin_footer' => 0,
                'img_dpi' => 72,
                'mode' => 'c',
            ]
        );
    }
}