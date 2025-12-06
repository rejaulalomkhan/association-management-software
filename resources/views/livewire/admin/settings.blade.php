 <div class="space-y-6">
    <h1 class="text-2xl font-bold text-gray-800 md:text-3xl">সেটিংস</h1>

    @if($successMessage)
    <div class="px-4 py-3 text-green-700 border border-green-200 rounded-lg bg-green-50">
        {{ $successMessage }}
    </div>
    @endif

    <!-- Organization Settings -->
    <div class="p-6 bg-white rounded-lg shadow">
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

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">ফোন নম্বর</label>
                <input type="text" wire:model="organization_phone"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                @error('organization_phone') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
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

    <!-- Payment Methods -->
    <div class="p-6 bg-white rounded-lg shadow">
        <h2 class="mb-4 text-xl font-semibold text-gray-800">পেমেন্ট মাধ্যম</h2>

        <!-- Add New Payment Method -->
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

        <!-- Payment Methods List -->
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
</div>
