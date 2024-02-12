<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and password from the form
    $username = filter_var($_POST["uname"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["psw"], FILTER_SANITIZE_STRING);

    $servername = "localhost";
    $dbname = "myschool";
    $dbusername = "root";
    $dbpassword = "";

    try {
        // Create a connection to the database
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);

        // Set PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement to retrieve the admin with the given username
        $sql = "SELECT * FROM admin WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $adminResult = $stmt->fetchAll();

        // Prepare the SQL statement to retrieve the student with the given username
        $sql2 = "SELECT * FROM studnet WHERE student_id = :username";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bindParam(':username', $username);
        $stmt2->execute();
        $studentResult = $stmt2->fetchAll();

        // Check if a matching admin is found
        if (count($adminResult) > 0) {
            $hashedPassword = $adminResult[0]['password'];
            
            // Check if the password is hashed or plaintext
            if (password_verify($password, $hashedPassword)) {
                // Admin username and hashed password match
                header("Location: students/students.php");
                exit;
            } else if ($password === $hashedPassword) {
                // Admin username and plaintext password match
                header("Location: students/students.php");
                exit;
            }
        }

        // Check if a matching student is found
        if (count($studentResult) > 0) {
            $hashedPassword = $studentResult[0]['password'];
            
            // Check if the password is hashed or plaintext
            if (password_verify($password, $hashedPassword)) {
                // Student username and hashed password match
                $student = $studentResult[0]['student_id'];
                header("Location: user/index.php?id=$student");
                exit;
            } else if ($password === $hashedPassword) {
                // Student username and plaintext password match
                $student = $studentResult[0]['student_id'];
                header("Location: user/index.php?id=$student");
                exit;
            }
        }

        // No matching admin or student found
        header("Location: login.php");
        exit;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>