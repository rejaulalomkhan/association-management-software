<div x-data="pwaInstall()" x-init="init()">
    <!-- Install Button (Always Visible) -->
    <div x-show="canInstall || true" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="fixed bottom-4 right-4 z-50">
        
        <button @click="install()" 
                x-show="!isInstalled"
                class="flex items-center gap-2 px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-full shadow-2xl hover:from-blue-700 hover:to-blue-800 transition-all hover:shadow-xl transform hover:-translate-y-1 hover:scale-105">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            <span class="font-semibold text-sm">অ্যাপ ইনস্টল করুন</span>
        </button>
    </div>
</div>

<script>
function pwaInstall() {
    return {
        deferredPrompt: null,
        canInstall: false,
        isInstalled: false,
        
        init() {
            // Check if already installed
            if (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true) {
                this.isInstalled = true;
                return;
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
                console.log('PWA installed successfully');
            });
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
            } else {
                console.log('User dismissed the install prompt');
            }
            
            // Clear the deferredPrompt
            this.deferredPrompt = null;
            this.canInstall = false;
        }
    }
}
</script>
