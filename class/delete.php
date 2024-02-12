<?php
if(isset($_GET["class_id"])){
    $id=$_GET["class_id"];
    $servername="localhost";
    $username="root";
    $password="";
    $database="myschool"; 
    $connection=new mysqli($servername,$username,$password,$database);
    $sql="DELETE FROM class WHERE class_id = $id";
    $connection->query($sql);
}
header("location:manageClass.php");
exit;

?>