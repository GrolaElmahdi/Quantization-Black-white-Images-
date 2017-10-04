<?php

require 'vendor/autoload.php';




function insert_image($json){
  $client = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $bulk = new MongoDB\Driver\BulkWrite();
  $bulk->insert($json);
  echo "done !";
  echo $json;

  $client->executeBulkWrite('imageprocessing.images',$bulk);
}

 ?>
