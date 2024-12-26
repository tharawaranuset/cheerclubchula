<?php

    include("actions.php");

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
        
        $seq11 = explode("/",$_POST['seq11']);
        
        $error = false;
        
        for($i = 0; $i < sizeof($seq11); $i++){
            
            $query_check = "SELECT * FROM code WHERE id = ".$seq11[$i]." LIMIT 1";
            
            $result_check = mysqli_query($link, $query_check);
            
            $row_check = mysqli_fetch_assoc($result_check);
            
            if($row_check['type'] != 1){
                
                $error = true;
                
            }
            
        }
        
        $query_check2 = "SELECT * FROM code WHERE type = 1 AND status = 0";

        $result_check2 = mysqli_query($link, $query_check2);

        if(mysqli_num_rows($result_check2) != sizeof($seq11)){
            
            $error = true;
            
        }
        
        if($error){
            
            $_SESSION['swap_status'] = 'fail';
            header("Location: summary.php");
            
        }
        
        else{
            
            for($i = 0; $i < sizeof($seq11); $i++){

                $query_check = "SELECT * FROM code WHERE id = ".$seq11[$i];

                $query11 = "UPDATE code SET sequence = ".$i." WHERE type = 1 AND status = 0 AND id = ".$seq11[$i];

                mysqli_query($link, $query11);


            }
            
            $_SESSION['swap_status'] = 'success';
            
            header("Location: summary.php");
            
        }
        
    }

    elseif($_POST['action']=='swap11seq'){
        
        $seq11 = explode("/",$_POST['seq11seq']);
        
        $error = false;
        
        for($i = 0; $i < sizeof($seq11); $i++){
            
            $query_check = "SELECT * FROM code WHERE id = ".$seq11[$i]." LIMIT 1";
            
            $result_check = mysqli_query($link, $query_check);
            
            $row_check = mysqli_fetch_assoc($result_check);
            
            if($row_check['type'] != 2){
                
                $error = true;
                
            }
            
        }
        
        $query_check2 = "SELECT * FROM code WHERE type = 2 AND status = 0";

        $result_check2 = mysqli_query($link, $query_check2);

        if(mysqli_num_rows($result_check2) != sizeof($seq11)){
            
            $error = true;
            
        }
        
        if($error){
            
            $_SESSION['swap_status'] = 'fail';
            header("Location: summary.php");
            
        }
        
        else{
            
            for($i = 0; $i < sizeof($seq11); $i++){

                $query_check = "SELECT * FROM code WHERE id = ".$seq11[$i];

                $query11 = "UPDATE code SET sequence = ".$i." WHERE type = 2 AND status = 0 AND id = ".$seq11[$i];

                mysqli_query($link, $query11);


            }
            
            $_SESSION['swap_status'] = 'success';
            
            header("Location: summary.php");
            
        }
        
    }

    elseif($_POST['action']=='swap125'){
        
        $seq11 = explode("/",$_POST['seq125']);
        
        $error = false;
        
        for($i = 0; $i < sizeof($seq11); $i++){
            
            $query_check = "SELECT * FROM code WHERE id = ".$seq11[$i]." LIMIT 1";
            
            $result_check = mysqli_query($link, $query_check);
            
            $row_check = mysqli_fetch_assoc($result_check);
            
            if($row_check['type'] != 3){
                
                $error = true;
                
            }
            
        }
        
        $query_check2 = "SELECT * FROM code WHERE type = 3 AND status = 0";

        $result_check2 = mysqli_query($link, $query_check2);

        if(mysqli_num_rows($result_check2) != sizeof($seq11)){
            
            $error = true;
            
        }
        
        if($error){
            
            $_SESSION['swap_status'] = 'fail';
            header("Location: summary.php");
            
        }
        
        else{
            
            for($i = 0; $i < sizeof($seq11); $i++){

                $query_check = "SELECT * FROM code WHERE id = ".$seq11[$i];

                $query11 = "UPDATE code SET sequence = ".$i." WHERE type = 3 AND status = 0 AND id = ".$seq11[$i];

                mysqli_query($link, $query11);


            }
            
            $_SESSION['swap_status'] = 'success';
            
            header("Location: summary.php");
            
        }
        
    }



    $row_char = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ');

    $query1 = "SELECT * FROM code WHERE type = '1' AND status = '0' ORDER BY category, sequence";

    $result1 = mysqli_query($link, $query1);

    $row1 = mysqli_fetch_all($result1);

    $code11 = '';

    for($i = 0; $i < mysqli_num_rows($result1); $i++){
        
        $query_cat = "SELECT * FROM category WHERE id = ".$row1[$i][6];

        $result_cat = mysqli_query($link, $query_cat);

        $row_cat = mysqli_fetch_assoc($result_cat);

        $code11 .= '
       
          <div class="col-sm-4 col-xs-4 col-4 col-xl-2 col-lg-2 col-md-3 mx-0 px-1 my-1 py-0 drag-item-11" draggable="true" data-id='.$i.'>
          
            <span>'.str_pad($i+1, 3, "0", STR_PAD_LEFT).' (ID: '.$row1[$i][0].')</span>
          
            <form method="post" action="/cucsa/editor.php">
                <input type="hidden" name="action" value="edit-code">
                <input type="hidden" name="id" value="'.$row1[$i][0].'">
                <input class="my-0 py-0" type="image" name="submit" border="0" alt="Submit" src="code/1-1/'.$row1[$i][8].'.bmp" style="image-rendering: pixelated; width: 100%;">
                <small class="form-text text-muted my-0 py-0">'.$row_cat['name'].'</small>
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
        
        <form method="post" action="/cucsa/editor.php">
            <input type="hidden" name="action" value="edit-code">
            <input type="hidden" name="id" value="'.$row2[$i][0].'">
            <div class="row mx-1 mt-2 h5"><button type="submit" name="id" value="'.$row2[$i][0].'" class="btn btn-info btn-sm my-0 py-0" id="edit-button">Edit</button>&nbsp; Sequence '.$row_char[$i].' (ID: '.$row2[$i][0].')</div>

        
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
        
        $code11seq .= '</div>';
    }

    $query3 = "SELECT * FROM code WHERE type = '3' AND status = '0' ORDER BY sequence";

    $result3 = mysqli_query($link, $query3);

    $row3 = mysqli_fetch_all($result3);

    $code125 = '';

    for($i = 0; $i < mysqli_num_rows($result3); $i++){
        

        $code125 .= '
       
          <div class="col-xl-6 col-lg-6 mx-0 px-1 my-1 py-0">
          
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
    
    <div class="row mx-1 drag11">

        <?php echo $code11; ?>
    
    </div>
    
    <div class="row mx-1 mx-0 px-1 my-1 py-0">
        <span class="h4">CODE 1:1 Sequence &nbsp;</span>
            
        <a href="#" role="button" data-toggle="modal" data-target="#swap11seq">
           <i class="material-icons md-20" data-toggle="tooltip" data-placement="top" title="Swap position">swap_horiz</i>
        </a>

    </div>
    
    <?php echo $code11seq; ?>

    
    <div class="row mx-1 mx-0 px-1 my-1 py-0">
        <span class="h4">CODE 1:25 &nbsp;</span>
            
        <a href="#" role="button" data-toggle="modal" data-target="#swap125">
           <i class="material-icons md-20" data-toggle="tooltip" data-placement="top" title="Swap position">swap_horiz</i>
        </a>

    </div>
    
    <div class="row mx-1 ">

       <?php echo $code125; ?>
        
        
    </div>
    
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

        <form method="post">

            <input type="hidden" name="action" value="swap11">

          <div class="form-group">

            <label for="seq11">New desired position</label>
            <textarea rows="6" class="form-control" name="seq11" id="seq11" placeholder="Separate with slash e.g. 13/1/7/109/115 (Must fill in EVERY completed code ID in sequence)"></textarea>

          </div>

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

          <div class="form-group">

            <label for="seq11seq">New desired position</label>
            <textarea rows="6" class="form-control" name="seq11seq" id="seq11seq" placeholder="Separate with slash e.g. 13/1/7/109/115 (Must fill in EVERY completed code ID in sequence)"></textarea>

          </div>

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

          <div class="form-group">

            <label for="seq125">New desired position</label>
            <textarea rows="6" class="form-control" name="seq125" id="seq125" placeholder="Separate with slash e.g. 13/1/7/109/115 (Must fill in EVERY completed code ID in sequence)"></textarea>

          </div>

            <div class="text-right">
                <button type="submit" id="submit-form" class="btn btn-success">Submit</button>
            </div>

        </form>

      </div>

    </div>
  </div>
</div>

<script>
    const container = document.querySelector(".drag11");
    let draggedItem = null;

    // เริ่มลาก
    container.addEventListener("dragstart", (e) => {
        if (e.target.closest('.drag-item-11')) {
            draggedItem = e.target.closest('.drag-item-11');
            draggedItem.classList.add("dragging");
        }
    });

    // จบการลาก
    container.addEventListener("dragend", (e) => {
        if (draggedItem) {
            draggedItem.classList.remove("dragging");
            draggedItem = null;
        }

        // ส่งการอัปเดต sequence ไปยัง PHP
        updateSequence();
    });

    // อนุญาตให้ลากผ่านพื้นที่
    container.addEventListener("dragover", (e) => {
        e.preventDefault(); // จำเป็นเพื่อให้ drop ทำงาน
        const afterElement = getDragAfterElement(container, e.clientX, e.clientY);
        if (afterElement == null) {
            container.appendChild(draggedItem);
        } else {
            container.insertBefore(draggedItem, afterElement);
        }
    });

    // หาองค์ประกอบที่จะวาง โดยพิจารณาตำแหน่งทั้งแนวนอนและแนวตั้ง
    function getDragAfterElement(container, x, y) {
        const draggableElements = [...container.querySelectorAll(".drag-item-11:not(.dragging)")];
        const closest = { offsetX: Number.NEGATIVE_INFINITY, offsetY: Number.NEGATIVE_INFINITY, element: null };

        draggableElements.forEach((child) => {
            const box = child.getBoundingClientRect();
            const offsetX = x - box.left - box.width / 2;
            const offsetY = y - box.top - box.height / 2;

            // เลือกตำแหน่งที่ใกล้ที่สุด
            if (Math.abs(offsetX) < Math.abs(offsetY)) {
                if (offsetY < 0 && offsetY > closest.offsetY) {
                    closest.offsetY = offsetY;
                    closest.element = child;
                }
            } else {
                if (offsetX < 0 && offsetX > closest.offsetX) {
                    closest.offsetX = offsetX;
                    closest.element = child;
                }
            }
        });

        return closest.element;
    }

    // ฟังก์ชั่นส่งการอัปเดตไปยัง PHP
    function updateSequence() {
        const items = [...container.querySelectorAll('.drag-item-11')];
        items.forEach((item, index) => {
            const id = item.getAttribute('data-id'); // หรือใช้วิธีอื่นในการระบุ id
            const new_sequence = index; // สมมุติว่า index คือค่า sequence ใหม่
            console.log(`Sending ID: ${id}, New Sequence: ${new_sequence}`);
            // ส่งข้อมูลไปยัง PHP ผ่าน AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_sequence.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(`id=${id}&new_sequence=${new_sequence}`);
        });
    }
</script>


<?php

    include("views/footer.php");

?>

