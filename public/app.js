// PWA Installation Logic
let deferredPrompt;

// Safe DOM Access Wrapper
function whenDOMReady() {
  // DOM Elements
  const pwaBtn = document.querySelector('.pwa-btn');
  const installText = document.querySelector('.pwa-text');
  const PwaKey = 'pwa-modal';

  // Enhanced cookie check
  const getCookie = (name) => {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
  };

  // iOS detection with better reliability
  const isIOS = () => {
    return /iPad|iPhone|iPod/.test(navigator.userAgent) ||
           (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1) ||
           (/Macintosh/.test(navigator.userAgent) && navigator.maxTouchPoints > 1);
  };

  // iOS specific handling
  if (isIOS()) {
    if (installText) {
      installText.innerHTML = 'Untuk menginstall: <br>1. Buka menu share <ion-icon name="share-outline"></ion-icon><br>2. Pilih "Add to Home Screen"';
    }
    if (pwaBtn) {
      pwaBtn.style.display = 'none';
    }
    return;
  }

  // PWA Prompt Controls
  const showInstallPrompt = () => {
    try {
      const overlay = document.querySelector('.pwa-offcanvas');
      const backdrop = document.querySelector('.pwa-backdrop');
      if (overlay) overlay.classList.add('show');
      if (backdrop) backdrop.classList.add('show');
    } catch (e) {
      console.error('Error showing install prompt:', e);
    }
  };

  const hideInstallPrompt = () => {
    try {
      const overlay = document.querySelector('.pwa-offcanvas');
      const backdrop = document.querySelector('.pwa-backdrop');
      if (overlay) overlay.classList.remove('show');
      if (backdrop) backdrop.classList.remove('show');

      // Set cookie for 30 days
      const expires = new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toUTCString();
      document.cookie = `${PwaKey}=true; expires=${expires}; path=/; Secure; SameSite=Lax`;
    } catch (e) {
      console.error('Error hiding install prompt:', e);
    }
  };

  // Install Button Handler
  if (pwaBtn) {
    pwaBtn.addEventListener('click', async () => {
      if (!deferredPrompt) return;

      try {
        deferredPrompt.prompt();
        const { outcome } = await deferredPrompt.userChoice;

        if (outcome === 'accepted') {
          console.log('User accepted PWA install');
          hideInstallPrompt();
        } else {
          console.log('User declined PWA install');
        }
      } catch (err) {
        console.error('Error during install prompt:', err);
      } finally {
        deferredPrompt = null;
      }
    });
  }

  // Close Handlers
  document.querySelectorAll('.pwa-backdrop, .pwa-close').forEach(el => {
    el.addEventListener('click', hideInstallPrompt);
  });

  // Show prompt if not previously dismissed
  if (!getCookie(PwaKey) && !isIOS()) {
    setTimeout(showInstallPrompt, 5000); // Show after 5 seconds
  }
}

// Service Worker Registration with Fallback
function registerServiceWorker() {
  if (!('serviceWorker' in navigator)) return;

  const swUrl = '/sw.js';
  const scope = '/mobile/';

  navigator.serviceWorker.register(swUrl, { scope })
    .then(registration => {
      console.log('ServiceWorker registration successful with scope:', registration.scope);

      // Handle updates
      registration.addEventListener('updatefound', () => {
        const newWorker = registration.installing;
        console.log('New service worker found:', newWorker);
      });
    })
    .catch(error => {
      console.error('ServiceWorker registration failed:', error);

      // Fallback attempt with different scope
      if (error.message.includes('scope')) {
        console.warn('Attempting fallback registration with root scope');
        navigator.serviceWorker.register(swUrl)
          .then(reg => console.log('Fallback registration succeeded:', reg.scope))
          .catch(err => console.error('Fallback registration failed:', err));
      }
    });
}

// Initialize PWA
function initPWA() {
  // Register Service Worker
  registerServiceWorker();

  // Handle installation prompt
  window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    console.log('PWA install prompt available');
  });

  // Track app installation
  window.addEventListener('appinstalled', () => {
    console.log('PWA was successfully installed');
    deferredPrompt = null;
  });
}

// Start when DOM is ready
if (document.readyState === 'complete' || document.readyState === 'interactive') {
  setTimeout(() => {
    initPWA();
    whenDOMReady();
  }, 1000);
} else {
  document.addEventListener('DOMContentLoaded', () => {
    initPWA();
    whenDOMReady();
  });
}
