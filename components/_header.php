<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
    <link rel="stylesheet" href="/static/app.css">

    <title>
        <?php echo $title ?? 'Company' ?>
    </title>
</head>

<body>
    
    <nav>
        <!-- Ternary used to inject the word active with what the variable $active is in there -->
        <!-- says if the $active variable is index change the class to "active" else keep it empty -->
        <a href="/" 
        class="<?= $active == 'index' ? 'active' : '' ?>">
        Home</a>
        <a href="/contact-us" 
        class="<?= $active == 'contact' ? 'active' : '' ?>">
        Contact us</a>
        <a href="/about-us" 
        class="<?= $active == 'about' ? 'active' : '' ?>">
        About us</a>
    </nav>
    
    

        