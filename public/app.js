// Version
const CACHE_VERSION = 'v2.3.0-pixio';
const CACHE_NAME = `pixio-cache-${CACHE_VERSION}`;

// Core assets for offline access
const OFFLINE_ASSETS = [
  '/',
  '/mobile',
  '/assets/mobile/pixio/css/style.css',
  '/assets/mobile/pixio/images/app-logo/bsc.png'
];

// Network-first then cache-fallback strategy
const networkFirst = async (request) => {
  try {
    const networkResponse = await fetch(request);
    const cache = await caches.open(CACHE_NAME);
    cache.put(request, networkResponse.clone());
    return networkResponse;
  } catch (error) {
    const cachedResponse = await caches.match(request);
    return cachedResponse || caches.match('/offline.html');
  }
};

// Cache-first strategy (for assets)
const cacheFirst = async (request) => {
  const cachedResponse = await caches.match(request);
  return cachedResponse || fetch(request);
};

// Install event - Pre-cache core assets
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        console.log('[SW] Caching core assets');
        return cache.addAll(OFFLINE_ASSETS);
      })
      .then(() => self.skipWaiting())
  );
});

// Activate event - Clean old caches
self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cache) => {
          if (cache !== CACHE_NAME) {
            console.log('[SW] Deleting old cache:', cache);
            return caches.delete(cache);
          }
        })
      );
    }).then(() => self.clients.claim())
  );
});

// Fetch event - Advanced routing
self.addEventListener('fetch', (event) => {
  const { request } = event;
  const url = new URL(request.url);

  // API requests (network first)
  if (url.pathname.startsWith('/api/')) {
    event.respondWith(networkFirst(request));
    return;
  }

  // Static assets (cache first)
  if (OFFLINE_ASSETS.some(asset => url.pathname.endsWith(asset))) {
    event.respondWith(cacheFirst(request));
    return;
  }

  // Default: network first for HTML pages
  if (request.headers.get('accept').includes('text/html')) {
    event.respondWith(networkFirst(request));
    return;
  }

  // For other requests (images, fonts, etc.)
  event.respondWith(cacheFirst(request));
});

// Background sync (for failed POST requests)
self.addEventListener('sync', (event) => {
  if (event.tag === 'sync-comments') {
    console.log('[SW] Background sync for comments');
    event.waitUntil(handleFailedRequests());
  }
});

// Push notifications
self.addEventListener('push', (event) => {
  const data = event.data.json();
  event.waitUntil(
    self.registration.showNotification(data.title, {
      body: data.message,
      icon: '/images/notification-icon.png',
      badge: '/images/badge.png'
    })
  );
});

// Notification click handler
self.addEventListener('notificationclick', (event) => {
  event.notification.close();
  event.waitUntil(
    clients.matchAll({ type: 'window' }).then((clientList) => {
      if (clientList.length > 0) {
        return clientList[0].focus();
      }
      return clients.openWindow('/');
    })
  );
});

// Helper function for background sync
async function handleFailedRequests() {
  const cache = await caches.open('failed-requests');
  const requests = await cache.keys();

  return Promise.all(
    requests.map(async (request) => {
      try {
        const response = await fetch(request);
        await cache.delete(request);
        return response;
      } catch (error) {
        console.error('[SW] Retry failed:', error);
      }
    })
  );
}
