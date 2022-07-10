<?php
    $server = 'localhost';
    $username = "root";
    $password="";

    $database="studentmanagement";


    $connect = mysqli_connect($server,$username,$password,$database);
    
    // if($connect){
    //     echo "sucess";
    // }
    // else{
    //     die("Error : " . mysqli_connect_error());
    // }
?>