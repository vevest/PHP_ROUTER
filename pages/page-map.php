<?php
$title = "Home";
$active = "index";
require_once __DIR__.'/../components/_header.php';

// Connecting to the db to get all items
require_once __DIR__.'/../db.php';
$sql = "SELECT * FROM items";
$stmt = $_db->prepare($sql);
$stmt ->execute();
$items = $stmt ->fetchAll();

// Creates variable for filter that by default is empty
$filter = "";

// get input for the variable beds and check if it is empty
$beds = htmlspecialchars($_GET["beds"] ?? "");
if (!empty($beds)) {
    // if input for beds not empty, set beds = number_of_rooms from the db
    $filter .= " number_of_rooms = :beds";
}

// get input for baths and check if empty
$baths = htmlspecialchars($_GET["baths"] ?? "");
if (!empty($baths)) {
    // if not empty and beds input not empty 
    //set and baths = number_of_bathrooms from db
    // if beds is emput set only baths = number_of_bathrooms from db
    $filter .= !empty($filter)? " AND number_of_bathrooms = :baths" : " number_of_bathrooms = :baths";
}

// connect to db, get the pk, lat, long from items that matches "$filter"
require_once __DIR__."/../db.php";
$sql = "SELECT pk, lat, lon, type FROM items"; 
if (!empty($filter)){
    $sql .= " WHERE" . $filter;
}
$stmt = $_db->prepare( $sql);
// prepare sql statement (like tuples in python)

if (!empty($beds)) {
    $stmt->bindValue(":beds", $beds);
}

if (!empty($baths)) {
    $stmt->bindValue(":baths", $baths);
}
// bind values/set values equal to the php variable

$stmt->execute();
// make employe go to the db with all this and then fetch all that matches
$items = $stmt->fetchAll();

?>
    
    
    <main>
        <div id="map"></div>

            <nav>
                <form mix-post="api-search">
                    beds
                    <input name="beds" type="number" value="<?= $beds ?>">
                    bathrooms
                    <input name="baths" type="number" value="<?= $baths ?>">
                    <button type="submit">Search</button>
                </form>
            </nav>
            <script>

            // Create custom icon
            var house_icon = L.icon({
                // iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
                iconUrl: 'http://127.0.0.1/static/house.svg',
                iconSize: [24, 24],
                iconAnchor: [16, 16],
                popupAnchor: [0, -24]
            });
            var apartment_icon = L.icon({
                // iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
                iconUrl: 'http://127.0.0.1/static/apartment.svg',
                iconSize: [24, 24],
                iconAnchor: [16, 16],
                popupAnchor: [0, -24]
            });

            // Initialize the map
            const map = L.map('map').setView([55.67960020013266, 12.56464935119663], 7);

            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; OpenStreetMap &copy; CARTO',
                subdomains: 'abcd',
                maxZoom: 18
            }).addTo(map);

            // var markers = L.markerClusterGroup();
            var markers = L.markerClusterGroup({
                disableClusteringAtZoom: 15,  // <- key option
                spiderfyOnMaxZoom: true,
                // showCoverageOnHover: false,
                maxClusterRadius: 100   // default is 100 pixels
            });

            const items = <?= json_encode($items) ?>;
            console.log(items);
            items.forEach(item => {
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


        </script>


        <div id="info">


        
        </div>
    </main>
    
   
<?php
require_once __DIR__.'/../components/_footer.php';
?>