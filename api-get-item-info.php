<?php

try{

    require_once __DIR__."/db.php";

    $sql = "SELECT * FROM items WHERE item_pk = :item_pk LIMIT 1";
    $stmt = $_db->prepare($sql);
    $stmt->bindValue(":item_pk", $item_pk);
    $stmt->execute();

    $item = $stmt->fetch();

    if( ! $item ){
        throw new Exception("item not found", 404);
    }

    ?>
    <div mix-update=".info">
        <h3>Boliginfo</h3>
        <p>Pris: <?= htmlspecialchars($item["price"]) ?></p>
        <p>Type: <?= htmlspecialchars($item["type"]) ?></p>
    </div>
    <?php
    exit();
}
catch(Exception $e){

    http_response_code($e->getCode() ?: 500);

    ?>
    <div mix-update="#info">
        <?= htmlspecialchars($e->getMessage()) ?>
    </div>
    <?php
    exit();
}