<?php

    include("functions.php");

    session_start();

	error_reporting(E_ALL & ~E_WARNING); // ปิด Warning
	ini_set('display_errors', 0); // ปิดการแสดง error

    $ch = false;
	$checkcolor = false;
	$checkdimension = false;

    if($_SESSION['success_addcode']=='success'){

        $_SESSION['alert_add'] = '

            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Your code has already added!
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>

        ';

        $_SESSION['success_addcode']='';

    }
    elseif($_SESSION['success_addcode']=='fail'){
        
        // กำหนด alert เป็นค่าเริ่มต้น (ตัวแปรว่างหรือเป็น array เพื่อเก็บหลายข้อความ)
		$alertMessage = '';

		// เช็คเงื่อนไขต่างๆ แล้วเพิ่มข้อความไปที่ $alertMessage
		if ($_SESSION['checkbmp']=='non-bmp') {
    		$alertMessage .= 'Incorrect file type (.bmp only)';
            $_SESSION['checkbmp'] = '';
		}

		if ($_SESSION['checkdimension']=='bad-dimension') {
   			$alertMessage .= ' / Incorrect dimension';
            $_SESSION['checkdimension'] = '';
		}

		if ($_SESSION['checkcolor']=='bad-color') {
    		$alertMessage .= ' / Incorrect index color ';
            $_SESSION['checkcolor'] = '';
		}

        $_SESSION['alert_add'] = '

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              ' . $alertMessage . '
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>

        ';

        $_SESSION['success_addcode']='';

    }
    else{

        $_SESSION['alert_add'] = '';

    }

    if($_GET['action'] == "logout") {

        $_SESSION['menu'] = "";
        
        $_SESSION['footer'] = "";

        $_POST['action'] = "";

        $_GET['action'] = "";

        setcookie("id", -1, time() + (86400), "/");

        session_unset();

        header("Location: index.php");

    }

    elseif ($_POST['action'] == "login") {

        $query1 = "SELECT * FROM user WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

        $result1 = mysqli_query($link, $query1);

        $row1 = mysqli_fetch_assoc($result1);

        $query2 = "SELECT * FROM secret WHERE role = '". $row1['role'] ."' LIMIT 1";

        $result2 = mysqli_query($link, $query2);

        $row2 = mysqli_fetch_assoc($result2);

        if ($row2['verif'] == $_POST['password']) {

            if($row2['name'] == "admin") {

                $cookie_name = "id";
                $cookie_value = $row1['id'];
                setcookie($cookie_name, $cookie_value, time() + (86400), "/");

                $_POST['action'] ="";
                header("Location: index.php");


            } elseif($row2['name']=="editor"){

                $cookie_name = "id";
                $cookie_value = $row1['id'];
                setcookie($cookie_name, $cookie_value, time() + (86400), "/");

                $_POST['action'] = "";
                header("Location: index.php");

            }

        } else {

                $alert_sign = '<div class="alert alert-danger alert-dismissible" role="alert">Could not find that username/password combination. Please try again.!</div>';

        }

    }

    elseif($_POST['action'] == "signup"){


        $query1x = "SELECT * FROM user WHERE email = '".$_POST['email']."' LIMIT 1";

        $result1x = mysqli_query($link, $query1x);

        $row1x = mysqli_fetch_assoc($result1x);

        $query2 = "SELECT * FROM secret WHERE role = '". $_POST['role'] ."' LIMIT 1";

        $result2 = mysqli_query($link, $query2);

        $row2 = mysqli_fetch_assoc($result2);

        if($row1x['email']==''){

            if($row2['verif'] == $_POST['password']){

                $query3 = "INSERT INTO user (`email`, `role`,`nickname`) VALUES ('". mysqli_real_escape_string($link, $_POST['email']). "','" . mysqli_real_escape_string($link, $_POST['role']) ."','" . mysqli_real_escape_string($link, $_POST['nickname']) ."')";

                mysqli_query($link, $query3);

                $_SESSION['success_signup'] = true;

                header("Location: index.php");

            }


        } else {

            $alert_sign2 = '

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Password is incorrect! or This email has already taken. Please contact CU Cheer Club staff
                  <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                  </button>
                </div>

            ';
            $_POST = array();

        }

    }

    elseif($_POST['action'] == "add-code"){



        for( $i=0 ; $i < count($_FILES["fileUpload"]["name"]) ; $i++ ) {

            if(pathinfo($_FILES["fileUpload"]["name"][$i], PATHINFO_EXTENSION) != 'bmp'){

               $ch = true;


            }

            list($width, $height) = getimagesize($_FILES["fileUpload"]["tmp_name"][$i]);

            $query_dim = "SELECT * FROM dimension WHERE id = '1'";

            $result_dim = mysqli_query($link, $query_dim);

            $row_dim = mysqli_fetch_assoc($result_dim);

            $plate_w = $row_dim['p-width'];
            $plate_h = $row_dim['p-height'];

            $stand_w = $row_dim['s-width'];
            $stand_h = $row_dim['s-height'];

            $im = imagecreatefrombmp($_FILES["fileUpload"]["tmp_name"][$i]);
            imagealphablending($im, false);


            if($_POST['type'] == 1 or $_POST['type'] == 2){


                if($width != $stand_w or $height != $stand_h){

                    $checkdimension = true;

                }

                $query_color = "SELECT * FROM color WHERE type = '11'";

                $result_color = mysqli_query($link, $query_color);

                $row_color = mysqli_fetch_all($result_color);

                for( $xx = 0 ; $xx < $width ; $xx++ ){
                    for( $yy = 0 ; $yy < $height ; $yy++ ){

                        $rgb = imagecolorat($im, $xx, $yy);

                        $colors = imagecolorsforindex($im, $rgb);

                        $ch2 = false;

                        for($zz = 0 ; $zz < mysqli_num_rows($result_color) ; $zz++){

                            if($colors["red"] == $row_color[$zz][3] and $colors["green"] == $row_color[$zz][4] and $colors["blue"] == $row_color[$zz][5]){
                                $ch2 = $ch2 || true;
                            }
                            else{
                                $ch2 = $ch2 || false;
                            }
                        }

                        if($ch2 == false){
                            $checkcolor = true;

                        }

                    }
                }

            }


            if($_POST['type'] == 3){

                if($width != $stand_w * $plate_w or $height != $stand_h * $plate_h){

                    $checkdimension = true;
                        
                }


                $query_color = "SELECT * FROM color WHERE type = '125'";

                $result_color = mysqli_query($link, $query_color);

                $row_color = mysqli_fetch_all($result_color);

                for( $xx = 0 ; $xx < $width ; $xx++ ){
                    for( $yy = 0 ; $yy < $height ; $yy++ ){

                        $rgb = imagecolorat($im, $xx, $yy);

                        $colors = imagecolorsforindex($im, $rgb);

                        $ch2 = false;

                        for($zz = 0 ; $zz < mysqli_num_rows($result_color) ; $zz++){

                            if($colors["red"] == $row_color[$zz][3] and $colors["green"] == $row_color[$zz][4] and $colors["blue"] == $row_color[$zz][5]){
                                $ch2 = $ch2 || true;
                            }
                            else{
                                $ch2 = $ch2 || false;
                            }
                        }

                        if($ch2 == false){
                            $checkcolor = true;

                        }

                    }
                }


            }

        }

        if($ch == true || $checkcolor == true || $checkdimension == true){

            $_POST = array();
            
            if($ch == true) $_SESSION['checkbmp']='non-bmp';
            if($checkdimension == true) $_SESSION['checkdimension']='bad-dimension';
            if($checkcolor == true) $_SESSION['checkcolor']='bad-color';

            $ch = false;
            $checkcolor = false;
            $checkdimension = false;
            
            

            $_SESSION['success_addcode']='fail';

            header("Location: dashboard.php");

        }

        if($_POST['type'] == 1){

            $date = new DateTime();

            $newfilename = str_pad($_COOKIE['id'], 4, "0", STR_PAD_LEFT).'_'.$date->format('U').'_01';

            if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"][0],"code/1-1/".$newfilename.".bmp")){

                $query = "INSERT INTO code (`type`,`id_owner`,`title`,`description`,`category`,`filename`) VALUES ('". $_POST['type'] ."','" . $_COOKIE['id']."','" . mysqli_real_escape_string($link,$_POST['title'])."','" . mysqli_real_escape_string($link,$_POST['description'])."','" . $_POST['category'] ."','".$newfilename."')";


                if(mysqli_query($link, $query)){

                    $query2 = "SELECT * FROM `code` WHERE filename = '". $newfilename ."' LIMIT 1";

                    $result2 = mysqli_query($link, $query2);

                    $row2 = mysqli_fetch_assoc($result2);

                    $query3 = "INSERT INTO draft (`id_code`, `num_draft`,`cmt_editor`,`filename`) VALUES ('". $row2['id'] ."',1,'" . mysqli_real_escape_string($link,$_POST['comment'])."','" . $newfilename. "')";

                    mysqli_query($link, $query3);

                    $_POST['action'] = "";

                    $_SESSION['success_addcode']='success';



                    $_POST = array();

                    header("Location: dashboard.php");

                }
            }
        } elseif($_POST['type'] == 2){

            $n_file = count($_FILES["fileUpload"]["name"]);

            $name_combine = array($n_file);

            $date = new DateTime();

            for( $i=0 ; $i < $n_file ; $i++ ) {

                $name_combine[$i] = str_pad($_COOKIE['id'], 4, "0", STR_PAD_LEFT).'_'.$date->format('U').'_01_'.str_pad($i+1, 2, "0", STR_PAD_LEFT);

            }

            for( $j=0 ; $j < $n_file ; $j++ ) {

                if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"][$j],"code/1-1-sequence/".$name_combine[$j].".bmp")){


                }

            }

            $query = "INSERT INTO code (`type`,`id_owner`,`title`,`description`,`category`,`filename`) VALUES ('". $_POST['type'] ."','" . $_COOKIE['id']."','" . mysqli_real_escape_string($link,$_POST['title'])."','" . mysqli_real_escape_string($link,$_POST['description'])."','". $_POST['category'] . "','".implode(",",$name_combine)."')";


            if(mysqli_query($link, $query)){

                $query2 = "SELECT * FROM code WHERE filename = '". implode(",",$name_combine) ."' LIMIT 1";

                $result2 = mysqli_query($link, $query2);

                $row2 = mysqli_fetch_assoc($result2);

                $query3 = "INSERT INTO draft (`id_code`, `num_draft`,`cmt_editor`,`filename`) VALUES ('". $row2['id'] ."',1,'" . mysqli_real_escape_string($link,$_POST['comment'])."','" . implode(",",$name_combine). "')";

                mysqli_query($link, $query3);

                $_POST['action'] = "";

                $_SESSION['success_addcode']='success';

                $_POST = array();

                header("Location: dashboard.php");

            }


        } elseif($_POST['type'] == 3){

            $date = new DateTime();

            $newfilename = str_pad($_COOKIE['id'], 4, "0", STR_PAD_LEFT).'_'.$date->format('U').'_01';

            if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"][0],"code/1-25/".$newfilename.".bmp")){

                $query = "INSERT INTO code (`type`,`id_owner`,`title`,`description`,`category`,`filename`) VALUES ('". $_POST['type'] ."','" . $_COOKIE['id']."','" . mysqli_real_escape_string($link,$_POST['title'])."','" . mysqli_real_escape_string($link,$_POST['description']). "','" . $_POST['category']. "','".$newfilename."')";

                if(mysqli_query($link, $query)){

                    $query2 = "SELECT * FROM `code` WHERE filename = '". $newfilename ."' LIMIT 1";

                    $result2 = mysqli_query($link, $query2);

                    $row2 = mysqli_fetch_assoc($result2);

                    $query3 = "INSERT INTO draft (`id_code`, `num_draft`,`cmt_editor`,`filename`) VALUES ('". $row2['id'] ."',1,'" . mysqli_real_escape_string($link,$_POST['comment'])."','" . $newfilename. "')";

                    mysqli_query($link, $query3);

                    $_POST['action'] = "";

                    $_SESSION['success_addcode']='success';

                    $_SESSION['alert_add'] = '

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          Your code has already added!
                          <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                          </button>
                        </div>

                    ';

                    $_POST = array();

                    header("Location: dashboard.php");

                }
            }
        }


    }

