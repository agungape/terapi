const CACHE_NAME = 'bsc-pwa-v2';
const OFFLINE_URL = '/mobile/offline.html';

const urlsToCache = [
  '/mobile/',
  '/app/',
  '/assets/mobile/pixio/css/styles.css',
  '/assets/mobile/pixio/js/custom.js',
  '/assets/mobile/pixio/images/app-logo/bsc.png',
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
      .then(() => self.skipWaiting())
  );
});

self.addEventListener('fetch', (event) => {
  // Handle API requests dengan auth header
  if (event.request.url.includes('/api/')) {
    event.respondWith(
      fetch(event.request).catch(() => {
        return new Response(JSON.stringify({ error: "You are offline" }), {
          headers: { 'Content-Type': 'application/json' }
        });
      }
    ));
    return;
  }

  // Handle halaman lainnya
  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request))
      .catch(() => caches.match(OFFLINE_URL))
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cache => {
          if (cache !== CACHE_NAME) return caches.delete(cache);
        })
      );
    })
  );
});
