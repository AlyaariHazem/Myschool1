<div id="add" class="modal">
    <form class="modal-content animate create_form" action="" method="GET" style="width:70%;background-color:rgb(222, 217, 237);">
     <div class="imgcontainer">
      <span onclick="document.getElementById('add').style.display='none'" class="close" title="Close Modal">&times;</span>
     </div>

     <div class="container">
     <div class="row mb-3">
            <label class="col-sm-6 col-form-label">الاسم الطالب</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
            </div>
        </div>
        <?php 
                $servername='localhost';
                $username='root';
                $password='';
                $database='myschool';
                //create connection
                $connection=new mysqli($servername,$username,$password,$database);
                if($connection->connect_error){
                    die("connection failed: ".$connection->connect_error);
                }
                $sql1="select * from subject";
                $result=$connection->query($sql1);
                echo '<div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" style="position:relative;top:-8vh; left:-83%;" id="teacherDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                              اسم المادة
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="teacherDropdown">';
                //read data of each row
                while($row1=$result->fetch_assoc()){
                    $subject_id=$row1['subject_id'];
                    $subject_name=$row1['subject_name'];
                    echo '<li><a class="dropdown-item" href="#teacherIdInput" onclick="selectTeacher('.$subject_id.', \''.$subject_name.'\')">'.$subject_name.'</a></li>';
                }
                echo '</ul></div>';
            ?>
            
        <div class="row mb-3">
            <label class="col-sm-6 col-form-label">الـدرجــة</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="degree" value="<?php echo $degree;?>">
            </div>
            <input type="hidden" name="subject_name" id="teacherIdInput">
        </div>
        <div class="row mb-3">
            <label class="col-sm-6 col-form-label">التـقـدير</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="appreciation" value="<?php echo $appreciation;?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-6 col-form-label">التــرتــيـب</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="OrderLevel" value="<?php echo $OrderLevel;?>">
            </div>
        </div>

        <div class="row mb-3">
         <div class="offset-sm-1">
            <button type="submit" class="btn btn-primary create_submit " name="send">إضـــافــة</button>
         </div>
        </div>

        <div class="col-sm-3 d-grid">
          <a class="btn btn-danger btns " role="bottun" href="students.php">إلـغــاء</a>
        </div>
      </div>
     </form>
  </div>

  <script>
    function selectTeacher(teacherId, teacherName) {
        document.getElementById('teacherDropdown').innerHTML = teacherName;
        document.getElementById('teacherIdInput').value = teacherId;
    }
</script>