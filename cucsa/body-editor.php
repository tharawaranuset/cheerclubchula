<?php

    include("functions.php");

    $query6 = "SELECT * FROM draft WHERE id_code = '". $_POST['id']."'";

    $result6 = mysqli_query($link, $query6);

    $row6 = mysqli_fetch_all($result6);

    $query7 = "SELECT * FROM code WHERE id = '". $_POST['id'] ."' LIMIT 1";

    $result7 = mysqli_query($link, $query7);

    $row7 = mysqli_fetch_assoc($result7);

    $query_owner = "SELECT * FROM user WHERE id = '". $row7['id_owner'] ."' LIMIT 1";

    $result_owner = mysqli_query($link, $query_owner);

    $row_owner = mysqli_fetch_assoc($result_owner);

    $code_owner = $row_owner['nickname'];

    if($row7['status'] <= 0){

        $menu_status = '

            <a href="#" role="button" class="badge badge-pill badge-info ml-1 py-auto text-white" data-toggle="modal" data-target="#recover">
               <i class="material-icons md-18 md-light" data-toggle="tooltip" data-placement="top" title="Recover">history</i>
            </a>
        ';

    }
    else{

        $menu_status = '

            <a href="#" role="button" class="badge badge-pill badge-success ml-1 py-auto text-white" data-toggle="modal" data-target="#add-draft">
               <i class="material-icons md-18 md-light" data-toggle="tooltip" data-placement="top" title="Add draft">add_photo_alternate</i>
            </a>

            <a href="#" role="button" class="badge badge-pill badge-danger ml-1 py-auto text-white" data-toggle="modal" data-target="#delete">
                <i class="material-icons md-18 md-light" data-toggle="tooltip" data-placement="top" title="Delete code">delete_forever</i>
            </a>

        ';
    }

    if($_SESSION['status']=='edit-success'){

        $_SESSION['alert_edit'] = '

            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Edit completed!
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>

        ';

        $_SESSION['status']='';

    }
    elseif($_SESSION['status']=='delete-success'){

        $_SESSION['alert_edit'] = '

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              Your code is deleted!
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>

        ';

        $_SESSION['status']='';

    }
    elseif($_SESSION['status']=='non-bmp'){

        $_SESSION['alert_edit'] = '

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              Incorrect file type (.bmp only) / Incorrect dimension / Incorrect index color
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>

        ';

         $_SESSION['status']='';

    }
    elseif($_SESSION['status']=='draft-success'){

        $_SESSION['alert_edit'] = '

            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Your draft/openshut has been added!
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>

        ';

         $_SESSION['status']='';

    }

    elseif($_SESSION['status']=='del-cmt-success'){

        $_SESSION['alert_edit'] = '

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              Your comment has been deleted!
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>

        ';

         $_SESSION['status']='';

    }

    elseif($_SESSION['status']=='review-success'){

        $_SESSION['alert_edit'] = '

            <div class="alert alert-success alert-dismissible fade show" role="alert">
              This draft has been reviewed.
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>

        ';

         $_SESSION['status']='';

    }
    elseif($_SESSION['status']=='primary-success'){

        $_SESSION['alert_edit'] = '

            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Your selected draft has been made as primary :)
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>

        ';

         $_SESSION['status']='';


    }

	elseif($_SESSION['status']=='primary-success-2'){

        $_SESSION['alert_edit'] = '

            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
              Your selected draft has been canceled as primary :(
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>

        ';

         $_SESSION['status']='';


    }

    elseif($_SESSION['status']=='recover-success'){
        
        $_POST['action'] = '';

        $_SESSION['alert_edit'] = '

            <div class="alert alert-info alert-dismissible fade show" role="alert">
              Your code has been recovered from Completed/Deleted status.
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>

        ';

         $_SESSION['status']='';

    }

    else{

        $_SESSION['alert_edit'] = '';

    }


    if($_POST['action']=='edit-info'){
        
        $_POST['action'] = '';

        $query1 = "UPDATE `code` SET `title` = '".$_POST['title']."', `category` = '".$_POST['category']."', `description` = '".$_POST['description']."' WHERE id = " . $_POST['id-edit'];

        mysqli_query($link, $query1);

        echo '

            <form method="post" action="editor.php" id="redirect">
                <input type="hidden" name="action" value="edit-code">
                <input type="hidden" name="id" value="'.$_POST['id-edit'].'">
            </form>

            <script type="text/javascript">
                document.getElementById("redirect").submit();
            </script>

        ';

        $_SESSION['status']='edit-success';
    }

    elseif($_POST['action']=='delete'){
        
        $_POST['action'] = '';

        $query2 = "UPDATE `code` SET `status` = '-1' WHERE id = " . $_POST['id-delete'];

        mysqli_query($link, $query2);
            
        $id_delete = mysqli_real_escape_string($link, $_POST['id-delete']);

    	// คำสั่ง SQL สำหรับลบข้อมูล
    	$query_delete = "DELETE FROM `mpc` WHERE `id_primary` = '$id_delete'";
            
        mysqli_query($link, $query_delete);
           

        echo '

            <form method="post" action="editor.php" id="redirect">
                <input type="hidden" name="action" value="edit-code">
                <input type="hidden" name="id" value="'.$_POST['id-delete'].'">
            </form>

            <script type="text/javascript">
                document.getElementById("redirect").submit();
            </script>

        ';

        $_SESSION['status']='delete-success';

    }

    elseif($_POST['action']=='review'){
        
        $_POST['action'] = '';

        $query2 = "INSERT INTO comment (`cmt_mentor`,`id_mentor`,`id_draft`) VALUES ('".mysqli_real_escape_string($link,$_POST['feedback'])."','".$_COOKIE['id']."','".$_POST['id_draft']."')";

        mysqli_query($link, $query2);
        
        $query22 = "UPDATE `draft` SET `last_comment` = '".date("Y-m-d H:i:s")."' WHERE id = '".$_POST['id_draft']."'";

        mysqli_query($link, $query22);

        echo '

            <form method="post" action="editor.php" id="redirect">
                <input type="hidden" name="action" value="edit-code">
                <input type="hidden" name="id" value="'.$_POST['id-review'].'">
            </form>

            <script type="text/javascript">
                document.getElementById("redirect").submit();
            </script>

        ';

        $_SESSION['status']='review-success';

    }

    elseif($_POST['action']=='delete-comment'){
        
        $_POST['action'] = '';

        $query23 = "DELETE FROM comment WHERE id = '".$_POST['id-cmt']."'";

        mysqli_query($link, $query23);

        echo '

            <form method="post" action="editor.php" id="redirect">
                <input type="hidden" name="action" value="edit-code">
                <input type="hidden" name="id" value="'.$_POST['id-cmt-del'].'">
            </form>

            <script type="text/javascript">
                document.getElementById("redirect").submit();
            </script>

        ';

        $_SESSION['status']='del-cmt-success';

    }

    elseif($_POST['action']=='make-primary'){
            
        $id_primary = mysqli_real_escape_string($link, $_POST['id-primary']);
		$n_primary = mysqli_real_escape_string($link, $_POST['n_primary']);
		$user_id = mysqli_real_escape_string($link, $_COOKIE['id']);
        // คำสั่ง SELECT เพื่อค้นหาในตาราง
		$query_find = "
    		SELECT * 
    		FROM `mpc` 
    		WHERE `id_primary` = '$id_primary' 
    		AND `n_primary` = '$n_primary' 
    		AND `user_id` = '$user_id'
		";

		$result_find = mysqli_query($link, $query_find);

		// ตรวจสอบผลลัพธ์
		if (mysqli_num_rows($result_find) > 0) {
    			// ถ้าพบข้อมูล ลบข้อมูลนั้นออก
    			$query_delete = "
        			DELETE FROM `mpc` 
        			WHERE `id_primary` = '$id_primary' 
        			AND `n_primary` = '$n_primary' 
        			AND `user_id` = '$user_id'
    			";    
        			mysqli_query($link, $query_delete);
                echo '

            	<form method="post" action="editor.php" id="redirect">
                	<input type="hidden" name="action" value="edit-code">
                	<input type="hidden" name="id" value="'.$_POST['id-primary'].'">
            	</form>

            	<script type="text/javascript">
                	document.getElementById("redirect").submit();
            	</script>

        		';
                $_SESSION['status']='primary-success-2';
        }
        		
        else{
			// เพิ่มค่าเข้าในตาราง mpc
			$query_insert_mpc = "
    			INSERT INTO `mpc` (`id_primary`, `n_primary`, `user_id`) 
    			VALUES ('$id_primary', '$n_primary', '$user_id')
			";

			mysqli_query($link, $query_insert_mpc);

			// ตรวจสอบจำนวนของ id_primary และ n_primary ที่มีอยู่ในตาราง mpc
			$query_check_count = "
    			SELECT COUNT(*) AS count 
    			FROM `mpc` 
    			WHERE `id_primary` = '$id_primary' 
    			AND `n_primary` = '$n_primary'
			";

			$result_check_count = mysqli_query($link, $query_check_count);
			$row_check_count = mysqli_fetch_assoc($result_check_count);
                        
            
        	if ($row_check_count['count'] >= 3){

        		$query11 = "SELECT * FROM `draft` WHERE `id_code` = '".$_POST['id-primary']."' AND `num_draft` = '".$_POST['n_primary']."' LIMIT 1";

        		$result11 = mysqli_query($link, $query11);

        		$row11 = mysqli_fetch_assoc($result11);

        		$query2 = "UPDATE `code` SET `status` = '0', `filename` = '".$_POST['new-filename']."', `n_primary` = '".$_POST['n_primary']."', `op` = '".$row11['op']."' WHERE id = '". $_POST['id-primary']."'";

        		mysqli_query($link, $query2);
                
                $_SESSION['primary-status']=0;
        	}
        

        	echo '

            <form method="post" action="editor.php" id="redirect">
                <input type="hidden" name="action" value="edit-code">
                <input type="hidden" name="id" value="'.$_POST['id-primary'].'">
            </form>

            <script type="text/javascript">
                document.getElementById("redirect").submit();
            </script>

        	';

        	$_SESSION['status']='primary-success';
        }

    }
    elseif($_POST['action']=='recover'){

        $query2 = "UPDATE `code` SET `status` = '".$_POST['old_status']."', `n_primary` = '0' WHERE id = " . $_POST['id-recover'];

        mysqli_query($link, $query2);
            
        $id_recover = mysqli_real_escape_string($link, $_POST['id-recover']);

    	// คำสั่ง SQL สำหรับลบข้อมูล
    	$query_recover = "DELETE FROM `mpc` WHERE `id_primary` = '$id_recover'";
            
        mysqli_query($link, $query_recover);

        unset($_SESSION['old_status']);

        echo '

            <form method="post" action="editor.php" id="redirect">
                <input type="hidden" name="action" value="edit-code">
                <input type="hidden" name="id" value="'.$_POST['id-recover'].'">
            </form>

            <script type="text/javascript">
                document.getElementById("redirect").submit();
            </script>

        ';

        $_SESSION['status']='recover-success';

    }

    elseif($_POST['action']=='add-draft'){

        $query3 = "SELECT * FROM code WHERE id = '". $_POST['id-draft'] ."' LIMIT 1";

        $result3 = mysqli_query($link, $query3);

        $row3 = mysqli_fetch_assoc($result3);

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


            if($row3['type'] == 1 or $row3['type'] == 2){


                if($width != $stand_w or $height != $stand_h){

                    $ch = true;
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
                            $ch = true;

                        }

                    }
                }

            }


            if($row3['type'] == 3){

                if($width != $stand_w * $plate_w or $height != $stand_h * $plate_h){

                    $ch = true;
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
                            $ch = true;

                        }

                    }
                }


            }

        }

        if($ch == true){

            $_FILES = array();

            $ch = false;

            $_SESSION['status']='non-bmp';

            echo '

                <form method="post" action="editor.php" id="redirect">
                    <input type="hidden" name="action" value="edit-code">
                    <input type="hidden" name="id" value="'.$_POST['id-draft'].'">
                </form>

                <script type="text/javascript">
                    document.getElementById("redirect").submit();
                </script>

            ';
        }

        else{

            $date = new DateTime();

            if($row3['type'] == 1){

                $newfilename = str_pad($_COOKIE['id'], 4, "0", STR_PAD_LEFT).'_'.$date->format('U').'_'.str_pad($row3['status']+1, 2, "0", STR_PAD_LEFT);

                move_uploaded_file($_FILES["fileUpload"]["tmp_name"][0],"code/1-1/".$newfilename.".bmp");
            }

            elseif($row3['type'] == 3){

                $newfilename = str_pad($_COOKIE['id'], 4, "0", STR_PAD_LEFT).'_'.$date->format('U').'_'.str_pad($row3['status']+1, 2, "0", STR_PAD_LEFT);

                move_uploaded_file($_FILES["fileUpload"]["tmp_name"][0],"code/1-25/".$newfilename.".bmp");
            }

            elseif($row3['type'] == 2){

                $n_file = count($_FILES["fileUpload"]["name"]);

                $name_combine = array($n_file);

                for( $i=0 ; $i < $n_file ; $i++ ) {

                    $name_combine[$i] = str_pad($_COOKIE['id'], 4, "0", STR_PAD_LEFT).'_'.$date->format('U').'_'.str_pad($row3['status']+1, 2, "0", STR_PAD_LEFT).'_'.str_pad($i+1, 2, "0", STR_PAD_LEFT);

                }

                for( $j=0 ; $j < $n_file ; $j++ ) {

                    move_uploaded_file($_FILES["fileUpload"]["tmp_name"][$j],"code/1-1-sequence/".$name_combine[$j].".bmp");

                }
                $newfilename = implode(",",$name_combine);
            }


            $query4 = "UPDATE `code` SET `status` = '".($row3['status']+1)."',`filename` = '".$newfilename."' WHERE id = " . $_POST['id-draft'];

            mysqli_query($link, $query4);

            $query5 = "INSERT INTO draft (`id_code`, `num_draft`,`cmt_editor`,`filename`) VALUES ('". $_POST['id-draft']."','".($row3['status']+1)."','".mysqli_real_escape_string($link,$_POST['comment'])."','" . $newfilename. "')";

            mysqli_query($link, $query5);

            echo '

                <form method="post" action="editor.php" id="redirect">
                    <input type="hidden" name="action" value="edit-code">
                    <input type="hidden" name="id" value="'.$_POST['id-draft'].'">
                </form>

                <script type="text/javascript">
                    document.getElementById("redirect").submit();
                </script>

            ';

            $_SESSION['status']='draft-success';


        }

    }


    elseif($_POST['action']=='add-op'){

        $ch = false;


        if(strtolower(pathinfo($_FILES["fileUpload"]["name"][0], PATHINFO_EXTENSION)) != 'bmp'){

           $ch = true;

        }

        list($width, $height) = getimagesize($_FILES["fileUpload"]["tmp_name"][0]);

        $query_dim = "SELECT * FROM dimension WHERE id = '1'";

        $result_dim = mysqli_query($link, $query_dim);

        $row_dim = mysqli_fetch_assoc($result_dim);

        $plate_w = $row_dim['p-width'];
        $plate_h = $row_dim['p-height'];

        $stand_w = $row_dim['s-width'];
        $stand_h = $row_dim['s-height'];

        $im = imagecreatefrombmp($_FILES["fileUpload"]["tmp_name"][0]);
        imagealphablending($im, false);

        if($width != $stand_w or $height != $stand_h){

            $ch = true;
        }

        $query_color = "SELECT * FROM color WHERE type = 'op'";

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
                    $ch = true;

                }

            }
        }

        if($ch == true){

            $_FILES = array();

            $ch = false;

            $_SESSION['status']='non-bmp';

            echo '

                <form method="post" action="editor.php" id="redirect">
                    <input type="hidden" name="action" value="edit-code">
                    <input type="hidden" name="id" value="'.$_POST['id-op'].'">
                </form>

                <script type="text/javascript">
                    document.getElementById("redirect").submit();
                </script>

            ';
        }

        else{

            $query9 = "SELECT * FROM `draft` WHERE id_code = ".$_POST['id-op']." AND num_draft = ".$_POST['n_draft_op'];

            $result9 = mysqli_query($link, $query9);

            $row9 = mysqli_fetch_assoc($result9);

            $newfilename = $row9['filename'].'_OP';

            move_uploaded_file($_FILES["fileUpload"]["tmp_name"][0],"code/1-25/op/".$newfilename.".bmp");

            $query11 = "UPDATE `draft` SET `op` = '".$newfilename."' WHERE id_code = ".$_POST['id-op']." AND num_draft = ".$_POST['n_draft_op'];

            mysqli_query($link, $query11);

            $query12 = "UPDATE `code` SET `op` = '".$newfilename."' WHERE id = ".$_POST['id-op'];

            mysqli_query($link, $query12);

            echo '

                <form method="post" action="editor.php" id="redirect">
                    <input type="hidden" name="action" value="edit-code">
                    <input type="hidden" name="id" value="'.$_POST['id-op'].'">
                </form>

                <script type="text/javascript">
                    document.getElementById("redirect").submit();
                </script>

            ';

            $_SESSION['status']='draft-success';

        }

    }

    if($row7['type'] == 1){

        $old_status = mysqli_num_rows($result6);

        for( $x = mysqli_num_rows($result6)-1 ; $x >=0 ; $x-- ){
            
            $cmt_rows = '';

            $header = '<span class="text-primary">Feedback</span>';
            
            $query_cmt = "SELECT * FROM `comment` WHERE id_draft = ".$row6[$x][0];

            $result_cmt = mysqli_query($link, $query_cmt);

            $row_cmt = mysqli_fetch_all($result_cmt);
            
            
            for( $r = mysqli_num_rows($result_cmt)-1 ; $r >=0 ; $r-- ){
                
                $cmt_del_button = '';
                
                $query_mentor = "SELECT * FROM `user` WHERE id = ".$row_cmt[$r][3].' LIMIT 1';

                $result_mentor = mysqli_query($link, $query_mentor);

                $row_mentor = mysqli_fetch_assoc($result_mentor);
                
                if($_COOKIE['id'] == $row_cmt[$r][3]){
                    
                    $cmt_del_button = '
                    
                        <button type="submit" class="text-right text-danger float-right" style="border:none;background-color:transparent;cursor: pointer;" data-toggle="modal" data-target="#del_cmt_'.$row_cmt[$r][0].'">
                            <i class="material-icons md-14" data-toggle="tooltip" data-placement="top" title="Delete Comment">cancel</i>
                        </button>
                        
                    ';
                    
                    $popup_del_cmt .= '

                        <div class="modal fade" id="del_cmt_'.$row_cmt[$r][0].'" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Delete Comment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              
                              <div class="modal-body">
                                <p>Do you really want to delete this comment?</p>
                              </div>
                              
                              <div class="modal-footer">
                                <form method="post">

                                    <input type="hidden" name="action" value="delete-comment">
                                    <input type="hidden" name="id-cmt" value="'.$row_cmt[$r][0].'">
                                    <input type="hidden" name="id-cmt-del" value="'.$_POST['id'].'">

                                    <button type="submit" class="btn btn-danger">Delete</button>
                                        
                                    </form>
                                    
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    ';
                }
                
                $cmt_rows .= 
                    
                    '<tr><td>                        
                    <strong>'
                    .$row_mentor['nickname']
                    .'</strong>: '
                    .$row_cmt[$r][4]
                    .' <span class="text-muted">['
                    .date_format(date_modify(date_create_from_format("Y-m-d H:i:s",$row_cmt[$r][2]),"+ 7 hours"),"D, d M h:i a")
                    .']</span>'
                    .$cmt_del_button
                    .'</td></tr>
                    ';
                
            }
            
            if(mysqli_num_rows($result_cmt)==0){
                $cmt_rows='';
                $header = '<span class="text-danger">No Feedback</span>';
            }
            
            $cmt_table = '
            
                <div class="table-responsive">

                    <table class="table table-striped my-0 table-hover table-sm">
                    
                      <thead>
                        <tr>

                          <th scope="col">'.$header.'</th>
                          
                        </tr>
                      </thead>
              
                      <tbody>

                        '.$cmt_rows.'

                      </tbody>
                    </table>

                </div>
            
            ';

            $option = '';
            
            $query_editor = "SELECT * FROM `user` WHERE id = ".$_COOKIE['id'].' LIMIT 1';

            $result_editor = mysqli_query($link, $query_editor);

            $row_editor = mysqli_fetch_assoc($result_editor);
                
            // สร้างคำสั่ง SQL
			$query_mpc = "SELECT * 
				FROM mpc 
				WHERE id_primary = ".$row6[$x][2]." 
  				AND n_primary = ".$row6[$x][3]." 
  				AND user_id = ".$_COOKIE['id'];

			// รันคำสั่ง SQL
			$result_mpc = mysqli_query($link, $query_mpc);

            if($row6[$x][3]==$row7['n_primary']){
                $option = '<span class="badge badge-success">Primary</span><br/>';
            }

            if($row7['n_primary'] == 0 and $row7['status'] != -1){
                $option = '

                        <a href="#" role="button" class="badge badge-pill badge-warning" data-toggle="modal" data-target="#review'.$row6[$x][3].'">
                            <i class="material-icons md-14" data-toggle="tooltip" data-placement="top" title="Review">rate_review</i>
                        </a>';
                
                if($row_editor['role']==1){
                         if (mysqli_num_rows($result_mpc) > 0) {
								$option .= '

                        	<a href="#" role="button" class="badge badge-pill badge-secondary text-white" data-toggle="modal" data-target="#make-primary'.$row6[$x][3].'">
                           		<i class="material-icons md-14" data-toggle="tooltip" data-placement="top" title="Make primary">assignment_turned_in</i>
                        	</a>';
                          }
                        else{
                            $option .= '

                        	<a href="#" role="button" class="badge badge-pill badge-success text-white" data-toggle="modal" data-target="#make-primary'.$row6[$x][3].'">
                           		<i class="material-icons md-14" data-toggle="tooltip" data-placement="top" title="Make primary">assignment_turned_in</i>
                        	</a>';
                        }
                                 

                    
                }
                    

            }

            $query8 = "SELECT * FROM user WHERE id = '". $row6[$x][5] ."' LIMIT 1";

            $result8 = mysqli_query($link, $query8);

            $row8 = mysqli_fetch_assoc($result8);
                
            // สร้างคำสั่ง SQL
			$query_primary_vote = "SELECT * 
				FROM mpc 
				WHERE id_primary = ".$row6[$x][2]." 
  				AND n_primary = ".$row6[$x][3];

			// รันคำสั่ง SQL
			$result_primary_vote = mysqli_query($link, $query_primary_vote);

            if(($x-mysqli_num_rows($result6)+1) % 2 == 0){
                $draft_list .= '<div class="row">';
            }

            $draft_list .= '

                <div class="col-lg-6 px-0 my-2">
                  <div class="card mx-2">
                  <img class="card-img-top mx-0" src="code/1-1/'.$row6[$x][5].'.bmp" style="image-rendering: pixelated;">
                  <div class="card-body">
                    <h5 class="card-title">

                        '.$option.'

                    </h5>

                    <p class="card-text">
                        <span class="font-weight-bold">Draft #'.$row6[$x][3].': <br>Primary Vote : '.mysqli_num_rows($result_primary_vote).'</span>'.$row6[$x][4].$cmt_table.'
                    </p>
                    
                    <p class="card-text"><small class="text-muted">Submitted: '.date_format(date_modify(date_create_from_format("Y-m-d H:i:s",$row6[$x][1]),"+ 7 hours"),"D, d M h:i a").'</small></p>
                  </div>
                  </div>
                </div>

            ';

            if(($x-mysqli_num_rows($result6)+1) % 2 != 0 or mysqli_num_rows($result6)==1){
                $draft_list .= '</div>';
            }

            $popup_draft .= '

                <div class="modal fade" id="review'.$row6[$x][3].'" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Review</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                            <form method="post">

                                    <input type="hidden" name="id-review" value="'.$_POST['id'].'">
                                    <input type="hidden" name="n_draft" value="'.$row6[$x][3].'">
                                    <input type="hidden" name="id_draft" value="'.$row6[$x][0].'">
                                    <input type="hidden" name="action" value="review">

                                    <div class="form-group">
                                    
                                        

                                        <label for="feedback" class="mt-2">Comment from mentor</label>
                                        <textarea class="form-control" name="feedback" id="feedback" placeholder="Enter your feedback about this version"></textarea>

                                    </div>

                                    <div class="text-right">
                                        <button type="submit" id="submit-form" class="btn btn-success">Submit</button>
                                    </div>

                            </form>

                      </div>

                    </div>
                  </div>
                </div>

            ';

            $popup_draft .= '

                <div class="modal fade" id="make-primary'.$row6[$x][3].'" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Make primary</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Do you want to make this draft as a primary picture? The status will be changed to "Completed".</p>
                      </div>
                      <div class="modal-footer">
                            <form method="post">
                                <input type="hidden" name="id-primary" value="'.$_POST['id'].'">
                                <input type="hidden" name="action" value="make-primary">
                                <input type="hidden" name="new-filename" value="'.$row6[$x][5].'">
                                <input type="hidden" name="n_primary" value="'.$row6[$x][3].'">
                                <button type="submit" class="btn btn-success">OK</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>
            ';

        }
    }

    elseif($row7['type'] == 2){

        $old_status = mysqli_num_rows($result6);

        for( $x = mysqli_num_rows($result6)-1 ; $x >=0 ; $x-- ){
            
            
            $cmt_rows = '';
            
            $header = '<span class="text-primary">Feedback</span>';
            
            $query_cmt = "SELECT * FROM `comment` WHERE id_draft = ".$row6[$x][0];

            $result_cmt = mysqli_query($link, $query_cmt);

            $row_cmt = mysqli_fetch_all($result_cmt);
            
            
            for( $r = mysqli_num_rows($result_cmt)-1 ; $r >=0 ; $r-- ){
                
                $cmt_del_button = '';
                
                $query_mentor = "SELECT * FROM `user` WHERE id = ".$row_cmt[$r][3].' LIMIT 1';

                $result_mentor = mysqli_query($link, $query_mentor);

                $row_mentor = mysqli_fetch_assoc($result_mentor);
                
                if($_COOKIE['id'] == $row_cmt[$r][3]){
                    $cmt_del_button = '
                    
                        <button type="submit" class="text-right text-danger float-right" style="border:none;background-color:transparent;cursor: pointer;">
                            <i class="material-icons md-14" data-toggle="tooltip" data-placement="top" title="Delete Comment">cancel</i>
                        </button>
                        
                    ';
                }
                
                $cmt_rows .= 
                    
                    '<tr><td>
                    <form method="post">

                        <input type="hidden" name="action" value="delete-comment">
                        <input type="hidden" name="id-cmt" value="'.$row_cmt[$r][0].'">
                        <input type="hidden" name="id-cmt-del" value="'.$_POST['id'].'">
                        
                        <strong>'
                        .$row_mentor['nickname']
                        .'</strong>: '
                        .$row_cmt[$r][4]
                        .' <span class="text-muted">['
                        .date_format(date_modify(date_create_from_format("Y-m-d H:i:s",$row_cmt[$r][2]),"+ 7 hours"),"D, d M h:i a")
                        .']</span>'
                        .$cmt_del_button
                    .'</form>
                    
                    </td></tr>
                    ';
                
            }
            
            if(mysqli_num_rows($result_cmt)==0){
                $cmt_rows='';
                $header = '<span class="text-danger">No Feedback</span>';
            }
            
            $cmt_table = '
            
                <div class="table-responsive">

                    <table class="table table-striped my-0 table-hover table-sm">
                    
                      <thead>
                        <tr>

                          <th scope="col">'.$header.'</th>
                          
                        </tr>
                      </thead>
              
                      <tbody>

                        '.$cmt_rows.'

                      </tbody>
                    </table>

                </div>
            
            ';

            $option = '';
            
            $query_editor = "SELECT * FROM `user` WHERE id = ".$_COOKIE['id'].' LIMIT 1';

            $result_editor = mysqli_query($link, $query_editor);

            $row_editor = mysqli_fetch_assoc($result_editor);
                
            // สร้างคำสั่ง SQL
			$query_mpc = "SELECT * 
				FROM mpc 
				WHERE id_primary = ".$row6[$x][2]." 
  				AND n_primary = ".$row6[$x][3]." 
  				AND user_id = ".$_COOKIE['id'];

			// รันคำสั่ง SQL
			$result_mpc = mysqli_query($link, $query_mpc);

            if($row6[$x][3]==$row7['n_primary']){
                $option = '<span class="badge badge-success">Primary</span><br/>';
            }

            if($row7['n_primary'] == 0){
                $option = '

                        <a href="#" role="button" class="badge badge-pill badge-warning" data-toggle="modal" data-target="#review'.$row6[$x][3].'">
                            <i class="material-icons md-14" data-toggle="tooltip" data-placement="top" title="Review">rate_review</i>
                        </a>';
                        
                if($row_editor['role']==1){
                        
                    if (mysqli_num_rows($result_mpc) > 0) {
                            $option .= '

                        	<a href="#" role="button" class="badge badge-pill badge-secondary text-white" data-toggle="modal" data-target="#make-primary'.$row6[$x][3].'">
                           		<i class="material-icons md-14" data-toggle="tooltip" data-placement="top" title="Make primary">assignment_turned_in</i>
                        	</a>';
                            
					}
                    else{
                        
                    
                    	$option .= '

                        	<a href="#" role="button" class="badge badge-pill badge-success text-white" data-toggle="modal" data-target="#make-primary'.$row6[$x][3].'">
                           		<i class="material-icons md-14" data-toggle="tooltip" data-placement="top" title="Make primary">assignment_turned_in</i>
                        	</a>';
                            
                    }
                    
                }
            }



            $query8 = "SELECT * FROM user WHERE id = '". $row6[$x][5] ."' LIMIT 1";

            $result8 = mysqli_query($link, $query8);

            $row8 = mysqli_fetch_assoc($result8);

            if(($x-mysqli_num_rows($result6)+1) % 2 == 0){
                $draft_list .= '<div class="row">';
            }

            $draft_list .= '

                <div class="col-lg-6 px-0 my-2">
                  <div class="card mx-2">

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">';

            for($y = 0; $y < sizeof(explode(",",$row6[$x][5])); $y++){

                if($y==0){

                    $draft_list .= '<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>';
                }

                else{

                    $draft_list .= '<li data-target="#carouselExampleIndicators" data-slide-to="'.$y.'"></li>';
                }
            }

            $draft_list .='

                      </ol>
                      <div class="carousel-inner">
            ';

            for($z = 0; $z < sizeof(explode(",",$row6[$x][5])); $z++){

                if($z==0){
                    $draft_list .='
                        <div class="carousel-item active">
                          <img class="d-block w-100" src="code/1-1-sequence/'.explode(",",$row6[$x][5])[$z].'.bmp">
                        </div>
                    ';

                }
                else{
                    $draft_list .='

                        <div class="carousel-item">
                          <img class="d-block w-100" src="code/1-1-sequence/'.explode(",",$row6[$x][5])[$z].'.bmp" style="image-rendering: pixelated;">
                        </div>
                    ';
                }
            }
                
            // สร้างคำสั่ง SQL
			$query_primary_vote = "SELECT * 
				FROM mpc 
				WHERE id_primary = ".$row6[$x][2]." 
  				AND n_primary = ".$row6[$x][3];

			// รันคำสั่ง SQL
			$result_primary_vote = mysqli_query($link, $query_primary_vote);

            $draft_list .='

                      </div>

                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>

                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>

                    </div>


                  <div class="card-body">
                    <h5 class="card-title">
                        '.$option.'
                    </h5>

                    <p class="card-text">
                        <span class="font-weight-bold">Draft #'.$row6[$x][3].': <br>Primary Vote : '.mysqli_num_rows($result_primary_vote).'</span>'.$row6[$x][4].$cmt_table.'
                    </p>
                    <p class="card-text"><small class="text-muted">Submitted: '.date_format(date_modify(date_create_from_format("Y-m-d H:i:s",$row6[$x][1]),"+ 7 hours"),"D, d M h:i a").'</small></p>
                  </div>
                  </div>
                </div>

            ';

            if(($x-mysqli_num_rows($result6)+1) % 2 != 0 or mysqli_num_rows($result6)==1){
                $draft_list .= '</div>';
            }

            $popup_draft .= '

                <div class="modal fade" id="review'.$row6[$x][3].'" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Review</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                            <form method="post">

                                    <input type="hidden" name="id-review" value="'.$_POST['id'].'">
                                    <input type="hidden" name="n_draft" value="'.$row6[$x][3].'">
                                    <input type="hidden" name="id_draft" value="'.$row6[$x][0].'">
                                    <input type="hidden" name="action" value="review">

                                    <div class="form-group">
                                    
                                        

                                        <label for="feedback" class="mt-2">Comment from mentor</label>
                                        <textarea class="form-control" name="feedback" id="feedback" placeholder="Enter your feedback about this version"></textarea>

                                    </div>

                                    <div class="text-right">
                                        <button type="submit" id="submit-form" class="btn btn-success">Submit</button>
                                    </div>

                            </form>

                      </div>

                    </div>
                  </div>
                </div>

            ';

            $popup_draft .= '

                <div class="modal fade" id="make-primary'.$row6[$x][3].'" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Make primary</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Do you want to make this draft as a primary picture? The status will be changed to "Completed".</p>
                      </div>
                      <div class="modal-footer">
                            <form method="post">
                                <input type="hidden" name="id-primary" value="'.$_POST['id'].'">
                                <input type="hidden" name="action" value="make-primary">
                                <input type="hidden" name="new-filename" value="'.$row6[$x][5].'">
                                <input type="hidden" name="n_primary" value="'.$row6[$x][3].'">
                                <button type="submit" class="btn btn-success">OK</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>
            ';

        }

    }

    elseif($row7['type'] == 3){

        $old_status = mysqli_num_rows($result6);

        for( $x = mysqli_num_rows($result6)-1 ; $x >=0 ; $x-- ){
            
            $cmt_rows = '';

            $header = '<span class="text-primary">Feedback</span>';
            
            $query_cmt = "SELECT * FROM `comment` WHERE id_draft = ".$row6[$x][0];

            $result_cmt = mysqli_query($link, $query_cmt);

            $row_cmt = mysqli_fetch_all($result_cmt);
            
            
            for( $r = mysqli_num_rows($result_cmt)-1 ; $r >=0 ; $r-- ){
                
                $cmt_del_button = '';
                
                $query_mentor = "SELECT * FROM `user` WHERE id = ".$row_cmt[$r][3].' LIMIT 1';

                $result_mentor = mysqli_query($link, $query_mentor);

                $row_mentor = mysqli_fetch_assoc($result_mentor);
                
                if($_COOKIE['id'] == $row_cmt[$r][3]){
                    
                    $cmt_del_button = '
                    
                        <button type="submit" class="text-right text-danger float-right" style="border:none;background-color:transparent;cursor: pointer;">
                            <i class="material-icons md-14" data-toggle="tooltip" data-placement="top" title="Delete Comment">cancel</i>
                        </button>
                        
                    ';
                }
                
                $cmt_rows .= 
                    
                    '<tr><td>
                    <form method="post">

                        <input type="hidden" name="action" value="delete-comment">
                        <input type="hidden" name="id-cmt" value="'.$row_cmt[$r][0].'">
                        <input type="hidden" name="id-cmt-del" value="'.$_POST['id'].'">
                        
                        <strong>'
                        .$row_mentor['nickname']
                        .'</strong>: '
                        .$row_cmt[$r][4]
                        .' <span class="text-muted">['
                        .date_format(date_modify(date_create_from_format("Y-m-d H:i:s",$row_cmt[$r][2]),"+ 7 hours"),"D, d M h:i a")
                        .']</span>'
                        .$cmt_del_button
                    .'</form>
                    
                    </td></tr>
                    ';
                
            }
            
            if(mysqli_num_rows($result_cmt)==0){
                $cmt_rows='';
                $header = '<span class="text-danger">No Feedback</span>';
            }
            
            $cmt_table = '
            
                <div class="table-responsive">

                    <table class="table table-striped my-0 table-hover table-sm">
                    
                      <thead>
                        <tr>

                          <th scope="col">'.$header.'</th>
                          
                        </tr>
                      </thead>
              
                      <tbody>

                        '.$cmt_rows.'

                      </tbody>
                    </table>

                </div>
            
            ';
            $option = '';
            
            $query_editor = "SELECT * FROM `user` WHERE id = ".$_COOKIE['id'].' LIMIT 1';

            $result_editor = mysqli_query($link, $query_editor);

            $row_editor = mysqli_fetch_assoc($result_editor);
                
            // สร้างคำสั่ง SQL
			$query_mpc = "SELECT * 
      FROM mpc 
      WHERE id_primary = ".$row6[$x][2]." 
        AND n_primary = ".$row6[$x][3]." 
        AND user_id = ".$_COOKIE['id'];

    // รันคำสั่ง SQL
    $result_mpc = mysqli_query($link, $query_mpc);    
            

            if($row6[$x][3]==$row7['n_primary']){
                $option = '<span class="badge badge-success">Primary</span><br/>';
            }

            if($row7['n_primary'] == 0){
                $option = '

                        <a href="#" role="button" class="badge badge-pill badge-warning" data-toggle="modal" data-target="#review'.$row6[$x][3].'">
                            <i class="material-icons md-14" data-toggle="tooltip" data-placement="top" title="Review">rate_review</i>
                        </a>
                        
                        <a href="#" role="button" class="badge badge-pill badge-info text-white" data-toggle="modal" data-target="#add-op'.$row6[$x][3].'">
                           <i class="material-icons md-14" data-toggle="tooltip" data-placement="top" title="Add Open-shut">video_library</i>
                        </a>';
                        
                if($row_editor['role']==1){
                     
                    if (mysqli_num_rows($result_mpc) > 0) {
                            $option .= '

                        <a href="#" role="button" class="badge badge-pill badge-secondary text-white" data-toggle="modal" data-target="#make-primary'.$row6[$x][3].'">
                           <i class="material-icons md-14" data-toggle="tooltip" data-placement="top" title="Make primary">assignment_turned_in</i>
                        </a>';
                    }
                    else{
                    
                    $option .= '

                        <a href="#" role="button" class="badge badge-pill badge-success text-white" data-toggle="modal" data-target="#make-primary'.$row6[$x][3].'">
                           <i class="material-icons md-14" data-toggle="tooltip" data-placement="top" title="Make primary">assignment_turned_in</i>
                        </a>';
                    }
                }
            }


            $query8 = "SELECT * FROM user WHERE id = '". $row6[$x][5] ."' LIMIT 1";

            $result8 = mysqli_query($link, $query8);

            $row8 = mysqli_fetch_assoc($result8);
                
            // สร้างคำสั่ง SQL
			$query_primary_vote = "SELECT * 
				FROM mpc 
				WHERE id_primary = ".$row6[$x][2]." 
  				AND n_primary = ".$row6[$x][3];

			// รันคำสั่ง SQL
			$result_primary_vote = mysqli_query($link, $query_primary_vote);

            if(($x-mysqli_num_rows($result6)+1) % 2 == 0){
                $draft_list .= '<div class="row">';
            }
            $draft_list .= '

                <div class="col-lg-6 px-0 my-2">
                  <div class="card mx-2">
                  <img class="card-img-top mx-0" src="code/1-25/'.$row6[$x][5].'.bmp" style="image-rendering: pixelated;">
                  <div class="card-body">
                    <h5 class="card-title">
                        '.$option.'
                    </h5>

                    <p class="card-text">
                        <span class="font-weight-bold">Draft #'.$row6[$x][3].': <br>Primary Vote : '.mysqli_num_rows($result_primary_vote).'</span>'.$row6[$x][4].$cmt_table.'
                        </p>
                    <p class="card-text"><small class="text-muted">Submitted: '.date_format(date_modify(date_create_from_format("Y-m-d H:i:s",$row6[$x][1]),"+ 7 hours"),"D, d M h:i a").'</small></p>
                  </div>
                  </div>
                </div>

            ';

            if(($x-mysqli_num_rows($result6)+1) % 2 != 0 or mysqli_num_rows($result6)==1){
                $draft_list .= '</div>';
            }

            $popup_draft .= '

                <div class="modal fade" id="review'.$row6[$x][3].'" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Review</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                            <form method="post">

                                    <input type="hidden" name="id-review" value="'.$_POST['id'].'">
                                    <input type="hidden" name="n_draft" value="'.$row6[$x][3].'">
                                    <input type="hidden" name="id_draft" value="'.$row6[$x][0].'">
                                    <input type="hidden" name="action" value="review">

                                    <div class="form-group">
                                    
                                        

                                        <label for="feedback" class="mt-2">Comment from mentor</label>
                                        <textarea class="form-control" name="feedback" id="feedback" placeholder="Enter your feedback about this version"></textarea>

                                    </div>

                                    <div class="text-right">
                                        <button type="submit" id="submit-form" class="btn btn-success">Submit</button>
                                    </div>

                            </form>

                      </div>

                    </div>
                  </div>
                </div>

            ';

            $img_op = '';

            $query10 = "SELECT * FROM `draft` WHERE id_code = ".$_POST['id']." AND num_draft = ".$row6[$x][3];

            $result10 = mysqli_query($link, $query10);

            $row10 = mysqli_fetch_assoc($result10);

            if($row10['filename']!=''){

                $newfilename = $row10['filename'].'_OP';

                $img_op = '<img src="code/1-25/op/'.$newfilename.'.bmp" style="image-rendering: pixelated;" width="450"><div class="row"></div>';

            }



            $popup_draft .= '

                <div class="modal fade" id="add-op'.$row6[$x][3].'" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Open-shut</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                            '.$img_op.'

                            <form method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="id-op" value="'.$_POST['id'].'">
                                    <input type="hidden" name="n_draft_op" value="'.$row6[$x][3].'">
                                    <input type="hidden" name="id_draft" value="'.$row6[$x][0].'">
                                    <input type="hidden" name="action" value="add-op">

                                    <div class="form-group">

                                        <label for="fileUpload">Upload Open-shut File (.bmp only)</label>

                                        <input type="file" class="form-control-file" id="fileUpload" name="fileUpload[]" multiple required>

                                        <small id="fileUploadHelp-op" class="form-text text-muted">Please select only one file</small>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" id="submit-form" class="btn btn-success">Submit</button>
                                    </div>

                            </form>

                      </div>

                    </div>
                  </div>
                </div>

            ';

            $popup_draft .= '

                <div class="modal fade" id="make-primary'.$row6[$x][3].'" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Make primary</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Do you want to make this draft as a primary picture? The status will be changed to "Completed".</p>
                      </div>
                      <div class="modal-footer">
                            <form method="post">
                                <input type="hidden" name="id-primary" value="'.$_POST['id'].'">
                                <input type="hidden" name="action" value="make-primary">
                                <input type="hidden" name="new-filename" value="'.$row6[$x][5].'">
                                <input type="hidden" name="n_primary" value="'.$row6[$x][3].'">
                                <button type="submit" class="btn btn-success">OK</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>
            ';

        }

    }




