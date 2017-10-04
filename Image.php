<?php

  /*
  * user : GROLA
  * author : ELmahdi GROLA
  * atom editor
  */
  require('flags.php');
  require('database.php');

  function create_image($image_file){
    echo "Image file :) <br>";

    // Cree un objet source a partir d'une image jpeg.
    $im = imagecreatefromjpeg($image_file);

    // Recupere le largeur et l'hauteur de l'image.
    $w = imagesx($im);
    $h = imagesy($im);

    // Cree un tableau associatif pour
    $json_array = array('_id'=>'','name'=>'','created_at'=>date("Y-m-d"),'w'=>$w,'h'=>$h);
    echo "x : ".$w." & y : ".$h."<br>";

    //var_dump($json_array);
    //echo json_encode($json_array);
    //echo "<br> Add new element<br>";

    // values est un tableau contenant les valeurs des pixels rangées dans 5 rangs


    for($y=0;$y<$h;$y++){

      // pour chaque ligne dans la matrice imagecolorat, on cree un tableau associatif
      // qui contient les 5 rangs. A la fin, on va l'ajouter au tableau $json_array.

      $values = array("0"=>array(),"1"=>array(),"2"=>array(),"3"=>array(),"4"=>array());

      for($x=0;$x<$w;$x++){

        // pour chaque colone (pixel (x,y)), on recupere un entier indiquant la color du pixel,
        // si l'image est de truecolor (256 couleurs), la fonction retourne un entier indiquant le RGB.
        $rgb = imagecolorat($im,$$x,$y);

        // la fonction retourne un tableau associatif contenant les 3 couleurs.
        $colors = imagecolorsforindex($im,$rgb);

        // on recupere une valeur du tableau $colors.
        $value = $colors["red"];

        // la fonction retourn le rang de $value, soit 0 ,1, 2 ,3 ou 4.
        $flag = rangevalue($value);

        // On ajoute la postition dans le case associé. exempel : $valeurs[0] = [22,43,50] et $values[1] = [67,98]
        array_push($values[$flag],$x);

      }
      // on ajoute un couple clé/valeur dans le tableau $json_array clé=y courante, valeur= le tableau $values
      $json_array[$y] = $values;

    }

    echo json_encode($json_array);
    //echo '<br>'.json_encode($json_array);
    // On insere $json_array a la base de données mongodb
    // pas besoin de formater le tableau $json_array sous format json,
    // le manager de mongodb s'occupe.
    insert_image($json_array);
    echo "<br>After algorithm";
    echo '<br>';

  }


 ?>
