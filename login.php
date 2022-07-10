<?php
include 'partials/_dbconnect.php';
session_start();
$login = false;

if(isset($_SESSION['loggedin'])){
    unset($_SESSION['loggedin']);
    }
    
    if(isset($_SESSION['student_email'])){
    unset($_SESSION['student_email']);
    }
    
    if(isset($_SESSION['username'])){
    unset($_SESSION['username']);
    }
    
    if(isset($_SESSION['rollno'])){
    unset($_SESSION['rollno']);
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["login_student_email"];
    $password = $_POST["login_student_password"];


    $sql = "SELECT * FROM `studentslobby` where email = '$email' AND password='$password'";

    $result = mysqli_query($connect, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $login = true;
       
        $_SESSION['loggedin'] = true;
        $_SESSION['student_email'] = $email;

        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['username'] = $row['studentname'];
            $_SESSION['rollno'] = $row['rollno'];
        }

        header("location: Students/index.php?studentmail=$email");
    } else {
        header("location: login.php?invalid=true");
    }

    
}


?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/login.css">
    <title>Hello, world!</title>
</head>

<body>
    <div class="layout">
        <h2 style="margin:1em auto;text-align:center;color:white">MyStudent</h2>
        <div class="container my-5" style="max-width:400px">
            <form action="login.php" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="login_student_email" name="login_student_email" aria-describedby="emailHelp" required>

                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="login_student_password" name="login_student_password" required>
                </div>

                <button type='submit' class="btn btn-primary">Submit</button>
            </form>

            <div class="linkbtn" style="margin: 20px;"><a href="./stafflogin.php">Login in as Staff</a></div>

        </div>
    </div>




    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const product = urlParams.get('invalid')
       
        if(product){
           alert("Inncorrect Creadiatials");
            
            window.location.replace('login.php');
            
        }


        
    </script>
</body>

</html>