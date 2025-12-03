<div>
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6 text-center">Member Registration</h2>

    <form wire:submit="register">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Name -->
            <div>
                <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Name *</label>
                <input wire:model="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="text" required autofocus autocomplete="name" />
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Phone *</label>
                <input wire:model="phone" id="phone" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="text" required autocomplete="tel" />
                @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Father's Name -->
            <div>
                <label for="father_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Father's Name *</label>
                <input wire:model="father_name" id="father_name" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="text" required />
                @error('father_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Date of Birth -->
            <div>
                <label for="dob" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Date of Birth *</label>
                <input wire:model="dob" id="dob" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="date" required />
                @error('dob') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Blood Group -->
            <div>
                <label for="blood_group" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Blood Group *</label>
                <select wire:model="blood_group" id="blood_group" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" required>
                    <option value="">Select Blood Group</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
                @error('blood_group') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Profession -->
            <div>
                <label for="profession" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Profession *</label>
                <input wire:model="profession" id="profession" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="text" required />
                @error('profession') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Religion -->
            <div>
                <label for="religion" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Religion *</label>
                <select wire:model="religion" id="religion" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" required>
                    <option value="">Select Religion</option>
                    <option value="Islam">Islam</option>
                    <option value="Hinduism">Hinduism</option>
                    <option value="Christianity">Christianity</option>
                    <option value="Buddhism">Buddhism</option>
                    <option value="Other">Other</option>
                </select>
                @error('religion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Nationality -->
            <div>
                <label for="nationality" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Nationality *</label>
                <input wire:model="nationality" id="nationality" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="text" required value="Bangladeshi" />
                @error('nationality') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Present Address -->
        <div class="mt-4">
            <label for="present_address" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Present Address *</label>
            <textarea wire:model="present_address" id="present_address" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" required></textarea>
            @error('present_address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Permanent Address -->
        <div class="mt-4">
            <label for="permanent_address" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Permanent Address *</label>
            <textarea wire:model="permanent_address" id="permanent_address" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" required></textarea>
            @error('permanent_address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Profile Picture -->
        <div class="mt-4">
            <label for="profile_pic" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Profile Picture</label>
            <input wire:model="profile_pic" id="profile_pic" type="file" accept="image/*" class="w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-white dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
            @error('profile_pic') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            <div wire:loading wire:target="profile_pic" class="text-sm text-indigo-600 mt-1">Uploading...</div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <!-- Password -->
            <div>
                <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Password *</label>
                <input wire:model="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="password" required autocomplete="new-password" />
                @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Confirm Password *</label>
                <input wire:model="password_confirmation" id="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="password" required autocomplete="new-password" />
            </div>
        </div>

        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
            <a class="text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300" href="{{ route('tyro-login.login') }}" wire:navigate>
                Already registered?
            </a>

            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Register
            </button>
        </div>
    </form>
</div>
