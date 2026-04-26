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
    public $payment_term;
    public $organization_address;
    public $organization_phone;
    public $organization_email;
    public $organization_logo;
    public $new_logo;

    // Bank Account Fields
    public $bank_name;
    public $bank_account_number;
    public $bank_branch;
    public $bank_account_holder;

    // Registration Terms & Conditions (shown on /register)
    public $registration_terms;
    public $registration_terms_acceptance_label;

    // PWA Settings
    public $pwa_short_name;
    public $pwa_theme_color;
    public $pwa_background_color;
    public $pwa_new_icon_192;
    public $pwa_new_icon_512;
    public $pwa_current_icon_192;
    public $pwa_current_icon_512;

    public $paymentMethods = [];
    public $newMethodName = '';
    public $newMethodNameBn = '';

    // UI state: currently active tab (organization | bank | payment-methods | terms | pwa)
    public string $activeTab = 'organization';

    public $successMessage = '';

    public function mount(SettingsService $settingsService)
    {
        $settings = $settingsService->getOrganizationSettings();

        $this->organization_name = $settings['organization_name'];
        $this->organization_name_en = $settings['organization_name_en'];
        $this->organization_established_year = $settings['organization_established_year'];
        $this->organization_established_month = $settings['organization_established_month'];
        $this->monthly_fee = $settings['monthly_fee'];
        $this->payment_term = \App\Enums\PaymentTerm::coerce((string) ($settings['payment_term'] ?? ''))
            ?? \App\Enums\PaymentTerm::MONTHLY;
        $this->organization_address = $settings['organization_address'];
        $this->organization_phone = $settings['organization_phone'];
        $this->organization_email = $settings['organization_email'] ?? '';
        $this->organization_logo = $settings['organization_logo'];

        // Load bank account details
        $this->bank_name = $settingsService->get('bank_name', '');
        $this->bank_account_number = $settingsService->get('bank_account_number', '');
        $this->bank_branch = $settingsService->get('bank_branch', '');
        $this->bank_account_holder = $settingsService->get('bank_account_holder', '');

        // Registration terms
        $this->registration_terms = $settingsService->get('registration_terms', '');
        $this->registration_terms_acceptance_label = $settingsService->get(
            'registration_terms_acceptance_label',
            'আমি উপরের সকল শর্তাবলী পড়েছি এবং সম্মত হয়েছি।'
        );

        // PWA Settings
        $this->pwa_short_name = $settingsService->get('pwa_short_name', mb_substr($this->organization_name, 0, 12));
        $this->pwa_theme_color = $settingsService->get('pwa_theme_color', '#3b82f6');
        $this->pwa_background_color = $settingsService->get('pwa_background_color', '#ffffff');
        $this->pwa_current_icon_192 = $settingsService->get('pwa_icon_192', '');
        $this->pwa_current_icon_512 = $settingsService->get('pwa_icon_512', '');

        $this->loadPaymentMethods();
    }

    /**
     * Switch which tab is shown in the settings UI.
     */
    public function setTab(string $tab): void
    {
        $this->activeTab = in_array($tab, ['organization', 'bank', 'payment-methods', 'terms', 'pwa'], true)
            ? $tab
            : 'organization';
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
            'payment_term' => 'required|in:' . implode(',', \App\Enums\PaymentTerm::all()),
            'organization_address' => 'nullable|string',
            'organization_phone' => 'nullable|string|max:20',
            'organization_email' => 'nullable|email|max:255',
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
        $settingsService->set('payment_term', $this->payment_term);
        $settingsService->set('organization_address', $this->organization_address);
        $settingsService->set('organization_phone', $this->organization_phone);
        $settingsService->set('organization_email', $this->organization_email);

        // Save bank account details
        $settingsService->set('bank_name', $this->bank_name);
        $settingsService->set('bank_account_number', $this->bank_account_number);
        $settingsService->set('bank_branch', $this->bank_branch);
        $settingsService->set('bank_account_holder', $this->bank_account_holder);

        $this->successMessage = 'সেটিংস সফলভাবে সংরক্ষিত হয়েছে!';
        $this->new_logo = null;
    }

    /**
     * Save only the "Terms & Conditions" tab so the admin can edit it
     * independently without having to re-submit the whole settings form.
     */
    public function saveTerms(SettingsService $settingsService): void
    {
        $this->validate([
            'registration_terms' => 'required|string|max:65000',
            'registration_terms_acceptance_label' => 'required|string|max:1000',
        ], [], [
            'registration_terms' => 'শর্তাবলী কনটেন্ট',
            'registration_terms_acceptance_label' => 'সম্মতি চেকবক্সের লেখা',
        ]);

        $settingsService->set('registration_terms', $this->registration_terms);
        $settingsService->set(
            'registration_terms_acceptance_label',
            $this->registration_terms_acceptance_label
        );

        $this->successMessage = 'শর্তাবলী সফলভাবে সংরক্ষিত হয়েছে!';
    }

    /**
     * Reset the terms content to the built-in default (re-runs the seeder logic
     * by forgetting the current value and re-reading — used by a "Reset" button).
     */
    public function resetTermsToDefault(SettingsService $settingsService): void
    {
        // Clear the current setting so the seeder can re-seed it with firstOrCreate.
        \App\Models\Setting::where('key', 'registration_terms')->delete();
        \App\Models\Setting::where('key', 'registration_terms_acceptance_label')->delete();
        $settingsService->clearCache();

        (new \Database\Seeders\RegistrationTermsSeeder())->run();

        // Reload into component state
        $this->registration_terms = $settingsService->get('registration_terms', '');
        $this->registration_terms_acceptance_label = $settingsService->get(
            'registration_terms_acceptance_label',
            ''
        );

        $this->successMessage = 'শর্তাবলী ডিফল্টে রিসেট করা হয়েছে।';
    }

    /**
     * Save PWA settings (app name, colors, icons).
     */
    public function savePwaSettings(SettingsService $settingsService): void
    {
        $this->validate([
            'pwa_short_name' => 'required|string|max:20',
            'pwa_theme_color' => 'required|string|regex:/^#[a-fA-F0-9]{6}$/',
            'pwa_background_color' => 'required|string|regex:/^#[a-fA-F0-9]{6}$/',
            'pwa_new_icon_192' => 'nullable|image|max:512|mimes:png',
            'pwa_new_icon_512' => 'nullable|image|max:2048|mimes:png',
        ], [
            'pwa_theme_color.regex' => 'Theme color must be a valid hex color (e.g., #3b82f6)',
            'pwa_background_color.regex' => 'Background color must be a valid hex color (e.g., #ffffff)',
        ], [
            'pwa_short_name' => 'Short Name',
            'pwa_theme_color' => 'Theme Color',
            'pwa_background_color' => 'Background Color',
            'pwa_new_icon_192' => 'Icon 192x192',
            'pwa_new_icon_512' => 'Icon 512x512',
        ]);

        // Save text settings
        $settingsService->set('pwa_short_name', $this->pwa_short_name);
        $settingsService->set('pwa_theme_color', $this->pwa_theme_color);
        $settingsService->set('pwa_background_color', $this->pwa_background_color);

        // Upload and save 192x192 icon
        if ($this->pwa_new_icon_192) {
            $icon192Path = $this->pwa_new_icon_192->store('pwa-icons', 'public');
            $settingsService->set('pwa_icon_192', $icon192Path);
            $this->pwa_current_icon_192 = $icon192Path;
        }

        // Upload and save 512x512 icon
        if ($this->pwa_new_icon_512) {
            $icon512Path = $this->pwa_new_icon_512->store('pwa-icons', 'public');
            $settingsService->set('pwa_icon_512', $icon512Path);
            $this->pwa_current_icon_512 = $icon512Path;
        }

        $this->successMessage = 'PWA সেটিংস সফলভাবে সংরক্ষিত হয়েছে!';
        $this->pwa_new_icon_192 = null;
        $this->pwa_new_icon_512 = null;
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
