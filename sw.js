const cacheName = 'v1';

const cacheAssets = [
    "./",
    "./manifest.json",
    "./assets/css/main.css",
    "./assets/js/main.js",
    "./assets/js/airtable.js",
    "./assets/css/typography.css",
    "./assets/json/main.json",
    "./assets/images/logo.png",
    "./assets/images/logo-bigger255.png"
];

self.addEventListener("install", e => {
    e.waitUntil(
        caches.open(cacheName).then(cache => {
            console.log("ServiceWorker: Caching Files");
            return cache.addAll(cacheAssets);
        })
        .then(() => self.skipWaiting())
    );
});


self.addEventListener("activate", e => {

    //Remove unwanted caches
    e.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cache => {
                    if(cache !== cacheName){
                        console.log("Service worker clearing old cache: " + cache);
                        return caches.delete(cache);
                    }
                })
            )
        })
    );

});


// Call Fetch
self.addEventListener('fetch', e => {
    console.log("Service worker fetching");

    e.respondWith(
        fetch(e.request).catch(() => caches.match(e.request))
    )
})