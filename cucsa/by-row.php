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

    $code_row = '';

    $row = $_SESSION['row'];


    $query_color125 = "SELECT * FROM color WHERE type = '125'";

    $result_color125 = mysqli_query($link, $query_color125);

    $row_color125 = mysqli_fetch_all($result_color125);


    $query_color11 = "SELECT * FROM color WHERE type = '11'";

    $result_color11 = mysqli_query($link, $query_color11);

    $row_color11 = mysqli_fetch_all($result_color11);


    $query125 = "SELECT * FROM code WHERE status = 0 AND type = 3 ORDER BY sequence";

    $result125 = mysqli_query($link, $query125);

    $row125 = mysqli_fetch_all($result125);


    $query11 = "SELECT * FROM code WHERE status = 0 AND type = 1 ORDER BY category, sequence";

    $result11 = mysqli_query($link, $query11);

    $row11 = mysqli_fetch_all($result11);


    $query11seq = "SELECT * FROM code WHERE status = 0 AND type = 2 ORDER BY sequence";

    $result11seq = mysqli_query($link, $query11seq);

    $row11seq = mysqli_fetch_all($result11seq);

    if($row != -1){
        
        for($column = 1; $column <= $stand_w2; $column++){
            
            
            $seat = $row_char[$row].$column;
            
            $code125 = '';

            $code125 .= '<table style="width:700px; border: none;font-size: 14px;">';
            
            
            for( $i = 0; $i < mysqli_num_rows($result125); $i++ ){

                $im = imagecreatefrombmp('code/1-25/'.$row125[$i][8].'.bmp');
                imagealphablending($im, false);
                
                if($i % 5 == 0){
                    
                    $code125 .= '<tr style="border: none; height: 150px; padding: 0px;">';
                    
                }

                $code125 .= '<td style="width: 140px; table-layout: fixed;">';

                $code125 .= '<span style="font-weight: bold;">CODE: '.str_pad($i+1, 2, "0", STR_PAD_LEFT).'</span>';
                $code125 .= '<table style="border: 1px solid black;width: 125px;table-layout: fixed;height:100px">';

                for($y = 0; $y < $plate_h2; $y++){

                    $code125 .= '<tr style="border: 1px solid black;">';

                    for($x = 0; $x < $plate_w2; $x++){

                        $rgb = imagecolorat($im, ($column-1)*$plate_w2+$x, $row*$plate_h2+$y);

                        $colors = imagecolorsforindex($im, $rgb);

                        $code125 .= '<td style="border: 1px solid black; width: 25px;text-align:center;height:20px">';

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
                
                $code125 .= 'OpenShut: '.str_pad($i+1, 2, "0", STR_PAD_LEFT);

                $code125 .= '</td>';
                
                if(($i+1) % 5 == 0 or $i == mysqli_num_rows($result125)-1){
                    
                    $code125 .= '</tr>';
                    
                }

            }

            $code125 .= '</table>';
            

            $code11 = '';
            $code11 .= '<table style="width: 750px; border: none;table-layout: fixed">';


            for( $i = 0; $i < mysqli_num_rows($result11); $i++ ){

                $im = imagecreatefrombmp('code/1-1/'.$row11[$i][8].'.bmp');
                imagealphablending($im, false);
                
                if($i % 15 == 0){
                    
                    $code11 .= '<tr style="border: none; height: 40px;table-layout: fixed">';
                    
                }

                $rgb = imagecolorat($im, $column-1, $row);

                $colors = imagecolorsforindex($im, $rgb);

                $code11 .= '<td style="width:50px;font-size: 12px;table-layout: fixed">';

                $code11 .= str_pad($i+1, 3, "0", STR_PAD_LEFT);

                $code11 .= '<div class="mx-0 px-0" style="border: 1px solid black;width: 43px;text-align: center;">';

                for($zz = 0 ; $zz < mysqli_num_rows($result_color11) ; $zz++){

                    if($colors["red"] == $row_color11[$zz][3] and $colors["green"] == $row_color11[$zz][4] and $colors["blue"] == $row_color11[$zz][5]){
                        $code11 .= $row_color11[$zz][2];
                    }


                }


                $code11 .= '</div></td>';
                
                if(($i+1) % 15 == 0 or $i == mysqli_num_rows($result11)-1){
                    
                    $code11 .= '</tr>';
                    
                }

            }

            $code11 .= '</table>';


            $code11seq = '<table style="border: none;">';

            for( $i = 0; $i < mysqli_num_rows($result11seq); $i++ ){

                $file_11seq = explode(",",$row11seq[$i][8]);

                $code11seq .= '<tr style="border: none; height: 45px;table-layout: fixed"><td style="width:30px;table-layout: fixed; font-size: 18px; font-weight: bold;vertical-align: bottom;padding-bottom:4px">'.$row_char[$i].':</td>';

                for($k = 0; $k < sizeof($file_11seq); $k++){

                    $im = imagecreatefrombmp('code/1-1-sequence/'.$file_11seq[$k].'.bmp');
                    imagealphablending($im, false);

                    $rgb = imagecolorat($im, $column-1, $row);

                    $colors = imagecolorsforindex($im, $rgb);

                    $code11seq .= '<td style="width: 46px;font-size: 12px;table-layout: fixed" >'.str_pad($k+1, 2, "0", STR_PAD_LEFT);

                    $code11seq .= '<div class="mx-0 px-0" style="border: 1px solid black;width: 43px;text-align: center;">';

                    for($zz = 0 ; $zz < mysqli_num_rows($result_color11) ; $zz++){

                        if($colors["red"] == $row_color11[$zz][3] and $colors["green"] == $row_color11[$zz][4] and $colors["blue"] == $row_color11[$zz][5]){
                            $code11seq .= $row_color11[$zz][2];
                        }


                    }

                    $code11seq .= '</div></td>';

                }

                $code11seq .= '</tr>';

            }
            
            $code11seq .= '</table>';


            $code_row .= 
            
            '              

            <table style="width: 750px;">
            
                <tr>

                    <td class="h4">SEAT: '.$seat.'</td>
                    <td class="text-right">PAGE A</td>
                
                </tr>

            </table>

            <hr align="left" width="750" style="border: 1px solid black;">

            <div class="h5" style="width: 750px;">CODE 1:25</div>

            '.$code125.'


            <p style="page-break-before: always"></p>  

            <table style="width: 750px;">
            
                <tr>

                    <td class="h4">SEAT: '.$seat.'</td>
                    <td class="text-right">PAGE B</td>
                
                </tr>

            </table>

            <hr align="left" width="750" style="border: 1px solid black;">

            <div class="h5" style="width: 750px;">CODE 1:1</div>

            '.$code11.'

            <div class="h5 my-2" style="width: 750px;">CODE 1:1 ต่อเนื่อง</div>

            '.$code11seq.'

            ';
            
            if($column != $stand_w2){

                $code_row .= '<p style="page-break-before: always"></p>';    
            
            }
            
        }
            
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

    <title>PRINT ALL</title>
    </head>

    <body>

        <?php echo $code_row; ?>

        

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>



  </body>
</html>

