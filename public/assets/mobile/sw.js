const CACHE_NAME = 'bsc-v5'; // Versi diperbarui
const urlsToCache = [
  '/mobile/',
  '/mobile/dashboard',
  '/assets/mobile/pixio/images/app-logo/bsc.png',
  '/mobile/offline' // Pastikan path sesuai dengan route Laravel
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        return Promise.all(
          urlsToCache.map(url => {
            return fetch(url)
              .then(response => {
                if (!response.ok) throw new Error(`Failed to load ${url}`);
                return cache.put(url, response);
              })
              .catch(err => {
                console.warn('Skipping cache for:', url, err);
              });
          })
        );
      })
  );
});

self.addEventListener('fetch', event => {
  const requestUrl = new URL(event.request.url);

  // Skip non-GET requests dan external resources
  if (event.request.method !== 'GET' || !requestUrl.origin.includes('brightchild.id')) {
    return;
  }

  // Strategy: Network First, fallback to Cache
  event.respondWith(
    fetch(event.request)
      .then(networkResponse => {
        // Update cache dengan response terbaru
        caches.open(CACHE_NAME)
          .then(cache => cache.put(event.request, networkResponse.clone()));
        return networkResponse;
      })
      .catch(() => {
        // Fallback logic
        if (event.request.mode === 'navigate') {
          return caches.match('/mobile/')
            .then(response => response || caches.match('/mobile/offline'));
        }
        return caches.match(event.request);
      })
  );
});
