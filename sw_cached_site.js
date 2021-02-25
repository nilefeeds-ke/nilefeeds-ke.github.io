const cacheName = 'v2';



self.addEventListener("install", e => {

});


self.addEventListener("activate", e => {

    //Remove unwanted caches
    e.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cache => {
                    if(cache !== cacheName){
                        //console.log("Service worker clearing old cache: " + cache);
                        return caches.delete(cache);
                    }
                })
            )
        })
    );

});


// Call Fetch
self.addEventListener('fetch', e => {
    //console.log("Service worker fetching");

    e.respondWith(
        fetch(e.request).then(response => {
            //Make copy clone of response
            const resClone = response.clone();
            // open caches
            caches.open(cacheName)
            .then(cache => {
                //Add response to caches
                cache.put(e.request, resClone);
            });
            return response;
        }).catch(err => caches.match(e.request).then(response => response))
    )
})