<?php

require_once __DIR__.'/router.php';

get('/', 'pages/page-index.php');

get('/page-map', 'pages/page-map.php');

get('/contact-us', 'pages/page-contact-us.php');

get('/about-us', 'pages/page-about-us.php');

# Dynamic url with 1 variable
get('/items/$category', 'pages/items.php');

# Dynamic url with 2 variables
get('/items/$category/size/$size', 'pages/items.php');


get('/api-get-item', 'api-get-item.php');


get('/search/$beds/$baths/$price_min/$price_max/$zip', 'pages/search.php');

// Dynamic GET. Example with 2 variables
// The $name will be available in full_name.php
// The $last_name will be available in full_name.php
// In the browser point to: localhost/user/X/Y
#get('/user/$name/$last_name', 'views/full_name.php');


###### Example ######
// Static GET
// In the URL -> http://localhost
// The output -> Index
# get('/', 'views/index.php');