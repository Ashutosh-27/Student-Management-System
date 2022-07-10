<?php
include '../partials/_dbconnect.php';

session_start();




if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:../login.php");
    exit;
}

$studentEmail =  $_GET['studentmail'];
$set = 'NOpe';

$sql = "SELECT * FROM `studentslobby` WHERE email = '$studentEmail';";
$result = mysqli_query($connect, $sql);
if ($result) {
    $set = 'Done';
}

$division;
$std;
$img;
$rollno;

while ($row = mysqli_fetch_assoc($result)) {
    $img = $row['img'];
    $std = $row['std'];
    $division = $row['division'];
    $rollno = $row['rollno'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document <?php echo $_SESSION['username'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <style>
        a{
            color: white;
            text-decoration: none;
        }
        a:hover{
            color: white;
            text-decoration:underline;
        }

      
        .student_pic{
           width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: auto;
            
        }
        
        .profile_info{
            padding: 10px;
            margin: 1em auto;
        }
        .sec_A{
            margin: 10px auto;
            width: max-content;
            width: 350px;
        }
        .sec_A .img_container{
           width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: auto;
        }

        .student_email{
            margin: 5px auto;
            text-align: center;
            color: #47494b;
        }
        .sec_B{
            width: 350px;
            display: flex;
            flex-direction: row;
            justify-content:space-evenly;
            flex-wrap: wrap;
            margin: auto;
            margin-top: 20px;
        }

        .subjects{
            width: 700px;
            margin: 2em auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .subjects button{
            margin: 5px 10px;
        }

        table{
            border: 1px solid;
            padding: 1em;
        }
        tr{
            border: 1px solid;
            padding: 1em;
        }
        th,td{
            border: 1px solid;
            padding: 1em;
        }


        .view_notices,.view_assignments {
            margin: 5em auto;
        }

    
    </style>
</head>

<body style="overflow-x: hidden;">

<?php require './_sidebarStudents.php' ?>
    <div class="container my-5">

        <div class="profile_info">
            <?php
            echo "
                <div class='sec_A'>
                <div class='img_container'>
                <img class='student_pic' src='../$img' alt=''>
                </div>
                    
                    <div class='student_email'>
                        <b>$_SESSION[student_email]</b>
                    </div>
                </div>
                <div class='sec_B'>
                    <div>$_SESSION[username]</div>
                   <div>$rollno</div>
                   <div>$std/$division</div>
                </div>
                ";
            ?>

        </div>

        <div class="subjects" id="subjects">
            <button class="btn btn-l btn-primary subject_btn my-2"><a href="./_subject.php?subject=os_notes">OperatingSystem</a></button>
            <button class="btn btn-l btn-primary subject_btn my-2"><a href="./_subject.php?subject=st_notes">Software Testing</a></button>
            <button class="btn btn-l btn-primary subject_btn my-2"><a href="./_subject.php?subject=wt_notes">Web Technologies</a></button>
            <button class="btn btn-l btn-primary subject_btn my-2"><a href="./_subject.php?subject=da_notes">Data Analytics</a></button>
            <button class="btn btn-l btn-primary subject_btn my-2"><a href="./_subject.php?subject=java_notes">Java</a></button>
            <button class="btn btn-l btn-primary subject_btn my-2"><a href="./_subject.php?subject=cc_notes">Compiler Construction</a></button>
        </div>


        <div class="view_notices" id="notices">
            <h2 class="my-2">Notice : </h2>
            <table>
                <thead>
                <tr>
                    <th>Title</th>
                    <th>About</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th >View</th>
    
                </tr>
                </thead>
                <tbody>
                <?php

                $sql = "SELECT * FROM notice;";
                $result = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr>
                    <td>$row[title]</td>
                    <td>$row[about]</td>
                    <td>$row[descp]</td>
                    <td>$row[date_time]</td>
                    <td><button class='btn btn-sm btn-primary'><a href='_notice.php?id=$row[id]' class='table_link'> <i class='bi bi-arrow-up-right-square'></i></a></button>
                    </td>
                </tr>
                    ";
                }
                ?>
                </tbody>
            </table>
        </div>


        <div class="view_assignments" id="assignments">
            <h2 class="my-2">Assignments : </h2>
            <table>
                <thead>
                <tr>
                    <th>Title</th>
                    <th>By</th>
                    <th>Subject</th>
                    <th>CreatedDate</th>
                    <th>Submission</th>
                    <th>View</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $sql = "SELECT * FROM assignments";
                $result = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr>
                    <td>$row[title]</td>
                    <td>$row[from_a]</td>
                    <td>$row[subject]</td>
                    <td>$row[Assigned_dt]</td>
                    <td>$row[submission_dt]</td>
                    <td><button class='btn btn-sm btn-primary'><a href='_assignment.php?id=$row[id]'class='table_link' ><i class='bi bi-arrow-up-right-square'></i></a></button></td>
                </tr>
                    ";
                }
                ?>
                </tbody>    
            </table>
        </div>
    </div>

 


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>