<?php
$name="";
$subject_name="";
$degree="";
$appreciation="";
$OrderLevel="";
 
//create connection with database
$servername="localhost";
$username="root";
$password="";
$dbname= "myschool";
$connection=new mysqli($servername,$username,$password,$dbname);
if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['send'])){
    $name=$_GET['name'];
    $subject_name=$_GET['subject_name'];
    $degree=$_GET['degree'];
    $appreciation=$_GET['appreciation'];
    $OrderLevel=$_GET['OrderLevel'];
    
    //check if is not any data empty
    $errorMassage="";
    $successMassage="";
    }
  do{
    if(empty($name)||empty($subject_name)||empty($degree)||empty($appreciation)||empty($OrderLevel)){
        $errorMassage="يجب أن تملأ جميع الحقول";
        break;
    }

    //add new student to database 
    $sql="insert into subjects (name,subject_name,degree,appreciation,OrderLevel)".
    "values('$name','$subject_name','$degree','$appreciation','$OrderLevel')";
    $result=$connection->query($sql);
    if(!$result){
        $errorMassage="Invalid query".$connection->error;
        break;
    }
    
$successMassage="تم إضافة الطالب بنجاح ";
// 
  }while(false);

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
    <?php include "../admin/index.html"; ?>
    <style>
        .table{
            padding-right:2rem;
            margin:2px 17px;
            margin-left:5rem !important;
            width:97%;
        }
        .table  tr th{
            background-color:rgb(89, 124, 214);
            color:white;
        }
        <?php include "../include/style.css"; ?>
        .topnav{
            margin-top: 0%;
        }
        .navhead ul {
        padding-right: 2rem;
        padding-top: 2rem;
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
        margin-top: -1rem;
    }
    .topnav a{
        color:red;
        margin-right: 7px;
    }
    .topnav li a:hover{
        color:red;
        background-color: none;
    }
    .bttn2 {
        background-color: rgb(89, 124, 214);
        color: white;
    }
    </style>
</head>
<body>

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
      echo '<nav class="navbar navbar-expand-lg navbar-blue">
      <ul class="navbar-nav">
      <li class="nav-item dropdown">
           <button class="btn btnName btn-blue dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            فرز المواد
           </button>
           <ul class="dropdown-menu dropdown-menu-blue">';
           //read data of each row
           while($row1=$result->fetch_assoc()){
               $subject_id=$row1['subject_id'];
        if(!empty($row1['subject_name'])){
           echo "<li>
           <a class='dropdown-item' href='?sort=$subject_id'>$row1[subject_name]</a>
            </li>";
            $row1['subject_id']='';
        }
    }
        echo '</ul>
        </li>
      </ul>
  </nav>';
    ?>
    
<div class="topnav">
      <a style="margin-bottom: 5px;"  href="#add" > <button class="bttn1"
        onclick="document.getElementById('add').style.display='block'"
        style=" width:auto; border:none; top:8px; "  >إضافة درجة طالب</button></a>

        <a style="margin-bottom: 5px;"  href="#addsubject" > <button class="bttn2"
        onclick="document.getElementById('addsubject').style.display='block'"
        style=" width:auto; border:none; top:8px; "  >إضافة مادة</button></a>
      
    </div>
    <div dir="ltr">
    <div class="massage">
     <marquee direction="left">👩‍🎓👨‍🎓 عرض درجات الطلاب👩‍🎓👨‍🎓</marquee>
    </div>
    </div>
    
    <table class="table table-striped table-hover ">
        
            <tr>
                <th  >الرقم</th>
                <th  >الاسم</th>
                <th  >اسم المادة</th>
                <th  >الدرجة</th>
                <th  >التقدير</th>
                <th  >الترتيب</th>
                <th  ></th>
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
              
               //this is for class_name
               if(isset($_GET['sort'])){
                $subject_id=$_GET['sort'];
                $sql1="select * from subjects where subject_id='$subject_id'";
                $result=$connection->query($sql1);
                $sql2="select * from subject";
                $result2=$connection->query($sql2);
                
                if(!$result){
                    die("Invalid query : ".$connection->error);
                 }
               //read data of each row
               while($row1=$result->fetch_assoc()){
                $subject_id1=$row1["subject_id"];
                while($row2=$result2->fetch_assoc()){
                $subject_id2=$row2["subject_id"];
                if($subject_id1==$subject_id2){
                    echo "
                <tr>
                <td>$row1[id]</td>
                <td>$row1[name]</td>
                <td>$row2[subject_name]</td>
                <td>$row1[degree]</td>
                <td>$row1[appreciation]</td>
                <td>$row1[OrderLevel]</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='edit.php?id=$row1[id]'>تعديل</a>
                    <a class='btn btn-danger btn-sm' href='delete.php?id=$row1[id]'>حذف</a>
                </td>
             </tr>
                ";
                break;
            }
               }
            }
            }else{
                 //read all row from database table 
               $sql="select * from subjects inner join subject on subjects.subject_id=subject.subject_id";
               $result=$connection->query($sql);
                
               if(!$result){
                die("Invalid query : ".$connection->error);
               }
                 
               //read data of each row
               while($row=$result->fetch_assoc()){
                echo "
                <tr>
                <td>$row[id]</td>
                <td>$row[name]</td>
                <td>$row[subject_name]</td>
                <td>$row[degree]</td>
                <td>$row[appreciation]</td>
                <td>$row[OrderLevel]</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='edit.php?id=$row[id]'>تعديل</a>
                    <a class='btn btn-danger btn-sm' href='delete.php?id=$row[id]'>حذف</a>
                </td>
             </tr>
                ";
               }
            }
            ?>
          
    </table>

    <?php  include "create.php" ?>
    <?php  include "addsubjects.php" ?>
    <script>
// Get the modal
var modal = document.getElementById('add');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>
</html>