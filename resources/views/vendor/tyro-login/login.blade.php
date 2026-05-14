@extends('tyro-login::layouts.auth')

@section('content')
<div class="auth-container {{ $layout }}" @if($layout==='fullscreen' ) style="background-image: url('{{ $backgroundImage }}');" @endif>
    @if(in_array($layout, ['split-left', 'split-right']))
    <div class="background-panel" style="background-image: url('{{ $backgroundImage }}');">
        <div class="background-panel-content">
            <h1>{{ $pageContent['background_title'] ?? 'স্বাগতম!' }}</h1>
            <p>{{ $pageContent['background_description'] ?? 'আপনার অ্যাকাউন্টে প্রবেশ করতে সাইন ইন করুন। আপনাকে আবার দেখে আমরা আনন্দিত।' }}</p>
        </div>
    </div>
    @endif

    <div class="form-panel">
        <div class="form-card" style="padding: 1.5rem;">
            <!-- Logo -->
            <div class="logo-container" style="margin-bottom: 1rem;">
                @php
                    $orgLogo = app(\App\Services\SettingsService::class)->get('organization_logo');
                    $orgName = app(\App\Services\SettingsService::class)->get('organization_name', config('app.name'));
                @endphp
                @if($orgLogo)
                <img src="{{ asset('storage/' . $orgLogo) }}" alt="{{ $orgName }}" style="max-height: 50px; width: auto;">
                @elseif($branding['logo'] ?? false)
                <img src="{{ $branding['logo'] }}" alt="{{ $branding['app_name'] ?? config('app.name') }}">
                @else
                <div class="app-logo">
                    <svg viewBox="0 0 50 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.93v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09v-.002-21.481L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764l4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.096l3.364-1.937zM39.243 7.164l-8.006 4.609 8.006 4.609 8.005-4.61-8.005-4.608zm-.801 10.605l-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-8-4.606-9.211 5.303-8.395 4.833 7.993 4.524z" fill="currentColor" />
                    </svg>
                </div>
                @endif
                <h3 style="margin-top: 0.5rem; font-size: 1.1rem; font-weight: 600; text-align: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1.2;">{{ $orgName }}</h3>
            </div>

            <!-- Header -->
            <div class="form-header" style="margin-top: 0.75rem; margin-bottom: 1rem;">
                <h2 style="font-size: 1.25rem; margin: 0;">আপনার অ্যাকাউন্টে লগ ইন করুন</h2>
            </div>

            <!-- Error/Success Messages -->
            @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any() && !$errors->has('email') && !$errors->has('password') && !$errors->has('captcha_answer'))
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('tyro-login.login.submit') }}" style="margin-top: 0.5rem;">
                @csrf

                <!-- Email/Phone Field -->
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="email" class="form-label">ফোন নম্বর</label>
                    <input type="text" id="email" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="tel" autofocus placeholder="01700000000">
                    @error('email')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="password" class="form-label">পাসওয়ার্ড</label>
                    <input type="password" id="password" name="password" class="form-input @error('password') is-invalid @enderror" required autocomplete="current-password" placeholder="পাসওয়ার্ড">
                    @error('password')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-options" style="margin-bottom: 1rem;">
                    @if($features['remember_me'] ?? true)
                    <div class="checkbox-group">
                        <input type="checkbox" id="remember" name="remember" class="checkbox-input" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="checkbox-label">আমাকে মনে রাখুন</label>
                    </div>
                    @else
                    <div></div>
                    @endif

                    @if($features['forgot_password'] ?? true)
                    <a href="{{ route('tyro-login.password.request') }}" class="form-link">পাসওয়ার্ড ভুলে গেছেন?</a>
                    @endif
                </div>

                <!-- Captcha -->
                @if($captchaEnabled ?? false)
                <div class="form-group captcha-group">
                    <label for="captcha_answer" class="form-label">{{ $captchaConfig['label'] ?? 'নিরাপত্তা যাচাই' }}</label>
                    <div class="captcha-container">
                        <span class="captcha-question">{{ $captchaQuestion }}</span>
                        <input type="number" id="captcha_answer" name="captcha_answer" class="form-input captcha-input @error('captcha_answer') is-invalid @enderror" required autocomplete="off" placeholder="{{ $captchaConfig['placeholder'] ?? 'উত্তর লিখুন' }}">
                    </div>
                    @error('captcha_answer')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                @endif

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">
                    লগ ইন করুন
                </button>
            </form>

            <!-- Register Link -->
            @if($registrationEnabled ?? true)
            <div class="form-footer">
                <p>
                    কোন অ্যাকাউন্ট নেই?
                    <a href="{{ route('register') }}" class="form-link">নিবন্ধন করুন</a>
                </p>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@100..900&display=swap');

    * {
        font-family: 'Noto Serif Bengali', serif !important;
    }

    .captcha-group {
        margin-bottom: 1.25rem;
    }

    .captcha-container {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .captcha-question {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1rem;
        background-color: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 1rem;
        color: var(--text-primary);
        white-space: nowrap;
        min-width: 100px;
        text-align: center;
    }

    .captcha-input {
        flex: 1;
        text-align: center;
        font-weight: 500;
    }

    /* Hide number input spinners */
    .captcha-input::-webkit-outer-spin-button,
    .captcha-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .captcha-input[type=number] {
        -moz-appearance: textfield;
    }

    .alert {
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
    }

    .alert-error {
        background-color: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }

    .alert-success {
        background-color: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
    }
</style>
@endsection
