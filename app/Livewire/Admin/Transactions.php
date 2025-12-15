<?php

namespace App\Livewire\Admin;

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

        // Configure mPDF
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $path = public_path() . "/fonts";
        
        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'orientation' => 'P',
            'fontDir' => array_merge($fontDirs, [$path]),
            'fontdata' => $fontData + [
                'solaimanlipi' => [
                    'R' => 'SolaimanLipi.ttf',
                    'useOTL' => 0xFF,
                ],
            ],
            'default_font' => 'solaimanlipi'
        ]);

        $html = view('pdf.transactions-report', [
            'transactions' => $transactions,
            'month' => $this->selectedMonth,
            'year' => $this->selectedYear,
        ])->render();
        $mpdf->WriteHTML($html);

        return response()->streamDownload(function() use ($mpdf) {
            echo $mpdf->Output('', 'S');
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

        // Configure mPDF
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $path = public_path() . "/fonts";
        
        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'orientation' => 'P',
            'fontDir' => array_merge($fontDirs, [$path]),
            'fontdata' => $fontData + [
                'solaimanlipi' => [
                    'R' => 'SolaimanLipi.ttf',
                    'useOTL' => 0xFF,
                ],
            ],
            'default_font' => 'solaimanlipi'
        ]);

        $html = view('pdf.payment-receipt', ['payment' => $payment])->render();
        $mpdf->WriteHTML($html);

        $fileName = 'receipt-' . ($payment->transaction_id ?: ($payment->id)) . '.pdf';

        return response()->streamDownload(function () use ($mpdf) {
            echo $mpdf->Output('', 'S');
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
