const CACHE_NAME = 'bsc-v3';
const urlsToCache = [
  'http://127.0.0.1:8000/mobile/',
  'http://127.0.0.1:8000/mobile/dashboard',
  'http://127.0.0.1:8000/mobile/offline' // Buat route fallback
];

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request)
      .catch(() => caches.match('http://127.0.0.1:8000/mobile/'))
  ));
});
