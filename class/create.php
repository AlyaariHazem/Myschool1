<div id="addstudent" class="modal">
    <form class="modal-content animate create_form" action="" method="POST" style="width:70%;background-color:rgb(231 231 231 / 96%);">
        <div class="imgcontainer">
            <span onclick="document.getElementById('addstudent').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="container">
            <div class="s_number">
                <label class="col-sm-6 col-form-label s_num">رقم الفصل</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control s_num_input" name="class_id" value="<?php echo $class_id;?>">
                </div>
            </div>
            <div class=" s_name">
                <label class="col-sm-6 col-form-label s_nam">اسم الفصل</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control s_nam_input" name="class_name" value="<?php echo $class_name;?>">
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
                $sql1="select * from teacher";
                $result=$connection->query($sql1);
                echo '<div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" style="position:relative;top:-118px; margin-right:59%;" id="teacherDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                             رئيس الفصل
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="teacherDropdown">';
                //read data of each row
                while($row1=$result->fetch_assoc()){
                    $teacher_id=$row1['teacher_id'];
                    $teacher_name=$row1['teacher_name'];
                    echo '<li><a class="dropdown-item" href="#teacherIdInput" onclick="selectTeacher('.$teacher_id.', \''.$teacher_name.'\')">'.$teacher_name.'</a></li>';
                }
                echo '</ul></div>';
            ?>
            <div class=" s_age">
                <label class="col-sm-6 col-form-label s_ag">السنة الدراسية</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control s_ag_input" style="margin-bottom:4rem;" name="study_year" value="<?php echo $study_year;?>">
                </div>
            </div>
            <input type="hidden" name="teacher_id" id="teacherIdInput">
            <div class="row mb-3">
                <div class="offset-sm-1">
                    <button type="submit" class="btn btn-primary create_submit" name="send">إضـــافــة</button>
                </div>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-danger btns" role="button" href="manageClass.php?id=$class_id">إلـغــاء</a>
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