<?php
session_start();

include '../partials/_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["username"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM `studentslobby` where email = '$email' AND password='$password'";

    $result = mysqli_query($connect, $sql);
    $num = mysqli_num_rows($result);
    $return['valid']=false;

    if($num >0){
        $_SESSION['loggedin'] = true;
        $_SESSION['student_email'] = $email;

        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['username'] = $row['studentname'];
            $_SESSION['rollno'] = $row['rollno'];
        }

        $return['valid'] = true;
        $return['url'] = "Students/index.php?studentmail=$email";

    }
    echo json_encode($return);

}
?>