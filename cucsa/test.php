<?php

$link = mysqli_connect("localhost", "u135549982_cucsa", "cucheerclub72!", "u135549982_cucsa");

$query_dim = "SELECT * FROM dimension WHERE id = '1'";

$result_dim = mysqli_query($link, $query_dim);

$row_dim = mysqli_fetch_assoc($result_dim);

echo $row_dim['p-width'];
echo $row_dim['p-height'];

echo $row_dim['s-width'];
echo $row_dim['s-height'];


list($width, $height) = getimagesize("01_correct.bmp");

echo $width;
echo $height;

$im = imagecreatefrombmp("01_correct.bmp");

$query_color = "SELECT * FROM color WHERE type = '125'";

$result_color = mysqli_query($link, $query_color);

$row_color = mysqli_fetch_all($result_color);

for( $xx = 0 ; $xx < $width ; $xx++ ){
    for( $yy = 0 ; $yy < $height ; $yy++ ){
        
        $rgb = imagecolorat($im, $xx, $yy);

        $colors = imagecolorsforindex($im, $rgb);        
        
        echo "<p>";
        echo $xx.','.$yy.':'.$colors["red"].'-'.$colors["green"].'-'.$colors["blue"].'-'.$colors["alpha"].' >>> ';
        

        $ch2 = false;
        $ch = false;

        for($zz = 0 ; $zz < mysqli_num_rows($result_color) ; $zz++){
            
            echo $row_color[$zz][3].'-'.$row_color[$zz][4].'-'.$row_color[$zz][5].'*';

            if($colors["red"] == $row_color[$zz][3] and $colors["green"] == $row_color[$zz][4] and $colors["blue"] == $row_color[$zz][5]){
                $ch2 = $ch2 || true;
                echo 'ch2 = true';
            }
            else{
                $ch2 = $ch2 || false;
                echo 'ch2 = false';
            }
        }

        if(!$ch2){
            $ch = true;
            echo 'ch = true';
        }
        else{
            echo 'ch = false';
        }

    }
}



?>