//  Check login status

    if($_COOKIE['id'] != -1 and $_COOKIE['id'] != '' and basename($_SERVER['PHP_SELF']) == 'index.php' and $_POST['action'] == ""){

        $query1 = "SELECT * FROM user WHERE id = '". $_COOKIE['id'] ."' LIMIT 1";

        $result1 = mysqli_query($link, $query1);

        $row1 = mysqli_fetch_assoc($result1);




        if($row1['role'] == 1) {

            $_SESSION['menu'] = '
            

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="summary.php">Summary</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="seatpaper.php">Seat Paper</a>
                    </li>
                    
                    <li class="nav-item active">
                        <a class="nav-link" href="random.php">Random CODE</a>
                    </li>
                    
                    <li class="nav-item active">
                        <a class="nav-link" href="user-list.php">Member</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="setting.php">Setting</a>
                    </li>

                </ul>
               
                <form class="form-inline" method="get">
              <button class="btn btn-outline-dark" type="submit" name="action" value="logout" id="logout-button">Logout</button>
            </form>

            </div>
            ';

            $_SESSION['footer'] = '<nav class="navbar fixed-bottom navbar-light bg-light"><span class="mx-auto">Hi! '.$row1['nickname']. ' [Status: Admin]</span></nav>';

            header("Location: dashboard.php");


        } elseif($row1['role'] == 2) {

            $_SESSION['menu'] = '

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    
                    <li class="nav-item active">
                        <a class="nav-link" href="user-list.php">Member</a>
                    </li>
                    
                    <li class="nav-item active">
                        <a class="nav-link" href="setting.php">Setting</a>
                    </li>
                    
                </ul>

                <form class="form-inline" method="get">
                    <button class="btn btn-outline-dark" type="submit" id="logout-button" name="action" value="logout">Logout</button>
                </form>

            </div>
            ';

            $_SESSION['footer'] = '<nav class="navbar fixed-bottom navbar-light bg-light"><span class="mx-auto">Hi! '.$row1['nickname']. ' [Status: Editor]</span></nav>';

            header("Location: dashboard.php");

        }
        else{
            $_SESSION['menu'] = "";
            header("Location: index.php");

        }

    }

    elseif($_COOKIE['id'] != -1 and $_COOKIE['id'] != '' and $_POST['action'] == "edit-code" and $_POST['id'] != ""){

        $query1 = "SELECT * FROM user WHERE id = '". $_COOKIE['id'] ."' LIMIT 1";

        $result1 = mysqli_query($link, $query1);

        $row1 = mysqli_fetch_assoc($result1);

        $query2 = "SELECT * FROM code WHERE id = '". $_POST['id'] ."' LIMIT 1";

        $result2 = mysqli_query($link, $query2);

        $row2 = mysqli_fetch_assoc($result2);

        $query3 = "SELECT * FROM category WHERE id = '". $row2['category'] ."' LIMIT 1";

        $result3 = mysqli_query($link, $query3);

        $row3 = mysqli_fetch_assoc($result3);


        $code_title = $row2['title'];

        if($row2['status'] == 0){

            $code_status = "Completed";

        }

        elseif($row2['status'] == -1){

            $code_status = "Deleted";
        }

        else{

            $code_status = "In progress (".$row2['status'].")";
        }

        $code_description = $row2['description'];

        $code_category = $row3['name'];


        if($row1['role'] == 1) {

            $_SESSION['menu'] = '

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="summary.php">Summary</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="seatpaper.php">Seat Paper</a>
                    </li>
                    
                    <li class="nav-item active">
                        <a class="nav-link" href="random.php">Random CODE</a>
                    </li>
                    
                    <li class="nav-item active">
                        <a class="nav-link" href="user-list.php">Member</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="setting.php">Setting</a>
                    </li>

                </ul>

                <form class="form-inline" method="get">
              <button class="btn btn-outline-dark" type="submit" name="action" value="logout" id="logout-button">Logout</button>
            </form>

            </div>
            ';

            $_SESSION['footer'] = '<nav class="navbar fixed-bottom navbar-light bg-light"><span class="mx-auto">Hi! '.$row1['nickname']. ' [Status: Admin]</span></nav>';



        } elseif($row1['role'] == 2) {

            $_SESSION['menu'] = '

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    
                    <li class="nav-item active">
                        <a class="nav-link" href="user-list.php">Member</a>
                    </li>
                    
                    <li class="nav-item active">
                        <a class="nav-link" href="setting.php">Setting</a>
                    </li>

                </ul>

                <form class="form-inline" method="get">
                    <button class="btn btn-outline-dark" type="submit" id="logout-button" name="action" value="logout">Logout</button>
                </form>

            </div>
            ';

            $_SESSION['footer'] = '<nav class="navbar fixed-bottom navbar-light bg-light"><span class="mx-auto">Hi! '.$row1['nickname']. ' [Status: Editor]</span></nav>';


        }
        else{
            $_SESSION['menu'] = "";
            header("Location: index.php");

        }

    }

    elseif(($_COOKIE['id'] == -1 or $_COOKIE['id'] == '') and basename($_SERVER['PHP_SELF']) != 'index.php' and basename($_SERVER['PHP_SELF']) != 'signup.php') {
        $_SESSION['menu'] = "";
        header("Location: index.php");

    }

// Condition Check

    if($_SESSION['success_signup'] == true){


        $temp_alert = '

            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Sign up success!
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>

        ';

        $_SESSION['success_signup'] = false;

        setcookie("alert_sign", $temp_alert, time() + (10), "/");

        header("Location: index.php");

    }


// Category Dropdown


    $query_cat = "SELECT * FROM category";

    $result_cat = mysqli_query($link, $query_cat);

    $row_cat = mysqli_fetch_all($result_cat);

    for( $i = 0 ; $i < mysqli_num_rows($result_cat) ; $i++ ){


        $category_option .= '<option value="'.$row_cat[$i][0].'">'.$row_cat[$i][1].'</option>';


    }

    if($_COOKIE['id'] != -1 and $_POST['action'] == "edit-code" and $_POST['id'] != ""){

        $pre_selected = array();



        for( $j = 0 ; $j < mysqli_num_rows($result_cat) ; $j++ ){

            if($row_cat[$j][1] == $code_category){

                $pre_selected[$j] = ' selected';

            }else{
                $pre_selected[$j] = '';
            }

            $category_option2 .= '<option value="'.$row_cat[$j][0].'"'.$pre_selected[$j].'>'.$row_cat[$j][1].'</option>';


        }

    }


?>
