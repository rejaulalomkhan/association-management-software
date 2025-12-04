<?php

namespace App\Livewire\Admin;

use App\Services\SettingsService;
use App\Models\PaymentMethod;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    public $organization_name;
    public $organization_name_en;
    public $organization_established_year;
    public $organization_established_month;
    public $monthly_fee;
    public $organization_address;
    public $organization_phone;
    public $organization_logo;
    public $new_logo;

    public $paymentMethods = [];
    public $newMethodName = '';
    public $newMethodNameBn = '';

    public $successMessage = '';

    public function mount(SettingsService $settingsService)
    {
        $settings = $settingsService->getOrganizationSettings();

        $this->organization_name = $settings['organization_name'];
        $this->organization_name_en = $settings['organization_name_en'];
        $this->organization_established_year = $settings['organization_established_year'];
        $this->organization_established_month = $settings['organization_established_month'];
        $this->monthly_fee = $settings['monthly_fee'];
        $this->organization_address = $settings['organization_address'];
        $this->organization_phone = $settings['organization_phone'];
        $this->organization_logo = $settings['organization_logo'];

        $this->loadPaymentMethods();
    }

    public function loadPaymentMethods()
    {
        $this->paymentMethods = PaymentMethod::orderBy('order')->get()->toArray();
    }

    public function saveSettings(SettingsService $settingsService)
    {
        $this->validate([
            'organization_name' => 'required|string|max:255',
            'organization_name_en' => 'required|string|max:255',
            'organization_established_year' => 'required|integer|min:2000|max:2100',
            'organization_established_month' => 'required|integer|min:1|max:12',
            'monthly_fee' => 'required|numeric|min:0',
            'organization_address' => 'nullable|string',
            'organization_phone' => 'nullable|string|max:20',
            'new_logo' => 'nullable|image|max:2048',
        ]);

        if ($this->new_logo) {
            $logoPath = $this->new_logo->store('logos', 'public');
            $settingsService->set('organization_logo', $logoPath);
            $this->organization_logo = $logoPath;
        }

        $settingsService->set('organization_name', $this->organization_name);
        $settingsService->set('organization_name_en', $this->organization_name_en);
        $settingsService->set('organization_established_year', $this->organization_established_year);
        $settingsService->set('organization_established_month', $this->organization_established_month);
        $settingsService->set('monthly_fee', $this->monthly_fee);
        $settingsService->set('organization_address', $this->organization_address);
        $settingsService->set('organization_phone', $this->organization_phone);

        $this->successMessage = 'সেটিংস সফলভাবে সংরক্ষিত হয়েছে!';
        $this->new_logo = null;
    }

    public function addPaymentMethod()
    {
        $this->validate([
            'newMethodName' => 'required|string|max:255',
            'newMethodNameBn' => 'nullable|string|max:255',
        ]);

        $lastOrder = PaymentMethod::max('order') ?? 0;

        PaymentMethod::create([
            'name' => $this->newMethodName,
            'name_bn' => $this->newMethodNameBn,
            'is_active' => true,
            'order' => $lastOrder + 1,
        ]);

        $this->newMethodName = '';
        $this->newMethodNameBn = '';
        $this->loadPaymentMethods();

        $this->successMessage = 'পেমেন্ট মাধ্যম যুক্ত হয়েছে!';
    }

    public function toggleMethodStatus($methodId)
    {
        $method = PaymentMethod::find($methodId);
        if ($method) {
            $method->is_active = !$method->is_active;
            $method->save();
            $this->loadPaymentMethods();
        }
    }

    public function deletePaymentMethod($methodId)
    {
        PaymentMethod::destroy($methodId);
        $this->loadPaymentMethods();
        $this->successMessage = 'পেমেন্ট মাধ্যম মুছে ফেলা হয়েছে!';
    }

    public function render()
    {
        return view('livewire.admin.settings')->layout('layouts.app');
    }
}
