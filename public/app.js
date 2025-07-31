// PWA Installation Logic - Client Side Only
(function() {
    // Pastikan kode hanya berjalan di lingkungan browser
    if (typeof window === 'undefined') return;

    let deferredPrompt = null;
    let isPromptAvailable = false;
    let installButtonClicked = false;

    // DOM Elements
    const getPWAElements = () => ({
      pwaBtn: document.querySelector('.pwa-btn'),
      installText: document.querySelector('.pwa-text'),
      overlay: document.querySelector('.pwa-offcanvas'),
      backdrop: document.querySelector('.pwa-backdrop')
    });

    // Enhanced cookie check
    const getCookie = (name) => {
      const value = `; ${document.cookie}`;
      const parts = value.split(`; ${name}=`);
      if (parts.length === 2) return parts.pop().split(';').shift();
      return null;
    };

    // iOS detection
    const isIOS = () => {
      return /iPad|iPhone|iPod/.test(navigator.userAgent) ||
             (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);
    };

    // PWA Prompt Controls
    const showInstallPrompt = () => {
      try {
        const { overlay, backdrop } = getPWAElements();
        if (overlay) overlay.classList.add('show');
        if (backdrop) backdrop.classList.add('show');
        console.log('[PWA] Install prompt shown');
      } catch (e) {
        console.error('[PWA] Error showing install prompt:', e);
      }
    };

    const hideInstallPrompt = () => {
      try {
        const { overlay, backdrop } = getPWAElements();
        if (overlay) overlay.classList.remove('show');
        if (backdrop) backdrop.classList.remove('show');

        // Set cookie for 30 days
        const expires = new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toUTCString();
        document.cookie = `pwa-modal=true; expires=${expires}; path=/; Secure; SameSite=Lax`;
        console.log('[PWA] Install prompt hidden');
      } catch (e) {
        console.error('[PWA] Error hiding install prompt:', e);
      }
    };

    // Initialize PWA
    const initPWA = () => {
      const { pwaBtn, installText } = getPWAElements();

      // iOS specific handling
      if (isIOS()) {
        if (installText) {
          installText.innerHTML = 'Untuk install: <br>1. Buka menu share <ion-icon name="share-outline"></ion-icon><br>2. Pilih "Add to Home Screen"';
        }
        if (pwaBtn) {
          pwaBtn.style.display = 'none';
        }
        return;
      }

      // Install Button Handler
      if (pwaBtn) {
        pwaBtn.addEventListener('click', async () => {
          if (!deferredPrompt) {
            console.warn('[PWA] Install prompt not available yet, queuing request');
            installButtonClicked = true;
            return;
          }

          try {
            console.log('[PWA] Showing install prompt');
            const choiceResult = await deferredPrompt.prompt();
            console.log(`[PWA] User response: ${choiceResult.outcome}`);

            if (choiceResult.outcome === 'accepted') {
              hideInstallPrompt();
            }
          } catch (err) {
            console.error('[PWA] Error during install prompt:', err);
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
      if (!getCookie('pwa-modal')) {
        setTimeout(() => {
          if (isPromptAvailable || installButtonClicked) {
            showInstallPrompt();
          }
        }, 5000);
      }
    };

    // Handle installation prompt event
    window.addEventListener('beforeinstallprompt', (e) => {
      console.log('[PWA] beforeinstallprompt event received');
      e.preventDefault();
      deferredPrompt = e;
      isPromptAvailable = true;

      const { pwaBtn } = getPWAElements();
      if (pwaBtn) {
        pwaBtn.disabled = false;
        console.log('[PWA] Install button enabled');
      }

      if (installButtonClicked) {
        showInstallPrompt();
      }
    });

    // Track successful installation
    window.addEventListener('appinstalled', () => {
      console.log('[PWA] Successfully installed');
      deferredPrompt = null;
      isPromptAvailable = false;
      installButtonClicked = false;
    });

    // Start when DOM is ready
    const onDOMReady = () => {
      if (document.readyState === 'complete' || document.readyState === 'interactive') {
        initPWA();
      } else {
        document.addEventListener('DOMContentLoaded', initPWA);
      }
    };

    // Service Worker Registration
    const registerServiceWorker = () => {
      if (!('serviceWorker' in navigator)) {
        console.warn('[PWA] Service Worker not supported');
        return;
      }

      navigator.serviceWorker.register('/sw.js', { scope: '/' })
        .then(reg => console.log('[PWA] ServiceWorker registered:', reg.scope))
        .catch(err => console.error('[PWA] ServiceWorker registration failed:', err));
    };

    // Initialize
    onDOMReady();
    registerServiceWorker();
  })();
