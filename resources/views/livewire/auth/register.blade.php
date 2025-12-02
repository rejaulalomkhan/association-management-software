<div class="max-w-2xl mx-auto">
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Name</label>
            <input wire:model="name" id="name" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="text" required autofocus autocomplete="name" />
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <label for="phone" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Phone</label>
            <input wire:model="phone" id="phone" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="text" required autocomplete="tel" />
            @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Father's Name -->
        <div class="mt-4">
            <label for="father_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Father's Name</label>
            <input wire:model="father_name" id="father_name" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="text" required />
            @error('father_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Date of Birth -->
        <div class="mt-4">
            <label for="dob" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Date of Birth</label>
            <input wire:model="dob" id="dob" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="date" required />
            @error('dob') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Blood Group -->
        <div class="mt-4">
            <label for="blood_group" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Blood Group</label>
            <select wire:model="blood_group" id="blood_group" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
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
        <div class="mt-4">
            <label for="profession" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Profession</label>
            <input wire:model="profession" id="profession" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="text" required />
            @error('profession') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Religion -->
        <div class="mt-4">
            <label for="religion" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Religion</label>
            <select wire:model="religion" id="religion" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
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
        <div class="mt-4">
            <label for="nationality" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nationality</label>
            <input wire:model="nationality" id="nationality" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="text" required />
            @error('nationality') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Present Address -->
        <div class="mt-4">
            <label for="present_address" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Present Address</label>
            <textarea wire:model="present_address" id="present_address" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required></textarea>
            @error('present_address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Permanent Address -->
        <div class="mt-4">
            <label for="permanent_address" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Permanent Address</label>
            <textarea wire:model="permanent_address" id="permanent_address" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required></textarea>
            @error('permanent_address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Profile Picture -->
        <div class="mt-4">
            <label for="profile_pic" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Profile Picture</label>
            <input wire:model="profile_pic" id="profile_pic" type="file" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
            @error('profile_pic') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            
            <div wire:loading wire:target="profile_pic" class="text-sm text-gray-500 mt-2">Uploading...</div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Password</label>
            <input wire:model="password" id="password" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="password" required autocomplete="new-password" />
            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Confirm Password</label>
            <input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="password" required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                Already registered?
            </a>

            <button type="submit" class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Register
            </button>
        </div>
    </form>
</div>
