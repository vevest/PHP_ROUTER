<?php
ini_set("display_errors", 0);
 
 
//In PHP to check if a variable is there/exsist, use isset

 if( ! isset($size) ){
   echo "Category only";
   exit;
 }

 echo "Category and size";
 
 ?>

<div>
    <?= "Category: $category and size: $size" ?>
</div>
