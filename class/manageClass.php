<?php
$class_id = "";
$class_name = "";
$class_teacher_id = "";
$study_year = "";

// Create connection with the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myschool";
$connection = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['send'])) {
        $class_id = $_POST['class_id'];
        $class_name = $_POST['class_name'];
        $class_teacher_id = $_POST['teacher_id']; // Use the correct name of the input field
        $study_year = $_POST['study_year'];
        $errorMessage = "";
        $successMessage = "";

        // Check if any data is empty
        if (empty($class_id) || empty($class_name) || empty($class_teacher_id) || empty($study_year)) {
            $errorMessage = "يجب أن تملأ جميع الحقول";
        } else {
            // Add new class to the database 
            $sql = "INSERT INTO class (class_id, class_name, class_teacher_id,class_school_id, study_year) VALUES ('$class_id', '$class_name', '$class_teacher_id',1, '$study_year')";
            if ($connection->query($sql) === TRUE) {
                $successMessage = "تم إضافة الصف بنجاح";
            } else {
                $errorMessage = "حدث خطأ في الاستعلام: " . $connection->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Myschool</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"> -->
    <link rel="stylesheet" href="../bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js">
    
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../admin/styles.css">
    <?php include "../admin/index.html"; ?>
    <style>
        
        .table  tr th{
            background-color:rgb(89, 124, 214);
            color:white;
        }
        .massage{
           margin-top:70px;

       }
       /* form */
     .s_number,.s_phone,.s_age{
        width:38%;
        margin-right:3rem;
     }
     .s_number label {
    width: 57px;
    margin-right: 1rem;
    margin-bottom: -8px;
    }
    .s_name{
        width:70%;
        margin-right:3rem;
     }
     .s_name label {
    width: 57px;
    margin-right: 1rem;
    margin-bottom: -8px;
    }
    .image{
        position: absolute;
        left:0px;
        top:4px;
    }

    input[type="file"] {
            color: transparent;
        }
        .container-fluid{
            margin-top:-6rem;
        }
       .navhead{
        margin-top: -5rem;
       }

    .form-image{
        padding:44px;
        margin-top:1.2rem;
        margin-left:1.2rem;
        font-size:0px;
        text-align: none;
        border: 2px solid red;
    }
    .custom-file-label{
        position:absolute;
        top:-2rem;
        left:42px;
        margin-top:10rem;
    }
    .s_sex {
        position: relative;
        right: 35%;
        margin-top: -55px;
        margin-bottom: 8%;
    }
    .ss {
        position: relative;
        right: 38%;
        margin-top: -197px;
        margin-bottom: 18%;
    }
    .ss2 {
        position: relative;
        right: 70%;
        margin-top: -234px;
        margin-bottom: 115px;
    }
    .ss3 {
        position: relative;
        right: 65%;
        margin-top: -88px;
        margin-bottom: 82px;
    }
    <?php include "../include/style.css"; ?>
    .table{
            padding-right:2rem;
            margin:2px 17px;
            margin-left:5rem !important;
            width:97%;
         
        }
    .navhead ul {
    padding-right: 2rem;
    padding-top: 2rem;
    }
    .navhead li{
        margin-right: 2rem;
    }
    .navbar-expand-lg{
        position: fixed;
        top: 0.7rem;
        right: 19rem;
        font:bold;
        z-index: 2;
    }
    ul li .dropdown-toggle{
        color:white !important;

    }
    </style>
    <link href="../teacher/sidebars.css" rel="stylesheet">
</head>
<body>

<div class="head">
        <!--star the header-->
        <header>
            <!--star the navagition-->
            <nav class="navhead">
                <ul>
                    <li>
                        <a style="margin-bottom: 5px;"  href="#addstudent" > <button class="bttn1"
                            onclick="document.getElementById('addstudent').style.display='block'"
                            style=" width:auto; border:none; top:8px; "  > إضافة فصل</button>
                        </a>
                    </li>
                            <form action="" method="GET">
                            <li><a  href="../login.php">تسجيل الخروج</a></li>
                            </form>
                </ul>
            </nav>
        </header>
    </div>

    <div class="massage">
     <marquee direction="left">👩‍🎓👨‍🎓   عرض جميع الطلاب    👩‍🎓👨‍🎓</marquee>

    </div>
    
    <table class="table table-striped table-hover ">
       
            <tr>
                <th  style="background-color:rgb(89, 124, 214);"> رقم الفصل</th>
                <th style="background-color:rgb(89, 124, 214);">اسم الفصل</th>
                <th style="background-color:rgb(89, 124, 214);">رئيس الفصل</th>
                <th  style="background-color:rgb(89, 124, 214);">السنة الدراسية </th>
                <th  style="background-color:rgb(89, 124, 214);">  </th>
                <th  style="background-color:rgb(89, 124, 214);">  </th>
            </tr>

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
              
               //read all row from database table 
               $sql1="select * from class ";
               $result=$connection->query($sql1);
               $sql2="select * from teacher";
               $result2=$connection->query($sql2);
               if(!$result|| !$result2){
                   die("Invalid query : ".$connection->error);
                }
                
                //read data of each row
                while($row=$result->fetch_assoc()){
                    while( $row2=$result2->fetch_assoc()){
                echo "
                <tr>
                <td>$row[class_id]</td>
                <td>$row[class_name]</td>
                <td>$row2[teacher_name]</td>
                <td>$row[study_year]</td>
                <td></td>
                <td>
                    <a class='btn btn-primary btn-sm' href='?class_id=$row[class_id]'>تعديل</a>
                    <a class='btn btn-danger btn-sm' href='delete.php?class_id=$row[class_id]'>حذف</a>
                </td>
             </tr>
                ";
                break;
            }
               }
            
            ?>
            
    </table>
    <?php  include "create.php" ?>
    <script>
// Get the modal
var modal = document.getElementById('addstudent');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>
</html>
