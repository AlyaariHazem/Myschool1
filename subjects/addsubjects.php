<div id="addsubject" class="modal">
    <form class="modal-content animate create_form" action="" method="POST" style="width:70%;background-color:rgb(222, 217, 237);height:20rem;">
        <div class="imgcontainer">
            <span onclick="document.getElementById('addsubject').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>

        <div class="container">
            <div class="row mb-3">
                <label class="col-sm-6 col-form-label">اسم المادة</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" required name="name" value="<?php echo $name;?>">
                </div>
            </div>
            <?php 
                include "../include/connection.php";

                $sql1 = "SELECT * FROM class";
                $result = $connection->query($sql1);

                echo '<div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" style="position:relative;top:-8vh; left:-83%;" id="classDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                              الفصل
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="classDropdown">';
                
                while ($row1 = $result->fetch_assoc()) {
                    $class_id = $row1['class_id'];
                    $class_name = $row1['class_name'];
                    echo '<li><a class="dropdown-item" href="#classIdInput" onclick="selectClass('.$class_id.', \''.$class_name.'\')">'.$class_name.'</a></li>';
                }
                
                echo '</ul></div>';
            ?>
            <div class="row mb-3">
                <input type="hidden" name="class_id" id="classIdInput">
            </div>

            <div class="row mb-3">
                <div class="offset-sm-1">
                    <button type="submit" class="btn btn-primary create_submit" name="send">إضـــافــة</button>
                </div>
            </div>

            <div class="col-sm-3 d-grid">
                <a class="btn btn-danger btns" role="button" href="students.php">إلـغــاء</a>
            </div>
        </div>
    </form>
</div>

<script>
    function selectClass(classId, className) {
        document.getElementById('classDropdown').innerHTML = className;
        document.getElementById('classIdInput').value = classId;
    }
</script>

<?php
    include "../include/connection.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])) {
        $name = $_POST['name'];
        $class_id = $_POST['class_id'] ?? '';

        // Check if any data is empty
        if (empty($name) || empty($class_id)) {
            $errorMassage = "يجب أن تملأ جميع الحقول";
        } else {
            // Add the new subject to the database
            $sql = "INSERT INTO subject (subject_name, subject_class_id, subject_teach_id) VALUES ('$name', '$class_id', 2)";
            $result = $connection->query($sql);

            if ($result) {
                $successMassage = "تم إضافة المادة بنجاح";
            } else {
                $errorMassage = "Error: " . $connection->error;
            }
        }
    }
?>