?>

<div class="container main-container">

    <?php echo $_SESSION['alert_edit']; ?>

    <div class="container mx-2 my-0">

        <div class="row mb-3 py-auto">

            <a class="badge badge-pill badge-secondary text-white py-auto" role="button" href="dashboard.php">
               <i class="material-icons md-18 md-light" data-toggle="tooltip" data-placement="top" title="Back to dashboard">arrow_back</i>
            </a>

            <a href="#" role="button" class="badge badge-pill badge-primary ml-1 py-auto text-white" data-toggle="modal" data-target="#edit-info">
               <i class="material-icons md-18 md-light" data-toggle="tooltip" data-placement="top" title="Edit info">edit</i>
            </a>

            <?php echo $menu_status; ?>

        </div>

        <div class="row">
            <span class="h5">Code #<?php echo $_POST['id']; ?>&nbsp;[By:&nbsp;<?php echo $code_owner; ?>]</span>
        </div>

        <div class="row">
            <span class="font-weight-bold">Title:&nbsp;</span><?php echo $code_title; ?>
        </div>

        <div class="row">
            <span class="font-weight-bold">Category:&nbsp;</span><?php echo $code_category; ?>
        </div>

        <div class="row">
            <span class="font-weight-bold">Description:&nbsp;</span><?php echo $code_description; ?>
        </div>

        <div class="row">
            <span class="font-weight-bold">Status:&nbsp;</span><?php echo $code_status; ?>
        </div>
    </div>



    <div class="container mt-3 mb-5">

        <?php echo $draft_list; ?>

    </div>

	<div class="modal fade" id="edit-info" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Edit Info</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" method="post">

                <form method="post">

                    <input type="hidden" name="id-edit" value="<?php echo $_POST['id']; ?>">

                    <input type="hidden" name="action" value="edit-info">


                    <div class="form-group">

                        <label for="title">Title</label>

                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $code_title; ?>" required>
                        <small id="titleHelp" class="form-text text-muted">Must represent pronunciation/visual of a code [for 1:1] e.g. ตลาดล่าง</small>

                    </div>

                    <div class="form-group">

                        <label for="category">Category (for 1:1 only)</label>
                        <select class="form-control" id="category" name="category" required>

                            <?php echo $category_option2; ?>

                        </select>

                    </div>

                    <div class="form-group">

                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description"><?php echo $code_description; ?></textarea>

                    </div>

                    <div class="text-right">
                        <button type="submit" id="submit-form" class="btn btn-success">Save</button>
                    </div>

                </form>

	      </div>

	    </div>
	  </div>
	</div>

	<div class="modal fade" id="add-draft" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add draft (max: 99)</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">

                <form method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id-draft" value="<?php echo $_POST['id']; ?>">
                        <input type="hidden" name="action" value="add-draft">

						<div class="form-group">
							<label for="fileUpload">Upload File (.bmp only)</label>
							<input type="file" class="form-control-file" id="fileUpload" name="fileUpload[]" multiple required>
                            <small id="fileUploadHelp" class="form-text text-muted">You can select multiple files for 1:1 sequence type (press Ctrl and select SEQUENTIALLY RENAMED files, up to 99 shots). Please select only one file for 1:1 and 1:25 type!</small>
						</div>

                        <div class="form-group">

                            <label for="comment">Comment</label>
                            <textarea class="form-control" name="comment" id="comment" placeholder="Enter your comment about this version"></textarea>

				        </div>

						<div class="text-right">
							<button type="submit" id="submit-form" class="btn btn-success">Submit</button>
						</div>

                </form>

	      </div>

	    </div>
	  </div>
	</div>

    <?php echo $popup_draft; echo $popup_del_cmt; ?>

    <div class="modal fade" id="delete" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Code</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Do you really want to delete this code?</p>
          </div>
          <div class="modal-footer">
                <form method="post">
                    <input type="hidden" name="id-delete" value="<?php echo $_POST['id']; ?>">
                    <input type="hidden" name="action" value="delete">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="recover" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Recover Code</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Do you want to recover this code from status "Deleted/Completed"?</p>
          </div>
          <div class="modal-footer">
                <form method="post">
                    <input type="hidden" name="id-recover" value="<?php echo $_POST['id']; ?>">
                     <input type="hidden" name="old_status" value="<?php echo $old_status; ?>">
                    <input type="hidden" name="action" value="recover">
                    <button type="submit" class="btn btn-info">Sure!</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

</div>
