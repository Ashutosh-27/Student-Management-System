<?php
include 'partials/_dbconnect.php';

$login = false;

session_start();
if(isset($_SESSION['loggedin'])){
    unset($_SESSION['loggedin']);
    }
    
    if(isset($_SESSION['code'])){
    unset($_SESSION['code']);
    }
    
    if(isset($_SESSION['name'])){
    unset($_SESSION['name']);
    }
    
    if(isset($_SESSION['subject'])){
    unset($_SESSION['subject']);
    }
    if(isset($_SESSION['staffpost'])){
    unset($_SESSION['staffpost']);
    $_SESSION['t'] = true;
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST["code"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM `teacherslobby` where code = '$code' AND password='$password'";
    $result = mysqli_query($connect, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {

        $login = true;
        
        $_SESSION['loggedin'] = true;
        $_SESSION['code'] = $code;
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['name'] = $row['username'];
            $_SESSION['subject'] = $row['subject'];
            
            if(isset($_SESSION['t'])){
                unset($_SESSION['t']);
                }

                
            if($row['post'] == 'admin'){
                $_SESSION['staffpost'] = 'admin';
                header("location: ./admin.php");
            }
            else{
                $_SESSION['staffpost'] = 'teachers';
                header("location: teachers.php?username=".$_SESSION['username']."");
            }
        }
       
    } else {
        header("location: ./stafflogin.php?invalid=true");
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
        <h2 style="margin:1em auto;text-align:center;color:white">MyStudent <small>(staff login)</small></h2>
        <div class="container my-5" style="max-width:400px">
            <form action="stafflogin.php" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="text" class="form-control" id="code" name="code" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <div class="linkbtn" style="margin: 20px;"><a href="./signup.php" >Signup as Staff</a></div>
            <div class="linkbtn" style="margin: 20px;"><a href="./login.php" >login as Student</a></div>
       
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
            
            window.location.replace('stafflogin.php');
            
        }
    </script>
</body>

</html>