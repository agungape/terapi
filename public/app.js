// PWA Installation Logic
let deferredPrompt;
const pwaBtn = document.querySelector('.pwa-btn');
const installText = document.querySelector('.pwa-text');
const PwaKey = 'pwa-modal';
let PwaValue = document.cookie.includes(`${PwaKey}=true`);

// iOS detection
function isIOS() {
  return /iPad|iPhone|iPod/.test(navigator.userAgent) ||
         (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);
}

if (isIOS()) {
  installText.innerHTML = 'Install "Bright Star Of Child" to your home screen: tap share icon and select "Add to Home Screen".';
  pwaBtn.remove();
}

// Register Service Worker
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('/sw.js')
    .then(registration => {
      console.log('ServiceWorker registered with scope:', registration.scope);
    })
    .catch(error => {
      console.error('ServiceWorker registration failed:', error);
    });
}

// PWA Installation Prompt
window.addEventListener('beforeinstallprompt', (e) => {
  e.preventDefault();
  deferredPrompt = e;

  if (!PwaValue) {
    setTimeout(() => {
      document.querySelector('.pwa-offcanvas').classList.add('show');
      document.querySelector('.pwa-backdrop').classList.add('show');
    }, 3000);
  }

  pwaBtn.addEventListener('click', () => {
    deferredPrompt.prompt();
    deferredPrompt.userChoice.then((choiceResult) => {
      if (choiceResult.outcome === 'accepted') {
        document.querySelector('.pwa-offcanvas').classList.remove('show');
        document.querySelector('.pwa-backdrop').classList.remove('show');
        document.cookie = `${PwaKey}=true; path=/; max-age=2592000`; // 30 days
      }
      deferredPrompt = null;
    });
  });
});

// Close handlers
document.querySelectorAll('.pwa-backdrop, .pwa-close').forEach(el => {
  el.addEventListener('click', () => {
    document.querySelector('.pwa-offcanvas').classList.remove('show');
    document.querySelector('.pwa-backdrop').classList.remove('show');
    document.cookie = `${PwaKey}=true; path=/; max-age=2592000`; // 30 days
  });
});
