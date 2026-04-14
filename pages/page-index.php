<?php
$title = "Home";
$active = "index";
require_once __DIR__.'/../components/_header.php';

$user_input = '<script>alert()</script>';
out($user_input);

?>

<script>
    // Initialize the map
    const map = L.map('map').setView([55.70147369679121, 12.580483176217838], 12);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap &copy; CARTO',
        subdomains: 'abcd',
        maxZoom: 20
    }).addTo(map);       

</script>


<?php
require_once __DIR__.'/../components/_footer.php';
?>