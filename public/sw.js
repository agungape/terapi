const CACHE_NAME = 'bsc-v4';
const urlsToCache = [
  '/mobile/',
  '/mobile/dashboard',
  '/assets/mobile/pixio/images/app-logo/bsc.png',
  '/offline' // Fallback page
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
  );
});

self.addEventListener('fetch', event => {
  if (event.request.mode === 'navigate') {
    event.respondWith(
      fetch(event.request)
        .catch(() => caches.match('/mobile/'))
    );
  } else {
    event.respondWith(
      caches.match(event.request)
        .then(response => response || fetch(event.request))
    );
  }
});
