<?php

    if($_GET['show_deleted'] == 1){
        
        $show_deleted_button = '<a class="btn btn-secondary btn-sm mb-3" href="dashboard.php">
           Hide Deleted
        </a>';
        
        $status = '';
                
    }
    else{
        
        $show_deleted_button = '<a class="btn btn-secondary btn-sm mb-3" href="dashboard.php?show_deleted=1">
           Show Deleted
        </a>';
        
        $status = ' AND status <> -1';
            
    }

    $query_news = "SELECT * FROM news";

    $result_news = mysqli_query($link, $query_news);
	
	$news_array = [];  // สร้าง array เก็บข้อความข่าวทั้งหมด

    // ดึงข้อมูลจากแต่ละแถวและเก็บลงใน array
    while ($row_news = mysqli_fetch_assoc($result_news)) {
        $news_array[] = $row_news['msg'];  // เก็บข้อความใน array
    }
          

    $tr11 = '';

    $query112 = "SELECT * FROM user WHERE id = '". $_COOKIE['id'] ."' LIMIT 1";

    $result112 = mysqli_query($link, $query112);

    $row112 = mysqli_fetch_assoc($result112);

    if($row112['role']=='1'){
        
        $query111 = "SELECT * FROM code WHERE type = 1".$status;
        
    }
    elseif($row112['role']=='2'){
        
        $query111 = "SELECT * FROM code WHERE id_owner = '". $_COOKIE['id'] ."' AND type = 1".$status;
        
    }



    $result111 = mysqli_query($link, $query111);

    $row111 = mysqli_fetch_all($result111);




    for( $i = mysqli_num_rows($result111)-1 ; $i >= 0 ; $i-- ){
        
        // ดึง id_draft ของ draft อันล่าสุดที่มี id_code ตรงกัน
		$query_draft = "SELECT id FROM draft WHERE id_code = '". $row111[$i][0] ."' ORDER BY id DESC LIMIT 1";  // ใช้ ORDER BY id DESC เพื่อดึง draft ที่มี id สูงสุด (ล่าสุด)
		$result_draft = mysqli_query($link, $query_draft); 
        
        // เช็คว่าเจอ draft อันล่าสุด
		if ($row_draft = mysqli_fetch_assoc($result_draft)) {
    		// ดึงข้อมูลคอมเม้นต์ทั้งหมดที่เกี่ยวข้องกับ id_draft ล่าสุด และ role = 1
    		$query_comments = "SELECT COUNT(*) as comment_count 
                       FROM comment c 
                       INNER JOIN user u ON c.id_mentor = u.id 
                       WHERE c.id_draft = '".$row_draft['id']."' AND u.role = 1";
    		$result_comments = mysqli_query($link, $query_comments);
    
    		// ตรวจสอบผลลัพธ์
    		$row_comments = mysqli_fetch_assoc($result_comments);
        }
            
        $query3 = "SELECT * FROM category WHERE id = '". $row111[$i][6] ."' LIMIT 1";

        $result3 = mysqli_query($link, $query3);

        $row3 = mysqli_fetch_assoc($result3);
        
        if($row111[$i][4] == 0){
            
            $code11_status[$i] = "Completed";
            $code11_color[$i] = ' class = "text-success"';
            
        }
          
        elseif($row111[$i][4] < 0){
            
            $code11_status[$i] = "Deleted";
            $code11_color[$i] = ' class = "text-danger"';
        }
        
        
        else{
            
            $code11_status[$i] = "In progress (".$row111[$i][4].")";
            if ($row_comments['comment_count'] > 0) $code11_color[$i] = ' class = "text-warning"'; // เปลี่ยนสีเป็นเหลือง
            else $code11_color[$i] = '';
        }
        

        
        $tr11 .= '<tr'.$code11_color[$i].'><td>'.$row111[$i][0].'</td>';
        
        $tr11 .= '<td>'.date_format(date_modify(date_create_from_format("Y-m-d H:i:s",$row111[$i][1]),"+ 7 hours"),"d M y h:i a").'</td>';
        
        $query113 = "SELECT * FROM user WHERE id = '". $row111[$i][3] ."' LIMIT 1";

        $result113 = mysqli_query($link, $query113);

        $row113 = mysqli_fetch_assoc($result113);
        
        $tr11 .= '<td>'.$row113['nickname'].'</td>';
        
        $tr11 .= '<td>'.$row111[$i][5].'</td>';
        
        $tr11 .= '<td>'.$row3['name'].'</td>';
        
        $tr11 .= '<td>'.$code11_status[$i].'</td>';
        
        $tr11 .= '
            <td>
                <form method="post" action="/cucsa/editor.php">
                    <input type="hidden" name="action" value="edit-code">
                    <button type="submit" name="id" value="'.$row111[$i][0].'" class="btn btn-info btn-sm my-0 py-0" id="edit-button">
                        Edit
                    </button>
                </form>
            </td>
        ';
        
        $tr11 .= '</tr>';
    }

    $table11 = '
    
        <div class="table-responsive">
        
            <table class="table table-striped my-2 table-hover table-sm">

              <thead>
                <tr>

                  <th scope="col">ID</th>
                  <th scope="col">Last edited</th>
                  <th scope="col">Editor</th>
                  <th scope="col">Title</th>
                  <th scope="col">Category</th>
                  <th scope="col">Status</th>
                  <th scope="col"></th>


                </tr>
              </thead>

              <tbody>

                '.$tr11.'

              </tbody>
            </table>
            
        </div>
    
    ';

    $tr11seq = '';

    $query11seq2 = "SELECT * FROM user WHERE id = '". $_COOKIE['id'] ."' LIMIT 1";

    $result11seq2 = mysqli_query($link, $query11seq2);

    $row11seq2 = mysqli_fetch_assoc($result11seq2);

    if($row11seq2['role']=='1'){
        
        $query11seq1 = "SELECT * FROM code WHERE type = 2".$status;
        
    }
    elseif($row11seq2['role']=='2'){
        
        $query11seq1 = "SELECT * FROM code WHERE id_owner = '". $_COOKIE['id'] ."' AND type = 2".$status;
        
    }

    $result11seq1 = mysqli_query($link, $query11seq1);

    $row11seq1 = mysqli_fetch_all($result11seq1);


    for( $i = mysqli_num_rows($result11seq1)-1 ; $i >= 0 ; $i-- ){
         
        // ตรวจสอบคอมเมนต์ที่ยังไม่ได้อ่าน
    	$query_draft = "SELECT id FROM draft WHERE id_code = '". $row11seq1[$i][0] ."' ORDER BY id DESC LIMIT 1";  // ใช้ ORDER BY เพื่อดึง draft ล่าสุด
    	$result_draft = mysqli_query($link, $query_draft);

    	// เช็คว่ามี draft หรือไม่
    	if ($row_draft = mysqli_fetch_assoc($result_draft)) {
        	// ดึงจำนวนคอมเมนต์ที่ยังไม่ได้อ่าน และ role = 1
    		$query_comments = "SELECT COUNT(*) as unread_count 
                       FROM comment c 
                       INNER JOIN user u ON c.id_mentor = u.id 
                       WHERE c.id_draft = '".$row_draft['id']."' AND u.role = 1";
                
        	$result_comments = mysqli_query($link, $query_comments);
        	$row_comments = mysqli_fetch_assoc($result_comments);
        }
            
        if($row11seq1[$i][4] == 0){
            
            $code11seq_status[$i] = "Completed";
            $code11seq_color[$i] = ' class = "text-success"';
            
            
        }
        
        elseif($row11seq1[$i][4] < 0){
            
            $code11seq_status[$i] = "Deleted";
            $code11seq_color[$i] = ' class = "text-danger"';
        }
        
        else{
            
            $code11seq_status[$i] = "In progress (".$row11seq1[$i][4].")";
            if($row_comments['unread_count'] > 0) $code11seq_color[$i] = ' class="text-warning"';
            else $code11seq_color[$i] = '';
        }
        
        $tr11seq .= '<tr'.$code11seq_color[$i].'><td>'.$row11seq1[$i][0].'</td>';
        
        $tr11seq .= '<td>'.date_format(date_modify(date_create_from_format("Y-m-d H:i:s",$row11seq1[$i][1]),"+ 7 hours"),"Y-m-d H:i:s").'</td>';
        
        $query11seq3 = "SELECT * FROM user WHERE id = '". $row11seq1[$i][3] ."' LIMIT 1";

        $result11seq3 = mysqli_query($link, $query11seq3);

        $row11seq3 = mysqli_fetch_assoc($result11seq3);
        
        $tr11seq .= '<td>'.$row11seq3['nickname'].'</td>';
        
        $tr11seq .= '<td>'.$row11seq1[$i][5].'</td>';
        
        
        $tr11seq .= '<td>'.$code11seq_status[$i].'</td>';
        
        $tr11seq .= '
            <td>
                <form method="post" action="/cucsa/editor.php">
                    <input type="hidden" name="action" value="edit-code">
                    <button type="submit" name="id" value="'.$row11seq1[$i][0].'" class="btn btn-info btn-sm my-0 py-0" id="edit-button">
                        Edit
                    </button>
                </form>
            </td>
        ';
        
        $tr11seq .= '</tr>';
    }

    $table11seq = '
        
        <div class="table-responsive">
        
            <table class="table table-striped my-2 table-hover table-sm">

              <thead>
                <tr>

                  <th scope="col">ID</th>
                  <th scope="col">Last edited</th>
                  <th scope="col">Editor</th>
                  <th scope="col">Title</th>
                  <th scope="col">Status</th>
                  <th scope="col"></th>


                </tr>
              </thead>

              <tbody>

                '.$tr11seq.'

              </tbody>
            </table>
            
        </div>

    ';
    
    $tr125 = '';

    $query1252 = "SELECT * FROM user WHERE id = '". $_COOKIE['id'] ."' LIMIT 1";

    $result1252 = mysqli_query($link, $query1252);

    $row1252 = mysqli_fetch_assoc($result1252);

    if($row1252['role']=='1'){
        
        $query1251 = "SELECT * FROM code WHERE type = 3".$status;
        
    }
    elseif($row1252['role']=='2'){
        
        $query1251 = "SELECT * FROM code WHERE id_owner = '". $_COOKIE['id'] ."' AND type = 3".$status;
        
    }

    $result1251 = mysqli_query($link, $query1251);

    $row1251 = mysqli_fetch_all($result1251);


    for( $i = mysqli_num_rows($result1251)-1 ; $i >= 0 ; $i-- ){
        
        // ดึง id ของ draft ล่าสุดจาก id_code ที่ตรงกัน
    	$query_draft = "SELECT id FROM draft WHERE id_code = '". $row1251[$i][0] ."' ORDER BY id DESC LIMIT 1";  // ใช้ ORDER BY เพื่อดึง draft ล่าสุด
    	$result_draft = mysqli_query($link, $query_draft);

    	// เช็คว่ามี draft หรือไม่
    	if ($row_draft = mysqli_fetch_assoc($result_draft)) {
        	// ดึงจำนวนคอมเมนต์ทั้งหมดที่เกี่ยวข้องกับ id_draft ล่าสุด และ role = 1
    		$query_comments = "SELECT COUNT(*) as unread_count 
                       FROM comment c 
                       INNER JOIN user u ON c.id_mentor = u.id 
                       WHERE c.id_draft = '".$row_draft['id']."' AND u.role = 1";
            
        	$result_comments = mysqli_query($link, $query_comments);
        	$row_comments = mysqli_fetch_assoc($result_comments);
        }
        
        if($row1251[$i][4] == 0){
            
            $code125_status[$i] = "Completed";
            $code125_color[$i] = ' class = "text-success"';
            
        }
        
        elseif($row1251[$i][4] < 0){
            
            $code125_status[$i] = "Deleted";
            $code125_color[$i] = ' class = "text-danger"';
        }
        
        else{
            
            $code125_status[$i] = "In progress (".$row1251[$i][4].")";
            if($row_comments['unread_count'] > 0) $code125_color[$i] = ' class="text-warning"';
            else $code125_color[$i] = '';
        }
        
        $tr125 .= '<tr'.$code125_color[$i].'><td>'.$row1251[$i][0].'</td>';
        
        $tr125 .= '<td>'.date_format(date_modify(date_create_from_format("Y-m-d H:i:s",$row1251[$i][1]),"+ 7 hours"),"Y-m-d H:i:s").'</td>';
        
        $query1253 = "SELECT * FROM user WHERE id = '". $row1251[$i][3] ."' LIMIT 1";

        $result1253 = mysqli_query($link, $query1253);

        $row1253 = mysqli_fetch_assoc($result1253);
        
        $tr125 .= '<td>'.$row1253['nickname'].'</td>';
        
        $tr125 .= '<td>'.$row1251[$i][5].'</td>';
                
        $tr125 .= '<td>'.$code125_status[$i].'</td>';
        
        $tr125 .= '
            <td>
                <form method="post" action="/cucsa/editor.php">
                    <input type="hidden" name="action" value="edit-code">
                    <button type="submit" name="id" value="'.$row1251[$i][0].'" class="btn btn-info btn-sm my-0 py-0" id="edit-button">
                        Edit
                    </button>
                </form>
            </td>
        ';
        
        $tr125 .= '</tr>';
    }

    $table125 = '
        
        <div class="table-responsive">
        
            <table class="table table-striped my-2 table-hover table-sm">

              <thead>
                <tr>

                  <th scope="col">ID</th>
                  <th scope="col">Last edited</th>
                  <th scope="col">Editor</th>
                  <th scope="col">Title</th>
                  <th scope="col">Status</th>
                  <th scope="col"></th>


                </tr>
              </thead>

              <tbody>

                '.$tr125.'

              </tbody>
            </table>
            
        </div>

    ';

?>