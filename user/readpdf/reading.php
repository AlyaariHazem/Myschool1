<!DOCTYPE html>
<html>
<head>
    <title>read</title>
</head>
<body>

    <?php
    include "../../include/connection.php";
    if(isset($_GET['name'])){
        $sql="SELECT * FROM books";
        $result=mysqli_query($conn,$sql);
        
        while($row=mysqli_fetch_assoc($result)){

        }
        $name = $_GET['name'].'.pdf';
        
        $pdfFile = '../../pdf/$name';

        // Read the PDF file and convert it to base64 encoding
        $pdfData = base64_encode(file_get_contents($pdfFile));

        // Display the PDF using an embedded <iframe> tag
        echo '<iframe src="data:application/pdf;base64,'.$pdfData.'" width="100%" height="700px"></iframe>';
    }
    ?>
</body>
</html>