<?php



 function rangevalue($value){

   if($value == 255)
      return 4;
    return intval($value/51);

}

 ?>
