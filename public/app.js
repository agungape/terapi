// PWA Installation Logic
let deferredPrompt = null;
let isPromptAvailable = false;
let installButtonClicked = false;

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
      if (!isPromptAvailable) {
        console.log('Prompt not available, not showing UI');
        return;
      }

      const overlay = document.querySelector('.pwa-offcanvas');
      const backdrop = document.querySelector('.pwa-backdrop');
      if (overlay) overlay.classList.add('show');
      if (backdrop) backdrop.classList.add('show');
      console.log('Install prompt UI shown');
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
      console.log('Install prompt hidden and cookie set');
    } catch (e) {
      console.error('Error hiding install prompt:', e);
    }
  };

  // Install Button Handler
  if (pwaBtn) {
    pwaBtn.addEventListener('click', async () => {
      if (!deferredPrompt) {
        console.warn('Install prompt not available yet, queuing request');
        installButtonClicked = true;
        return;
      }

      try {
        console.log('Showing install prompt to user');
        installButtonClicked = false;
        const choiceResult = await deferredPrompt.prompt();
        console.log(`User response: ${choiceResult.outcome}`);

        if (choiceResult.outcome === 'accepted') {
          console.log('User accepted PWA install');
          hideInstallPrompt();
        } else {
          console.log('User declined PWA install');
        }
      } catch (err) {
        console.error('Error during install prompt:', err);
      } finally {
        deferredPrompt = null;
        isPromptAvailable = false;
      }
    });
  }

  // Close Handlers
  document.querySelectorAll('.pwa-backdrop, .pwa-close').forEach(el => {
    el.addEventListener('click', hideInstallPrompt);
  });

  // Show prompt if not previously dismissed
  if (!getCookie(PwaKey)) {
    setTimeout(() => {
      if (isPromptAvailable || installButtonClicked) {
        showInstallPrompt();
      }
    }, 5000);
  }
}

// Service Worker Registration with Fallback
function registerServiceWorker() {
  if (!('serviceWorker' in navigator)) {
    console.warn('Service Worker not supported');
    return;
  }

  const swUrl = '/sw.js';
  const scope = '/mobile/';

  navigator.serviceWorker.register(swUrl, { scope })
    .then(registration => {
      console.log('ServiceWorker registered with scope:', registration.scope);

      // Check for updates
      registration.addEventListener('updatefound', () => {
        const newWorker = registration.installing;
        console.log('New service worker found:', newWorker.state);

        newWorker.addEventListener('statechange', () => {
          console.log('Service worker state changed:', newWorker.state);
          if (newWorker.state === 'activated') {
            console.log('New service worker activated');
          }
        });
      });
    })
    .catch(error => {
      console.error('ServiceWorker registration failed:', error);

      // Fallback to root scope if needed
      if (error.message.includes('scope')) {
        console.warn('Attempting registration with root scope');
        navigator.serviceWorker.register(swUrl)
          .then(reg => console.log('Fallback registration succeeded:', reg.scope))
          .catch(err => console.error('Fallback registration failed:', err));
      }
    });
}

// Initialize PWA
function initPWA() {
  // Register Service Worker first
  registerServiceWorker();

  // Handle installation prompt
  window.addEventListener('beforeinstallprompt', (e) => {
    console.log('beforeinstallprompt event fired', e);
    e.preventDefault();
    deferredPrompt = e;
    isPromptAvailable = true;

    // Enable install button if exists
    const pwaBtn = document.querySelector('.pwa-btn');
    if (pwaBtn) {
      pwaBtn.disabled = false;
      console.log('Install button enabled');
    }

    // If button was clicked before prompt was available
    if (installButtonClicked) {
      showInstallPrompt();
    }
  });

  // Track successful installation
  window.addEventListener('appinstalled', () => {
    console.log('PWA was successfully installed');
    deferredPrompt = null;
    isPromptAvailable = false;
    installButtonClicked = false;
  });
}

// Start when DOM is ready
function initialize() {
  if (document.readyState === 'complete' || document.readyState === 'interactive') {
    console.log('DOM already ready, initializing PWA');
    initPWA();
    whenDOMReady();
  } else {
    console.log('Waiting for DOM content loaded');
    document.addEventListener('DOMContentLoaded', () => {
      console.log('DOM content loaded, initializing PWA');
      initPWA();
      whenDOMReady();
    });
  }
}

// Debugging helpers
window.debugPWA = {
  showPrompt: () => {
    if (deferredPrompt) {
      deferredPrompt.prompt();
    } else {
      console.warn('No deferredPrompt available');
    }
  },
  getState: () => ({
    deferredPrompt: !!deferredPrompt,
    isPromptAvailable,
    installButtonClicked
  })
};

// Start the application
console.log('Starting PWA initialization');
initialize();
