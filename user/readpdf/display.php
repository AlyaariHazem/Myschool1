<?php 
$id=$_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Mychool</title>
</head>
<body>
<header>
            <div class="headline">
                <h1>
                    <p>My school</p>
                </h1>
            </div>
            <!--star the navagition-->
            <nav class="navhead">
                <ul>
                    <li><a href="../index.php?id=<?php echo $id; ?>">الصفحة الرئيسية </i></a></li>
                    <li><a href="#">جدول الحصص</a></li>
                    
                    <li class="dropdown">
                        <button class="dropbtn"><a href="#">اتصل بنا</a></button>
                        <div class="dropdown-contant">
                            <a href="https://HazemAlyaari.com" target="_blank"><img
                                    src="../fontawesome-free-6.4.2-web/svgs/brands/facebook-f.svg" alt="photo"></a>
                            <a href="https://HazemAlyaari.com" target="_blank" class="pho"><img
                                    src="../fontawesome-free-6.4.2-web/svgs/brands/telegram.svg" alt="photo"></a>
                            <a href="https://HazemAlyaari.com" target="_blank" class="pho"><img
                                    src="../fontawesome-free-6.4.2-web/svgs/brands/twitter.svg" alt="photo"></a>
                            <a href="https://HazemAlyaari.com" target="_parent" class="pho"><img
                                    src="../fontawesome-free-6.4.2-web/svgs/brands/linkedin-in.svg" alt="photo"></a>
                        </div>
                    </li>
                    <li><a href="../../login.php">تسجيل الخروج</a></li>
                    <li><button type="submit">إرسال</button></li>
                    <li><input class="btnsearch" type="text" value="..ابحث هنا" style="text-align: right; float: right;"
                            name="search"></li>
                </ul>
            </nav>
        </header>
        <div class="photo" style="padding-bottom:53rem;">
            <div class="img1">
    <?php 
    include '../../include/connection.php';
    $sql = 'SELECT BookName FROM books';
    $result=mysqli_query($connection,$sql);
    while($row=mysqli_fetch_assoc($result)) {
        $name=$row['BookName'];
        echo "<a href='../pdf/lec1.pdf'><img src='imagepdf/$name' alt='photo'></a>";
        
        
    }
    ?>
        </div>

    </div>
</body>
</html>