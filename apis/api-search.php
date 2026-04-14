<?php
// set filter variable to empty as default
$filter = "";

// grab beds input value from form
// set beds = to number_of_rooms in db
$beds = htmlspecialchars($_POST["beds"] ?? null);
if (!empty($beds)) {
    $filter .= " number_of_rooms = :beds";
}

// grab baths input value from form
//check if beds input is empty or not
//set baths = to number_of_bathrooms in db
$baths = htmlspecialchars($_POST["baths"] ?? null);
if (!empty($baths)) {
    $filter .= !empty($filter)? " AND number_of_bathrooms = :baths" : " number_of_bathrooms = :baths";
}

// connect to db and grab items that matches the filter from form input values
require_once __DIR__."/../db.php";
$sql = "SELECT pk, lat, lon, type FROM items"; 
if (!empty($filter)){
    $sql .= " WHERE" . $filter;
}
// prepare sql statement (like tuples in python)
$stmt = $_db->prepare( $sql);

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

// set the url to beds=$beds and baths=$baths, and items=$items
$data = ["url"=>
[
    ["beds"=>$beds],
    ["baths"=>$baths]
],
"items"=>$items
];
?>

<browser mix-function="clear_markers">
<?= json_encode($data) ?>
</browser>
<!-- TODO: put beds and bats in the nav and make it possible to filter via them -->






