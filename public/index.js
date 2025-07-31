// Register Service Worker
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('app.js')
      .then(() => console.log('Service Worker Registered'))
      .catch(err => console.error('SW Registration Failed:', err));
  }

  // Cek Auth Status Saat Aplikasi Dibuka
  document.addEventListener('DOMContentLoaded', () => {
    const token = localStorage.getItem('authToken');
    if (token && !window.location.pathname.includes('/')) {
      // Jika sudah login, redirect ke halaman utama
      window.location.href = '/app/';
    }
  });

// Code to handle install prompt on desktop
let deferredPrompt;
const pwaBtn = document.querySelector('.pwa-btn');
const installText = document.querySelector('.pwa-text');
var PwaKey = 'pwa-modal';
var PwaValue = getCookie(PwaKey);
//pwaBtn.style.display = 'none';

/* for ios start*/
function isThisDeviceRunningiOS() {
    const isIOS = ['iPad', 'iPhone', 'iPod'].includes(navigator.platform) ||
                 (navigator.userAgent.includes('Mac') && 'ontouchend' in document);

    if (isIOS) {
      const token = localStorage.getItem('authToken');
      if (token) {
        // Jika di iOS dan sudah login, paksa reload untuk menghindari logout
        window.location.reload();
      }
      installText.innerHTML = 'Tambahkan ke Home Screen via Safari Share > "Add to Home Screen".';
      pwaBtn?.remove();
    }
    return isIOS;
  }
  isThisDeviceRunningiOS();
/* for ios end*/

window.addEventListener('beforeinstallprompt', (e) => {
	// Prevent Chrome 67 and earlier from automatically showing the prompt
	e.preventDefault();
	// Stash the event so it can be triggered later.
	deferredPrompt = e;
	// Update UI to notify the user they can add to home screen
	//pwaBtn.style.display = 'block';
	if(!PwaValue)
	{
		setTimeout(function(){
			jQuery('.pwa-offcanvas').addClass('show');
			jQuery('.pwa-backdrop').addClass('fade show');
		}, 3000);
	}
	pwaBtn.addEventListener('click', () => {
		// hide our user interface that shows our A2HS button
		//pwaBtn.style.display = 'none';
		// Show the prompt
		deferredPrompt.prompt();
		// Wait for the user to respond to the prompt
		deferredPrompt.userChoice.then((choiceResult) => {
			if (choiceResult.outcome === 'accepted') {
				jQuery('.pwa-offcanvas').slideUp(500, function() {
					jQuery(this).removeClass('show');
				});
				setTimeout(function(){
					jQuery('.pwa-backdrop').removeClass('show');
				}, 500);
				setCookie(PwaKey, false);
			}
			deferredPrompt = null;
		});
	});
});

jQuery('.pwa-backdrop, .pwa-close, .pwa-btn').on('click',function(){
	jQuery('.pwa-offcanvas').slideUp(500, function() {
		jQuery(this).removeClass('show');
	});
	setTimeout(function(){
		jQuery('.pwa-backdrop').removeClass('show');
	}, 500);
	setCookie(PwaKey, true);
});
