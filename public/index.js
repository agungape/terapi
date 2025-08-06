// Register Service worker to control making site work offline
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('/app.js')
        .then((registration) => {
          console.log('ServiceWorker registration successful with scope: ', registration.scope);
        })
        .catch((err) => {
          console.log('ServiceWorker registration failed: ', err);
        });
    });
  }

  // Code to handle install prompt on desktop
  let deferredPrompt;
  const pwaBtn = document.querySelector('.pwa-btn');
  const installText = document.querySelector('.pwa-text');
  const PwaKey = 'pwa-modal';
  const PwaValue = getCookie(PwaKey);

  /* for ios start*/
  function isThisDeviceRunningiOS() {
    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) ||
                  (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);

    if (isIOS) {
      installText.innerHTML = 'Install "Bright - Layanan Terapi Anak Spesial" to your home screen for easy access: tap the share button in Safari and select "Add to Home Screen".';
      if(pwaBtn) pwaBtn.remove();
      return true;
    }
    return false;
  }

  isThisDeviceRunningiOS();
  /* for ios end*/

  window.addEventListener('beforeinstallprompt', (e) => {
    if(isThisDeviceRunningiOS()) return;

    e.preventDefault();
    deferredPrompt = e;

    if(!PwaValue && pwaBtn) {
      setTimeout(() => {
        jQuery('.pwa-offcanvas').addClass('show');
        jQuery('.pwa-backdrop').addClass('fade show');
      }, 3000);
    }

    if(pwaBtn) {
      pwaBtn.addEventListener('click', () => {
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then((choiceResult) => {
          if (choiceResult.outcome === 'accepted') {
            jQuery('.pwa-offcanvas').slideUp(500, () => {
              jQuery(this).removeClass('show');
            });
            setTimeout(() => {
              jQuery('.pwa-backdrop').removeClass('show');
            }, 500);
            setCookie(PwaKey, false);
          }
          deferredPrompt = null;
        });
      });
    }
  });

  if(pwaBtn) {
    jQuery('.pwa-backdrop, .pwa-close, .pwa-btn').on('click', () => {
      jQuery('.pwa-offcanvas').slideUp(500, () => {
        jQuery(this).removeClass('show');
      });
      setTimeout(() => {
        jQuery('.pwa-backdrop').removeClass('show');
      }, 500);
      setCookie(PwaKey, true);
    });
  }

  // Check if app is launched as PWA
  if (window.matchMedia('(display-mode: standalone)').matches ||
      window.navigator.standalone === true) {
    console.log('Running as PWA');
    // You can add PWA-specific logic here
  }
