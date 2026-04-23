<div class="space-y-6">
    <h1 class="text-2xl font-bold text-gray-800 md:text-3xl">সেটিংস</h1>

    @if($successMessage)
    <div class="px-4 py-3 text-green-700 border border-green-200 rounded-lg bg-green-50">
        {{ $successMessage }}
    </div>
    @endif

    {{-- Tabs navigation --}}
    <div class="bg-white rounded-lg shadow">
        <div class="border-b border-gray-200 overflow-x-auto">
            <nav class="flex -mb-px min-w-max" aria-label="Tabs">
                @php
                    $tabs = [
                        'organization'   => ['label' => 'সংগঠনের তথ্য', 'icon' => 'M3 7h18M3 12h18M3 17h18'],
                        'bank'           => ['label' => 'ব্যাংক একাউন্ট', 'icon' => 'M4 10h16M4 6h16l-2 4H6L4 6zm2 4v7a2 2 0 002 2h8a2 2 0 002-2v-7'],
                        'payment-methods'=> ['label' => 'পেমেন্ট মাধ্যম', 'icon' => 'M3 10h18M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z'],
                        'terms'          => ['label' => 'শর্তাবলী', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ];
                @endphp

                @foreach($tabs as $key => $tab)
                    <button
                        type="button"
                        wire:click="setTab('{{ $key }}')"
                        class="group inline-flex items-center gap-2 px-5 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition
                               {{ $activeTab === $key
                                    ? 'border-indigo-600 text-indigo-600'
                                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $tab['icon'] }}"/>
                        </svg>
                        {{ $tab['label'] }}
                    </button>
                @endforeach
            </nav>
        </div>

        {{-- ================ Organization Tab ================ --}}
        <div class="p-6 {{ $activeTab === 'organization' ? '' : 'hidden' }}">
            <h2 class="mb-4 text-xl font-semibold text-gray-800">সংগঠনের তথ্য</h2>

            <form wire:submit.prevent="saveSettings" class="space-y-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">সংগঠনের নাম (বাংলা)</label>
                        <input type="text" wire:model="organization_name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @error('organization_name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Organization Name (English)</label>
                        <input type="text" wire:model="organization_name_en"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @error('organization_name_en') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">সংগঠন শুরুর সাল</label>
                        <input type="number" wire:model="organization_established_year" min="2000" max="2100"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @error('organization_established_year') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">সংগঠন শুরুর মাস</label>
                        <select wire:model="organization_established_month"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="1">জানুয়ারি</option>
                            <option value="2">ফেব্রুয়ারি</option>
                            <option value="3">মার্চ</option>
                            <option value="4">এপ্রিল</option>
                            <option value="5">মে</option>
                            <option value="6">জুন</option>
                            <option value="7">জুলাই</option>
                            <option value="8">আগস্ট</option>
                            <option value="9">সেপ্টেম্বর</option>
                            <option value="10">অক্টোবর</option>
                            <option value="11">নভেম্বর</option>
                            <option value="12">ডিসেম্বর</option>
                        </select>
                        @error('organization_established_month') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">মাসিক টাকা (৳)</label>
                        <input type="number" wire:model="monthly_fee" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @error('monthly_fee') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">ঠিকানা</label>
                    <textarea wire:model="organization_address" rows="2"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                    @error('organization_address') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">ফোন নম্বর</label>
                        <input type="text" wire:model="organization_phone"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @error('organization_phone') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">ইমেইল</label>
                        <input type="email" wire:model="organization_email"
                            placeholder="info@example.org"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @error('organization_email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">সংগঠনের লোগো</label>
                    @if($organization_logo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $organization_logo) }}" alt="Logo" class="object-cover w-20 h-20 rounded">
                        </div>
                    @endif
                    <input type="file" wire:model="new_logo" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('new_logo') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        সংরক্ষণ করুন
                    </button>
                </div>
            </form>
        </div>

        {{-- ================ Bank Tab ================ --}}
        <div class="p-6 {{ $activeTab === 'bank' ? '' : 'hidden' }}">
            <h2 class="mb-4 text-xl font-semibold text-gray-800">ব্যাংক একাউন্ট তথ্য</h2>

            <form wire:submit.prevent="saveSettings" class="space-y-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">ব্যাংকের নাম</label>
                        <input type="text" wire:model="bank_name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="যেমন: সোনালী ব্যাংক">
                        @error('bank_name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">একাউন্ট নম্বর</label>
                        <input type="text" wire:model="bank_account_number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="যেমন: 1234567890">
                        @error('bank_account_number') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">শাখা</label>
                        <input type="text" wire:model="bank_branch"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="যেমন: মিরপুর শাখা">
                        @error('bank_branch') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">একাউন্ট হোল্ডারের নাম</label>
                        <input type="text" wire:model="bank_account_holder"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="যেমন: {{ org_name() }}">
                        @error('bank_account_holder') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        সংরক্ষণ করুন
                    </button>
                </div>
            </form>
        </div>

        {{-- ================ Payment Methods Tab ================ --}}
        <div class="p-6 {{ $activeTab === 'payment-methods' ? '' : 'hidden' }}">
            <h2 class="mb-4 text-xl font-semibold text-gray-800">পেমেন্ট মাধ্যম</h2>

            {{-- Add New Payment Method --}}
            <div class="p-4 mb-6 rounded-lg bg-gray-50">
                <h3 class="mb-3 text-sm font-medium text-gray-700">নতুন পেমেন্ট মাধ্যম যুক্ত করুন</h3>
                <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
                    <input type="text" wire:model="newMethodName" placeholder="Name (English)"
                        class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <input type="text" wire:model="newMethodNameBn" placeholder="নাম (বাংলা)"
                        class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <button wire:click="addPaymentMethod" type="button"
                        class="px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700">
                        যুক্ত করুন
                    </button>
                </div>
            </div>

            {{-- Payment Methods List --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">নাম (বাংলা)</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">অবস্থা</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">কার্যক্রম</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($paymentMethods as $method)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $method['name'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $method['name_bn'] ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button wire:click="toggleMethodStatus({{ $method['id'] }})" type="button"
                                    class="px-3 py-1 rounded-full text-xs font-medium {{ $method['is_active'] ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $method['is_active'] ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                </button>
                            </td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap">
                                <button wire:click="deletePaymentMethod({{ $method['id'] }})"
                                    onclick="return confirm('আপনি কি নিশ্চিত?')" type="button"
                                    class="text-red-600 hover:text-red-900">
                                    মুছে ফেলুন
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ================ Terms & Conditions Tab ================ --}}
        <div class="p-6 {{ $activeTab === 'terms' ? '' : 'hidden' }}">
            <div class="flex items-start justify-between mb-4 gap-4 flex-wrap">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">রেজিস্ট্রেশন পেজের শর্তাবলী</h2>
                    <p class="mt-1 text-sm text-gray-500">
                        এই লেখাগুলো <code class="px-1 py-0.5 bg-gray-100 rounded text-xs">/register</code> পেজে দেখানো হয়।
                        সাধারণ HTML ট্যাগ (যেমন <code>&lt;h3&gt;</code>, <code>&lt;p&gt;</code>, <code>&lt;ul&gt;</code>, <code>&lt;li&gt;</code>, <code>&lt;strong&gt;</code>) ব্যবহার করা যাবে।
                    </p>
                    <p class="mt-1 text-sm text-gray-500">
                        বিশেষ placeholder: <code class="px-1 py-0.5 bg-indigo-50 text-indigo-700 rounded text-xs">{org_name}</code> — এটি ব্যবহার করলে স্বয়ংক্রিয়ভাবে প্রতিষ্ঠানের নাম বসবে।
                    </p>
                </div>
                <button type="button"
                    wire:click="resetTermsToDefault"
                    onclick="return confirm('আপনি কি নিশ্চিত যে ডিফল্ট কনটেন্টে রিসেট করতে চান? বর্তমান পরিবর্তনগুলো মুছে যাবে।')"
                    class="inline-flex items-center gap-2 px-3 py-2 text-sm text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    ডিফল্টে রিসেট
                </button>
            </div>

            <form wire:submit.prevent="saveTerms" class="space-y-5"
                  x-data="{ preview: false }">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-medium text-gray-700">শর্তাবলী (HTML)</label>
                        <label class="inline-flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                            <input type="checkbox" x-model="preview" class="rounded text-indigo-600">
                            প্রিভিউ দেখুন
                        </label>
                    </div>

                    <div x-show="!preview">
                        <textarea wire:model="registration_terms" rows="20"
                            spellcheck="false"
                            class="w-full px-3 py-2 font-mono text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="&lt;h3&gt;১. সাধারণ শর্তাবলী&lt;/h3&gt;&#10;&lt;p&gt;...&lt;/p&gt;"></textarea>
                        @error('registration_terms') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div x-show="preview" x-cloak
                         class="p-5 bg-gray-50 border border-gray-200 rounded-lg max-h-[500px] overflow-y-auto">
                        <div class="prose max-w-none">
                            {!! str_replace('{org_name}', e(org_name()), $registration_terms ?? '') !!}
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">সম্মতি চেকবক্সের লেখা</label>
                    <textarea wire:model="registration_terms_acceptance_label" rows="2"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                    <p class="mt-1 text-xs text-gray-500">যেটি "আমি শর্তাবলী পড়েছি" টাইপের চেকবক্সের পাশে দেখানো হয়।</p>
                    @error('registration_terms_acceptance_label') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        শর্তাবলী সংরক্ষণ করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
