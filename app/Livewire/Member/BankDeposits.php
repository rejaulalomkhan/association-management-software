<?php

namespace App\Livewire\Member;

use App\Models\BankDeposit;
use App\Services\SettingsService;
use Livewire\Component;
use Livewire\WithPagination;

class BankDeposits extends Component
{
    use WithPagination;

    public $selectedYear;
    public $years = [];
    public $totalBalance;
    public $bankDetails;

    protected $listeners = ['depositAdded' => 'refreshData'];

    public function mount()
    {
        // Get organization start year and current year
        $settingsService = app(SettingsService::class);
        $startYear = $settingsService->get('organization_established_year', now()->year);
        $currentYear = now()->year;

        // Generate years array from start to current
        $this->years = range($currentYear, $startYear);
        
        // Add "All Years" option
        array_unshift($this->years, 'all');

        // Set default to current year
        $this->selectedYear = $currentYear;

        // Get total balance
        $this->totalBalance = BankDeposit::getTotalBalance();

        // Get bank details from settings
        $this->bankDetails = [
            'name' => $settingsService->get('bank_name', 'N/A'),
            'account_number' => $settingsService->get('bank_account_number', 'N/A'),
            'branch' => $settingsService->get('bank_branch', 'N/A'),
            'account_holder' => $settingsService->get('bank_account_holder', 'N/A'),
        ];
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
    }

    public function refreshData()
    {
        // Refresh total balance
        $this->totalBalance = BankDeposit::getTotalBalance();
        
        // Reset to first page to show latest deposits
        $this->resetPage();
    }

    public function render()
    {
        $query = BankDeposit::with('depositor')->newest();

        if ($this->selectedYear !== 'all') {
            $query->byYear($this->selectedYear);
        }

        $deposits = $query->paginate(12);

        return view('livewire.member.bank-deposits', [
            'deposits' => $deposits,
        ])->layout('layouts.app');
    }
}
