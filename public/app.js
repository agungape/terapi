// PWA Installation Logic
let deferredPrompt;

// Safe DOM Access Wrapper
function whenDOMReady() {
  const pwaBtn = document.querySelector('.pwa-btn');
  const installText = document.querySelector('.pwa-text');
  const PwaKey = 'pwa-modal';

  // Robust cookie check
  const getCookie = (name) => {
    return document.cookie.split(';').some(c => c.trim().startsWith(`${name}=`));
  };

  const PwaValue = getCookie(PwaKey);

  // iOS detection and handling
  const isIOS = () => {
    return /iPad|iPhone|iPod/.test(navigator.userAgent) ||
           (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);
  };

  if (installText && isIOS()) {
    installText.innerHTML = 'Tap <ion-icon name="share"></ion-icon> then "Add to Home Screen"';
    if (pwaBtn) pwaBtn.remove();
    return; // Stop further PWA logic on iOS
  }

  // PWA Installation Prompt
  const showInstallPrompt = () => {
    const overlay = document.querySelector('.pwa-offcanvas');
    const backdrop = document.querySelector('.pwa-backdrop');
    if (overlay) overlay.classList.add('show');
    if (backdrop) backdrop.classList.add('show');
  };

  const hideInstallPrompt = () => {
    const overlay = document.querySelector('.pwa-offcanvas');
    const backdrop = document.querySelector('.pwa-backdrop');
    if (overlay) overlay.classList.remove('show');
    if (backdrop) backdrop.classList.remove('show');
    document.cookie = `${PwaKey}=true; path=/; max-age=${30 * 24 * 60 * 60}`;
  };

  if (pwaBtn) {
    pwaBtn.addEventListener('click', () => {
      if (deferredPrompt) {
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then(choiceResult => {
          if (choiceResult.outcome === 'accepted') {
            hideInstallPrompt();
          }
          deferredPrompt = null;
        });
      }
    });
  }

  // Close handlers
  document.querySelectorAll('.pwa-backdrop, .pwa-close').forEach(el => {
    el.addEventListener('click', hideInstallPrompt);
  });

  // Auto-show prompt if not dismissed before
  if (!PwaValue && !isIOS()) {
    setTimeout(showInstallPrompt, 3000);
  }
}

// Service Worker Registration (Works everywhere)
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/asset/mobile/sw.js', { scope: '/mobile/' })
    .then(reg => console.log('SW registered:', reg.scope))
    .catch(err => console.error('SW registration failed:', err));
}

// PWA Installation Event (Needs DOM)
window.addEventListener('beforeinstallprompt', (e) => {
  e.preventDefault();
  deferredPrompt = e;
});

// Wait for DOM if needed
if (document.readyState !== 'loading') {
  whenDOMReady();
} else {
  document.addEventListener('DOMContentLoaded', whenDOMReady);
}
