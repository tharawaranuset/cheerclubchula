<?php

    include("actions.php");

	$query1 = "SELECT * FROM user WHERE id = '". $_COOKIE['id'] ."' LIMIT 1";

        $result1 = mysqli_query($link, $query1);

        $row1 = mysqli_fetch_assoc($result1);

    if($row1['role']!=1){
      header("Location: index.php");
    }

    include("views/header.php");

	

    if($_SESSION['swap_status']=='fail'){
        
        $alert_swap = '

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              Swap fail! Incorrect code ID or Incomplete set of new desired position.
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>

        ';
        
        setcookie("alert_swap", $alert_swap, time() + (10), "/");
        
        $_SESSION['swap_status']=''; 
        
        header("Location: summary.php");
        
    }

    elseif($_SESSION['swap_status']=='success'){
        
        $alert_swap = '

            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Successfully swap! Your code is sorted as per new desired position.
              <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
            </div>

        ';
        
        setcookie("alert_swap", $alert_swap, time() + (10), "/");
        
        $_SESSION['swap_status']=''; 
        
        header("Location: summary.php");
        
    }

    if($_POST['action']=='swap11'){
		if($_POST['new_sequence_11']!=''){
                // รับข้อมูลลำดับใหม่จากฟอร์ม
                $newSequence = $_POST['new_sequence_11'];  // ลำดับใหม่ที่ส่งมาจากฟอร์ม
                $newSequenceArray = explode(',', $newSequence);  // แปลงจาก string เป็น array

                // อัปเดตลำดับใหม่ในฐานข้อมูล
                for ($i = 0; $i < sizeof($newSequenceArray); $i++) {
                    $id = $newSequenceArray[$i];
                    $query_update = "UPDATE code SET sequence = " . $i . " WHERE id = " . $id;
                    mysqli_query($link, $query_update);
                }
		}
        // กำหนดสถานะว่าอัปเดตสำเร็จ
        $_SESSION['swap_status'] = 'success';
        header("Location: summary.php");  // รีไดเรกต์ไปหน้าอื่น
        
    }

    elseif($_POST['action']=='swap11seq'){
        if($_POST['new_sequence_11seq']!=''){
                // รับข้อมูลลำดับใหม่จากฟอร์ม
                $newSequence = $_POST['new_sequence_11seq'];  // ลำดับใหม่ที่ส่งมาจากฟอร์ม
                $newSequenceArray = explode(',', $newSequence);  // แปลงจาก string เป็น array

                // อัปเดตลำดับใหม่ในฐานข้อมูล
                for ($i = 0; $i < sizeof($newSequenceArray); $i++) {
                    $id = $newSequenceArray[$i];
                    $query_update = "UPDATE code SET sequence = " . $i . " WHERE id = " . $id;
                    mysqli_query($link, $query_update);
                }
		}
        // กำหนดสถานะว่าอัปเดตสำเร็จ
        $_SESSION['swap_status'] = 'success';
        header("Location: summary.php");  // รีไดเรกต์ไปหน้าอื่น
        
    }

    elseif($_POST['action']=='swap125'){
         
        if($_POST['new_sequence_125']!=''){
                // รับข้อมูลลำดับใหม่จากฟอร์ม
                $newSequence = $_POST['new_sequence_125'];  // ลำดับใหม่ที่ส่งมาจากฟอร์ม
                $newSequenceArray = explode(',', $newSequence);  // แปลงจาก string เป็น array

                // อัปเดตลำดับใหม่ในฐานข้อมูล
                for ($i = 0; $i < sizeof($newSequenceArray); $i++) {
                    $id = $newSequenceArray[$i];
                    $query_update = "UPDATE code SET sequence = " . $i . " WHERE id = " . $id;
                    mysqli_query($link, $query_update);
                }
        
		}
        // กำหนดสถานะว่าอัปเดตสำเร็จ
        $_SESSION['swap_status'] = 'success';
            
        header("Location: summary.php");  // รีไดเรกต์ไปหน้าอื่น
        
    }



    $row_char = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ');

    $query1 = "SELECT * FROM code WHERE type = '1' AND status = '0' ORDER BY category, sequence";

    $result1 = mysqli_query($link, $query1);

    $row1 = mysqli_fetch_all($result1);

    $code11 = '';

	$currentCategory = ''; // เก็บ category ปัจจุบัน

    for($i = 0; $i < mysqli_num_rows($result1); $i++){
        
        $query_cat = "SELECT * FROM category WHERE id = ".$row1[$i][6];

        $result_cat = mysqli_query($link, $query_cat);

        $row_cat = mysqli_fetch_assoc($result_cat);
            
		// ตรวจสอบว่า category เปลี่ยนแปลงหรือไม่
        if ($currentCategory !== $row_cat['name']) {

              // ตั้งค่า category ใหม่ และเริ่มต้น row ใหม่
              $currentCategory = $row_cat['name'];

              $code11 .= '<small class="text-muted my-0 py-0" style="width: 100%; font-weight: bold;">' . $currentCategory . '</small>';
         }

        $code11 .= '
       
          <div class="col-sm-4 col-xs-4 col-4 col-xl-2 col-lg-2 col-md-3 mx-0 px-1 my-1 py-0 draggable-item-11" draggable="true" data-id='.$row1[$i][0].'>
          
            <span>'.str_pad($i+1, 3, "0", STR_PAD_LEFT).' (ID: '.$row1[$i][0].')</span>
          
            <form method="post" action="/cucsa/editor.php">
                <input type="hidden" name="action" value="edit-code">
                <input type="hidden" name="id" value="'.$row1[$i][0].'">
                <input class="my-0 py-0" type="image" name="submit" border="0" alt="Submit" src="code/1-1/'.$row1[$i][8].'.bmp" style="image-rendering: pixelated; width: 100%;">
                <!--<small class="form-text text-muted my-0 py-0">'.$row_cat['name'].'</small>-->
            </form>
          

          </div>

        ';
        
    }

    $query2 = "SELECT * FROM code WHERE type = '2' AND status = '0' ORDER BY sequence";

    $result2 = mysqli_query($link, $query2);

    $row2 = mysqli_fetch_all($result2);

    $code11seq = '';

    for($i = 0; $i < mysqli_num_rows($result2); $i++){
        
        $file_11seq = explode(",",$row2[$i][8]);
        
        $code11seq .= '
        
        <div class="draggable-item-11seq" draggable="true" data-id='.$row2[$i][0].'>
        
        <form method="post" action="/cucsa/editor.php">
            <input type="hidden" name="action" value="edit-code">
            <input type="hidden" name="id" value="'.$row2[$i][0].'">
            <div class="row mx-1 mt-2 h5">Sequence '.$row_char[$i].' (ID: '.$row2[$i][0].') &nbsp;<button type="submit" name="id" value="'.$row2[$i][0].'" class="btn btn-info btn-sm my-0 py-0" id="edit-button">Edit</button></div>

        
        </form>
        
        <div class="row mx-1">
        
        
        ';
        
        for($j = 0; $j < sizeof($file_11seq); $j++){

            $code11seq .= '

              <div class="col-sm-4 col-xs-4 col-4 col-xl-2 col-lg-2 col-md-3 mx-0 px-1 my-1 py-0">

                <span>'.str_pad($j+1, 2, "0", STR_PAD_LEFT).'</span>

                <img src="code/1-1-sequence/'.$file_11seq[$j].'.bmp" style="image-rendering: pixelated; width:100%">

              </div>

            ';
            
        }
        
        $code11seq .= '</div></div>';
    }

    $query3 = "SELECT * FROM code WHERE type = '3' AND status = '0' ORDER BY sequence";

    $result3 = mysqli_query($link, $query3);

    $row3 = mysqli_fetch_all($result3);

    $code125 = '';

    for($i = 0; $i < mysqli_num_rows($result3); $i++){
        

        $code125 .= '
       
          <div class="col-xl-6 col-lg-6 mx-0 px-1 my-1 py-0 draggable-item-125" draggable="true" data-id='.$row3[$i][0].'>
          
            <span>'.str_pad($i+1, 2, "0", STR_PAD_LEFT).' (ID: '.$row3[$i][0].')</span>
            
            <form method="post" action="/cucsa/editor.php">
                <input type="hidden" name="action" value="edit-code">
                <input type="hidden" name="id" value="'.$row3[$i][0].'">
                <input type="image" name="submit" border="0" alt="Submit" src="code/1-25/'.$row3[$i][8].'.bmp" style="image-rendering: pixelated; width: 100%;">
            </form>
            
            
          </div>

        ';
        
    }

