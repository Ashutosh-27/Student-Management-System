<?php
include 'partials/_dbconnect.php';

session_start();

if(isset($_SESSION['t'])){
    header("location:stafflogin.php");
}

if (!isset($_SESSION['loggedin'])) {
    header("location:login.php");
   
}

else{
    if(isset($_SESSION['student_email'])){
        header("location:Students/index.php?studentmail=$_SESSION[student_email]");

    }
    else{
        if(isset($_SESSION['staffpost'])){
            if($_SESSION['staffpost'] == 'admin'){
                header("location:./admin.php");
            }
            else{
                header("location:./teachers.php?username=$_SESSION[name]");
            }
        }
    }
   
}

?>