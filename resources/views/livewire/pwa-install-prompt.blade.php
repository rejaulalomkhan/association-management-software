<div x-data="pwaInstall()" x-init="init()">
    <!-- Toast Notification for PWA Install -->
    <div x-show="canInstall && !isInstalled && !isDismissed" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-4"
         class="fixed top-20 left-4 right-4 md:left-auto md:right-4 md:max-w-md z-50">
        
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-2xl shadow-2xl p-4 backdrop-blur-sm">
            <div class="flex items-start gap-3">
                <!-- App Icon -->
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-base mb-1">অ্যাপ ইনস্টল করুন</h3>
                    <p class="text-sm text-blue-50 opacity-90">হোম স্ক্রিনে যুক্ত করে দ্রুত অ্যাক্সেস করুন</p>
                    
                    <!-- Action Buttons -->
                    <div class="flex gap-2 mt-3">
                        <button @click="install()" 
                                class="flex-1 bg-white text-blue-600 px-4 py-2 rounded-lg font-semibold text-sm hover:bg-blue-50 transition-colors shadow-md">
                            ইনস্টল করুন
                        </button>
                        <button @click="dismiss()" 
                                class="px-4 py-2 rounded-lg font-medium text-sm text-white hover:bg-white/20 transition-colors">
                            পরে
                        </button>
                    </div>
                </div>
                
                <!-- Close Button -->
                <button @click="dismiss()" 
                        class="flex-shrink-0 text-white/80 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function pwaInstall() {
    return {
        deferredPrompt: null,
        canInstall: false,
        isInstalled: false,
        isDismissed: false,
        
        init() {
            // Check if already installed
            if (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true) {
                this.isInstalled = true;
                return;
            }
            
            // Check if user previously dismissed
            if (localStorage.getItem('pwa-install-dismissed')) {
                this.isDismissed = true;
            }
            
            // Listen for beforeinstallprompt
            window.addEventListener('beforeinstallprompt', (e) => {
                e.preventDefault();
                this.deferredPrompt = e;
                this.canInstall = true;
                console.log('PWA install prompt available');
            });
            
            // Listen for app installed
            window.addEventListener('appinstalled', () => {
                this.isInstalled = true;
                this.deferredPrompt = null;
                localStorage.removeItem('pwa-install-dismissed');
                console.log('PWA installed successfully');
            });
        },
        
        dismiss() {
            this.isDismissed = true;
            // Remember dismissal for 7 days
            localStorage.setItem('pwa-install-dismissed', Date.now());
            setTimeout(() => {
                localStorage.removeItem('pwa-install-dismissed');
                this.isDismissed = false;
            }, 7 * 24 * 60 * 60 * 1000); // 7 days
        },
        
        async install() {
            if (!this.deferredPrompt) {
                // Fallback: Show manual instructions
                alert('অ্যাপ ইনস্টল করতে:\n\nChrome/Edge: Menu (⋮) → "Install প্রজন্ম উন্নয়ন মিশন"\n\niOS Safari: Share (□↑) → "Add to Home Screen"\n\nAndroid Chrome: Menu (⋮) → "Add to Home screen"');
                return;
            }
            
            // Show the install prompt
            this.deferredPrompt.prompt();
            
            // Wait for the user's response
            const { outcome } = await this.deferredPrompt.userChoice;
            
            if (outcome === 'accepted') {
                console.log('User accepted the install prompt');
                this.canInstall = false;
            } else {
                console.log('User dismissed the install prompt');
            }
            
            // Clear the deferredPrompt
            this.deferredPrompt = null;
        }
    }
}
</script>