?>

<div class="container main-container">
    
    <?php echo $_COOKIE['alert_swap'];?>
    
    <div class="row mx-1 mx-0 px-1 my-1 py-0">
        <span class="h4">CODE 1:1 &nbsp;</span>
            
        <a href="#" role="button" data-toggle="modal" data-target="#swap11">
           <i class="material-icons md-20" data-toggle="tooltip" data-placement="top" title="Swap position">swap_horiz</i>
        </a>

    </div>
    
    <div class="row mx-1" id="draggable-container-11">

        <?php echo $code11; ?>
    
    </div>
    <hr>
    
    <div class="row mx-1 mx-0 px-1 my-1 py-0">
        <span class="h4">CODE 1:1 Sequence &nbsp;</span>
            
        <a href="#" role="button" data-toggle="modal" data-target="#swap11seq">
           <i class="material-icons md-20" data-toggle="tooltip" data-placement="top" title="Swap position">swap_horiz</i>
        </a>

    </div>
    
    <div class="mx-1" id="draggable-container-11seq">
        
    	<?php echo $code11seq; ?>
            
    </div>
    <hr>
    <div class="row mx-1 mx-0 px-1 my-1 py-0">
        <span class="h4">CODE 1:25 &nbsp;</span>
            
        <a href="#" role="button" data-toggle="modal" data-target="#swap125">
           <i class="material-icons md-20" data-toggle="tooltip" data-placement="top" title="Swap position">swap_horiz</i>
        </a>

    </div>
    
    <div class="row mx-1 " id="draggable-container-125">

       <?php echo $code125; ?>
        
        
    </div>
    <br><br><br>
    <a href="summary-print.php" class="button">Go to Summary Print</a>
    <div style="height: 70px;"></div>
    

