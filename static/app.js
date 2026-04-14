function clear_markers(data){

    const urlParams = new URLSearchParams(window.location.search)
    //urlParams.set('beds', '2')
    //urlParams.set('baths', '1')
    // window.history.replaceState({}, '', `?${urlParams.toString()}`)

    
    markers.clearLayers()
    data = JSON.parse(data)
    console.log(data.url)
    // grab data values key and value to be the url
    data.url.forEach( prop =>{
        console.log(Object.keys(prop)[0])
        let key = Object.keys(prop)[0]
        // Object.keys(prop)[0] used to get the key
        console.log(prop[key])
        let value = prop[key]
        // prop[key] used to get the value for the key
        urlParams.set(key, value)
        // use the key and value as the parameters in the url
    })
    window.history.replaceState({}, '', `?${urlParams.toString()}`)

    // items = JSON.parse(items)
    //console.log(items)
    
    
    data.items.forEach(item => {
        if( item.type == "villa" ){
            var marker = L.marker([item.lat, item.lon], {
                icon: L.divIcon({
                    className: '',
                    html: `
                        <button 
                            class="marker ${item.type}" onclick="mixhtml(); return false;"
                            mix-get="api-get-item?item_pk=${item.pk}">
                        </button>
                    `,
                }),
                item_pk: item.pk
            });
        }
        else if( item.type == "condo" ){
            var marker = L.marker([item.lat, item.lon], {
                icon: L.divIcon({
                    className: '',
                    html: `
                        <button 
                            class="marker ${item.type}" onclick="mixhtml(); return false;"
                            mix-get="api-get-item?item_pk=${item.pk}">
                        </button>
                    `,
                }),
                item_pk: item.pk
            });
        }
        else{
            var marker = L.marker([item.lat, item.lon], {
                icon: L.divIcon({
                    className: '',
                    html: `
                        <button 
                            class="marker ${item.type}" onclick="mixhtml(); return false;"
                            mix-get="api-get-item?item_pk=${item.pk}">
                        </button>
                    `,
                }),
                item_pk: item.pk
            });
        }
        markers.addLayer(marker)
    });
    map.addLayer(markers)


}