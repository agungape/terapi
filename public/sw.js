const CACHE_NAME = 'bsc-v6'; // Update version
const APP_BASE_PATH = '/mobile/';
const ASSETS_PATH = '/assets/mobile/';

// Daftar URL yang akan di-cache
const urlsToCache = [
  // Halaman utama
  APP_BASE_PATH,
  `${APP_BASE_PATH}dashboard`,
  `${APP_BASE_PATH}offline`,

  // Assets penting
  `${ASSETS_PATH}pixio/images/app-logo/bsc.png`,
  `${ASSETS_PATH}pixio/css/style.css`,
  `${ASSETS_PATH}pixio/js/custom.js`,

  // Fallback
  '/offline.html'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        console.log('Opened cache');
        return Promise.all(
          urlsToCache.map(url => {
            return fetch(url)
              .then(response => {
                if (!response.ok) {
                  throw new Error(`Failed to load ${url}: ${response.status}`);
                }
                return cache.put(url, response);
              })
              .catch(err => {
                console.warn('Cache skipped for:', url, err);
              });
          })
        );
      })
      .then(() => {
        console.log('All resources cached');
        return self.skipWaiting();
      })
  );
});

self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cache => {
          if (cache !== CACHE_NAME) {
            console.log('Deleting old cache:', cache);
            return caches.delete(cache);
          }
        })
      );
    })
    .then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', event => {
  const requestUrl = new URL(event.request.url);

  // Skip non-GET requests dan external resources
  if (event.request.method !== 'GET' ||
      !requestUrl.origin.includes('brightchild.id')) {
    return;
  }

  // Untuk API, gunakan network only
  if (requestUrl.pathname.startsWith('/api/')) {
    return;
  }

  event.respondWith(
    caches.match(event.request)
      .then(cachedResponse => {
        // Always try to update from network
        return fetch(event.request)
          .then(networkResponse => {
            // Update cache
            if (networkResponse.ok) {
              caches.open(CACHE_NAME)
                .then(cache => cache.put(event.request, networkResponse.clone()));
            }
            return networkResponse;
          })
          .catch(() => {
            // Fallback untuk navigasi
            if (event.request.mode === 'navigate') {
              return caches.match(APP_BASE_PATH)
                .then(response => response || caches.match('/offline.html'));
            }

            // Return cached version jika ada
            if (cachedResponse) {
              return cachedResponse;
            }

            // Fallback untuk assets
            if (requestUrl.pathname.startsWith(ASSETS_PATH)) {
              return caches.match(`${ASSETS_PATH}offline-asset-placeholder.png`);
            }
          });
      })
  );
});