</div>

<div class="modal fade" id="swap11" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Swap position</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" method="post">

        <form method="post" id="swap-form">

            <input type="hidden" name="action" value="swap11">
			<input type="hidden" name="new_sequence_11" id="new_sequence_11" value="">
                
            <div class="text-right">
                <button type="submit" id="submit-form" class="btn btn-success">Submit</button>
            </div>

        </form>

      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="swap11seq" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Swap position</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" method="post">

        <form method="post">

            <input type="hidden" name="action" value="swap11seq">
            <input type="hidden" name="new_sequence_11seq" id="new_sequence_11seq" value="">

            <div class="text-right">
                <button type="submit" id="submit-form" class="btn btn-success">Submit</button>
            </div>

        </form>

      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="swap125" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Swap position</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" method="post">

        <form method="post">

            <input type="hidden" name="action" value="swap125">
            <input type="hidden" name="new_sequence_125" id="new_sequence_125" value="">

            <div class="text-right">
                <button type="submit" id="submit-form" class="btn btn-success">Submit</button>
            </div>

        </form>

      </div>

    </div>
  </div>
</div>
<script>
	document.addEventListener("DOMContentLoaded", () => {
        
		initializeDragAndDrop("draggable-container-11", "draggable-item-11" ,"new_sequence_11");
        initializeDragAndDrop("draggable-container-11seq", "draggable-item-11seq" ,"new_sequence_11seq");
        initializeDragAndDrop("draggable-container-125", "draggable-item-125","new_sequence_125");
        
        function initializeDragAndDrop(containerId, itemClass,inputId) {
            const container = document.getElementById(containerId);
            const items = container.querySelectorAll(`.${itemClass}`);

            let draggedItem = null;

            items.forEach(item => {
                // เมื่อเริ่มลาก
                item.addEventListener("dragstart", (e) => {
                    draggedItem = item;
                    setTimeout(() => item.style.visibility = "hidden", 0); // ซ่อนตัวที่ลาก
                });

                // เมื่อเลิกลาก
                item.addEventListener("dragend", () => {
                    setTimeout(() => {
                        draggedItem.style.visibility = "visible";
                        draggedItem = null;
                    }, 0);
                });

                // อนุญาตให้วางบน item อื่น
                item.addEventListener("dragover", (e) => e.preventDefault());

                // เมื่อวาง item ลง
                item.addEventListener("drop", (e) => {
                    e.preventDefault();
                    if (draggedItem && draggedItem !== item) {
                        const allItems = Array.from(container.children);
                        const draggedIndex = allItems.indexOf(draggedItem);
                        const targetIndex = allItems.indexOf(item);

                        // จัดเรียงใหม่ใน container
                        if (draggedIndex < targetIndex) {
                            container.insertBefore(draggedItem, item.nextSibling);
                        } else {
                            container.insertBefore(draggedItem, item);
                        }
                        updateSequence(container, inputId);
                    }
                });
            });
               
         }

            // ฟังก์ชันอัปเดต sequence
            function updateSequence(container, inputId) {
                const sequence = Array.from(container.children)
                    .map(item => item.dataset.id); // ดึง ID ของแต่ละรายการในลำดับที่ใหม่
                document.getElementById(inputId).value = sequence.join(','); // อัปเดตค่าใน hidden input
            }
	});
</script>

<?php

    include("views/footer.php");

?>

