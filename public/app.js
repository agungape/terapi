const CACHE_NAME = 'app-bright-v3';
const urlsToCache = [
  '/',
  '/app',
  '/assets/mobile/pixio/images/app-logo/bsc.png',
  // Tambahkan asset statis di sini (CSS, JS, gambar, dll)
];

// Halaman dinamis yang butuh session/CSRF fresh
const dynamicBypass = [
  '/mobile',
  '/login',
  '/logout',
  '/sanctum/csrf-cookie'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      console.log('Opened cache');
      return cache.addAll(urlsToCache);
    })
  );
});

self.addEventListener('fetch', (event) => {
  const url = new URL(event.request.url);

  // 1️⃣ Bypass untuk halaman auth
  if (dynamicBypass.some(path => url.pathname.startsWith(path))) {
    event.respondWith(
      fetch(event.request).catch(() => caches.match(event.request))
    );
    return;
  }

  // 2️⃣ Network-first untuk navigasi HTML
  if (event.request.mode === 'navigate') {
    event.respondWith(
      fetch(event.request).catch(() => caches.match(event.request))
    );
    return;
  }

  // 3️⃣ Cache-first untuk asset statis
  event.respondWith(
    caches.match(event.request).then((response) => {
      if (response) {
        return response;
      }

      return fetch(event.request).then((networkResponse) => {
        // Hanya cache response basic dan status 200
        if (!networkResponse || networkResponse.status !== 200 || networkResponse.type !== 'basic') {
          return networkResponse;
        }

        const responseToCache = networkResponse.clone();
        caches.open(CACHE_NAME).then((cache) => {
          cache.put(event.request, responseToCache);
        });

        return networkResponse;
      });
    })
  );
});

self.addEventListener('activate', (event) => {
  const cacheWhitelist = [CACHE_NAME];
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (!cacheWhitelist.includes(cacheName)) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});
