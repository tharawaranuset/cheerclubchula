<?php

    include("functions.php");
	
    $query_size = "SELECT * FROM dimension WHERE id = '1'";

    $result_size = mysqli_query($link, $query_size);

    $row_size = mysqli_fetch_assoc($result_size);

    $stand_w2 = $row_size['s-width'];
    $stand_h2 = $row_size['s-height'];

    $plate_w2 = $row_size['p-width'];
    $plate_h2 = $row_size['p-height'];

    $row_char = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ');
    
    session_start();

    $row = $_SESSION['row'];
    $column = $_SESSION['column'];

    $seat = $row_char[$row].$column;

    $query125 = "SELECT * FROM code WHERE status = 0 AND type = 3 ORDER BY sequence";

    $result125 = mysqli_query($link, $query125);

    $row125 = mysqli_fetch_all($result125);

    $code125 = '';
    $code125 .= '<div class="row mr-1">';

    $query_color125 = "SELECT * FROM color WHERE type = '125'";

    $result_color125 = mysqli_query($link, $query_color125);

    $row_color125 = mysqli_fetch_all($result_color125);

    for( $i = 0; $i < mysqli_num_rows($result125); $i++ ){
        
        $im = imagecreatefrombmp('code/1-25/'.$row125[$i][8].'.bmp');
        imagealphablending($im, false);
        
        $code125 .= '<div class="col my-2 mx-auto" style="width: 130px;">';
        
        $code125 .= 'CODE: '.str_pad($i+1, 2, "0", STR_PAD_LEFT);
        $code125 .= '<table style="border: 1px solid black;width: 125px;table-layout: fixed;">';
        
        for($y = 0; $y < $plate_h2; $y++){
            
            $code125 .= '<tr style="border: 1px solid black;">';
            
            for($x = 0; $x < $plate_w2; $x++){
                
                $rgb = imagecolorat($im, ($column-1)*$plate_w2+$x, $row*$plate_h2+$y);

                $colors = imagecolorsforindex($im, $rgb);

                $code125 .= '<td style="border: 1px solid black; width: 25px;text-align:center">';
                
                for($zz = 0 ; $zz < mysqli_num_rows($result_color125) ; $zz++){

                    if($colors["red"] == $row_color125[$zz][3] and $colors["green"] == $row_color125[$zz][4] and $colors["blue"] == $row_color125[$zz][5]){
                        $code125 .= $row_color125[$zz][2];
                    }
                    

                }
                
                $code125 .= '</td>';
                
            }
            
            $code125 .= '</tr>';
        }
        
        $code125 .= '</table>';
        
        $code125 .= '</div>';
        
    }

    $code125 .= '</div>';



    $query11 = "SELECT * FROM code WHERE status = 0 AND type = 1 ORDER BY category, sequence";

    $result11 = mysqli_query($link, $query11);

    $row11 = mysqli_fetch_all($result11);

    $code11 = '';
    $code11 .= '<div class="row">';

    $query_color11 = "SELECT * FROM color WHERE type = '11'";

    $result_color11 = mysqli_query($link, $query_color11);

    $row_color11 = mysqli_fetch_all($result_color11);

    for( $i = 0; $i < mysqli_num_rows($result11); $i++ ){
        
        $im = imagecreatefrombmp('code/1-1/'.$row11[$i][8].'.bmp');
        imagealphablending($im, false);
        
        $rgb = imagecolorat($im, $column-1, $row);

        $colors = imagecolorsforindex($im, $rgb);
        
        $code11 .= '<div class="col my-2 mx-1" style="width:43px;font-size: 12px;">';
        
        $code11 .= str_pad($i+1, 3, "0", STR_PAD_LEFT);
        
        $code11 .= '<div class="mx-0 px-0" style="border: 1px solid black;width: 43px;text-align: center;">';
        
        for($zz = 0 ; $zz < mysqli_num_rows($result_color11) ; $zz++){

            if($colors["red"] == $row_color11[$zz][3] and $colors["green"] == $row_color11[$zz][4] and $colors["blue"] == $row_color11[$zz][5]){
                $code11 .= $row_color11[$zz][2];
            }


        }
        
        
        $code11 .= '</div></div>';
        
    }

    $code11 .= '</div>';


    $code11seq = '';

    $query11seq = "SELECT * FROM code WHERE status = 0 AND type = 2 ORDER BY sequence";

    $result11seq = mysqli_query($link, $query11seq);

    $row11seq = mysqli_fetch_all($result11seq);
    

    for( $i = 0; $i < mysqli_num_rows($result11seq); $i++ ){
        
        $file_11seq = explode(",",$row11seq[$i][8]);
            
        $code11seq .= '<div class="table-responsive">';

        $code11seq .= '<table class="table table-sm" style="border: none;"><tr><td>'.$row_char[$i].':</td>';
            
        for($k = 0; $k < sizeof($file_11seq); $k++){
            
            $im = imagecreatefrombmp('code/1-1-sequence/'.$file_11seq[$k].'.bmp');
            imagealphablending($im, false);
            
            $rgb = imagecolorat($im, $column-1, $row);

            $colors = imagecolorsforindex($im, $rgb);

            $code11seq .= '<td class="" style="padding:2px;font-size: 12px;">'.str_pad($k+1, 2, "0", STR_PAD_LEFT);

            $code11seq .= '<div style="border: 1px solid black;width: 43px;text-align: center;" class="px-0">';

            for($zz = 0 ; $zz < mysqli_num_rows($result_color11) ; $zz++){

                if($colors["red"] == $row_color11[$zz][3] and $colors["green"] == $row_color11[$zz][4] and $colors["blue"] == $row_color11[$zz][5]){
                    $code11seq .= $row_color11[$zz][2];
                }


            }
            
            $code11seq .= '</div></td>';
            
        }
        
        $code11seq .= '</tr></table></div>';
        
    }


?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

	<link rel="stylesheet" href="styles.css">
      
    <link rel="icon" href="favicon.png">
      
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>SEAT: <?php echo $seat; ?></title>

    </head>

    <body>

        <div class="container mt-3 mx-2">

            <div class="row">

                <div class="col h4">SEAT: <?php echo $seat; ?></div>
                
            </div>

            <hr>

            <div class="row">

                <div class="col h5 mt-2">CODE 1:25</div>

            </div>

            <?php echo $code125; ?>

            <div class="row">

                <div class="col h5 mt-2">CODE 1:1</div>

            </div>

            <?php echo $code11; ?>

            <div class="row">

                <div class="col h5 my-3">CODE 1:1 ต่อเนื่อง</div>

            </div>

            <?php echo $code11seq; ?>

        </div>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

  </body>
</html>


