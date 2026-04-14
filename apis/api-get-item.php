<?php 
$item_pk =$_GET["item_pk"]; 
require_once __DIR__.'/../db.php'; 
$sql = "SELECT * FROM items WHERE pk = :item_pk"; 
$stmt = $_db->prepare($sql); 
$stmt ->bindValue(":item_pk", $item_pk); 
$stmt ->execute(); $item = $stmt ->fetch(); 

$type = $item["type"] ?? ""; 

$road_name = $item["road_name"] ?? ""; 
$house_number = $item["house_number"] ?? ""; 
$city_name = $item["city_name"] ?? ""; 
$zip_code = $item["zip_code"] ?? ""; 
$address = "$road_name $house_number, $city_name $zip_code"; 

$square_meters = $item["floor_square_meters"] ?? 0; 

$rooms = $item["number_of_rooms"] ?? 0; 

$img_path = $item["main_image_path"] ?? "No image"; 

$price = $item["price"] ?? 0; 

?> 
<browser mix-update='#info'> 

<?php require_once __DIR__."/../micro-components/___item-info.php" ?> 

<p>Current status: <?= $item["status"]; 

?>

</p> 
<button id="btn-<?= $item_pk ?>" mix-post="api-mark-item-sold?item_pk=<?= $item_pk ?>"> Mark as sold <button> </browser>

    <p id="test"></p>