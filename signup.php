<?php

use LDAP\Result;

    include 'partials/_dbconnect.php';

    $inserted = false;

    $subject_codes = array("OperatingSystem"=>1, "Software Testing"=>2, "Web Technologies - II"=>3,"Data Analytics"=>4,"Java - II"=>5,"Compiler Construction"=>6);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // $username = $_POST['userName'];

        $code = $_POST['code'];
        $name= $_POST['username'];
        $post = $_POST['post'];
        $subject = $_POST['subject'];
        $subject_code = $_POST['subject_code'];
        $wrkemail = $_POST['workemail'];
        $contact = $_POST['contact'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $teacher_img = "";
       
        //check if username is taken
        $existUser = "SELECT * FROM `teacherslobby` WHERE  code = '$code';";
        $result = mysqli_query($connect , $existUser);
        $numExistusers = mysqli_num_rows($result);

        if($numExistusers > 0 ){
            header("location:signup.php?exist=true&code=$code");
        }
        else{
            if($password == $cpassword){
                // $hashpwrd = password_hash($password,PASSWORD_DEFAULT);

                if (isset($_FILES['teacher_img'])) {
                    $_file_name = $_FILES['teacher_img']['name'];
                    $_file_tmp = $_FILES['teacher_img']['tmp_name'];
                    move_uploaded_file($_file_tmp, "./teachers_pfp/".$_file_name);
                    $teacher_img = "teachers_pfp/".$_file_name;
                }

                $sub_code = $subject_codes["$subject_code"];

                $sql ="INSERT INTO `teacherslobby` (`code`, `password`, `post`, `username`, `subject`,`subject_code`, `workemail`, `contact`, `img`) VALUES ('$code', '$password', '$post', '$name', '$subject_code','$sub_code', '$wrkemail', '$contact', '$teacher_img');";

                $result= mysqli_query($connect,$sql);
                $inserted=true;

                if($result){
                    header('location:stafflogin.php');
                }
                else{
                    echo "ERROE";
                }
               
            }
            
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
    <h2 style="margin:1em auto;text-align:center;color:white">MyStudent <small>(staff signup)</small></h2>
    <div class="container my-5">
        <h4 style="text-align:center;color:white">Sign-Up to our web-site</h4>

        <div class="form_container">
        <form class="my-4 signup_form" method="POST" action="Signup.php" onsubmit="return check()" style="max-width: 400px;margin:auto" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Code <small>(enter staff code)<b style="color:red">*</b></small></label>
                <input type="text" class="form-control" id="code" name="code" aria-describedby="emailHelp" maxlength="30" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name <b style="color:red">*</b></label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" maxlength="30" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Subject Specialization</label>
                <input type="text" class="form-control" id="subject" name="subject" aria-describedby="emailHelp" maxlength="30">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Assigned Subject Code <b style="color:red">*</b></label>
                
                <select class="form-select" name="subject_code" id="subject_code" required>
                    <option value="OperatingSystem">OperatingSystem</option>

                    <option value="Software Testing">Software Testing</option>

                    <option value="Web Technologies - II">Web Technologies - II</option>

                    <option value="Data Analytics">Data Analytics</option>

                    <option value="Java - II">Java - II</option>

                    <option value="Compiler Construction">Compiler Construction</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Post/Status</label>
                <input type="text" class="form-control" id="post" name="post" aria-describedby="emailHelp" maxlength="30" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Work Email </label>
                <input type="email" class="form-control" id="workemail" name="workemail" aria-describedby="emailHelp" maxlength="35">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Contact <b style="color:red">*</b></label>
                <input type="text" class="form-control" id="contact" name="contact" aria-describedby="emailHelp" maxlength="35" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Profile Pic <b style="color:red">*</b></label>
                <input type="file" class="form-control" id="teacher_img" name="teacher_img" maxlength="20" required+ph>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" maxlength="20">
            </div>
            
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" maxlength="20">
            </div>

           
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        <div class="linkbtn" style="margin: 20px auto;width:max-content;"><a href="./stafflogin.php" >Signin as Staff</a></div>
    </div>
    </div>

   



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        const check=()=>{
            let password1 = document.getElementById('password').value;
            let password2 = document.getElementById('cpassword').value;

            if(password1 === password2){
                return true;
            }
            else{
                alert('PASSWORD MISMATCHED')
                return false;
            }
        }
    </script>
</body>

</html>