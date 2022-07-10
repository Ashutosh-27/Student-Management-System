<?php
include 'partials/_dbconnect.php';

session_start();



if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:login.php");
    exit;
}



$sql = "SELECT * FROM `teacherslobby` where code = '" . $_SESSION["code"] . "'";
$result = mysqli_query($connect, $sql);

$post;
$subject;
$workemail;
$contact;
$img;

$name=$_SESSION['name'];

while ($row = mysqli_fetch_assoc($result)) {
    $post = $row['post'];
    $subject = $row['subject'];
    $workemail = $row['workemail'];
    $contact = $row['contact'];
    $img = $row['img'];
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
    <link rel="stylesheet" href="./css/admin.css?v=<?php echo time(); ?>">
 

    <title>Welcome ~ <?php echo $_SESSION['name'] ?></title>
    <style>
        <?php include "./css/admin.css" ?>
    </style>
    <!-- <style>
        body {
            overflow-x: hidden;
        }

        .row {
            height: 40em;
            border: 1px solid red;
            padding: 5px;
        }

        .profile_info {
            padding: 20px;
            border: 1px solid;
            width: 100%;
            margin: 1em auto;
            display: flex;
            flex-direction: row;
            justify-content: center;

        }

        .profile_info .img_container {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            height: 220px;
            padding: 10px;
            margin: 0 auto;
            margin-bottom: 10px;
            width: 50%;
        }

        .profile_info .img_container strong {
            font-size: 30px;
            text-decoration: underline;
        }

        .profile_info .info_container {
            padding: 10px;
            width: 50%;
        }

        .profile_info .info_container ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0;
            height: 100%;
        }

        .profile_info .info_container ul li {
            margin: auto;
            width: 90%;
            margin: 10px auto;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .profile_info .info_container ul li span:nth-child(2) {
            font-size: 22px;
            margin: 0 1em;
            font-weight: 600;
        }

        .profile_info_2 {
            border: 1px solid;
            height: 100%;
            padding: 0;
        }

        .db_info .buttons_container {
            height: 200px;
            border: 1px solid blue;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            width: 100%;
            padding: 20px;
        }


        .add_form {
            display: grid;
            grid-template-columns: repeat(2, auto);
            column-gap: 10px;
        }

        .create-Assignment_form .inputs_container {
            display: grid;
            grid-template-columns: repeat(2, auto);
            column-gap: 10px;
        }

        .view_notices,.view_subject,.view_assignments,.view_staff,.view_students {
            margin: 5em auto;
        }

        table {
            margin: 1em auto;
        }
    </style> -->
</head>

<body>

    <?php require 'partials/_sidebar.php' ?>





    <?php require 'partials/_addNotice.php' ?>

    <?php require 'partials/_addAssignment.php' ?>


    <div class="container my-5">

        <div class="alert_container" style="height: 80px;margin:50px auto">
            <?php


            if (isset($_GET['noticeadded'])) {
                if ($_GET['noticeadded'] == 'false') {
                    echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert' style='width:450px;margin:auto'>
                <strong>Unable to add Notice</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
                } elseif ($_GET['noticeadded'] == 'true') {
                    echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert' style='width:450px;margin:auto'>
                <strong>Notice Added Successfully</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
                }
            }

            if (isset($_GET['assignmentadded'])) {
                if ($_GET['assignmentadded'] == 'false') {
                    echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert' style='width:450px;margin:auto'>
                <strong>Unable to add Assignment</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
                } elseif ($_GET['assignmentadded'] == 'true') {
                    echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert' style='width:450px;margin:auto'>
                <strong>Assignment Added Successfully</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
                }
            }
            ?>
        </div>

        <div class="profile_info">
            <div class="img_container">
                <img src="./user.jpg" style="width:150px;height:auto;border-radius:50%;">

                <strong> <?php echo $_SESSION['code'] ?></strong>
                <br>
                <strong><?php echo $workemail ?></strong>

            </div>
            <div class="info_container">
                <ul>
                    <li>
                        <span class="">Name : </span>
                        <span class=""> <?php echo $_SESSION['name'] ?> </span>
                    </li>
                    <li>
                        <span class="">Post : </span>
                        <span class=""> <?php echo $post ?> </span>
                    </li>
                    <li>
                        <span class="">Subject : </span>
                        <span class=""> <?php echo $subject ?> </span>
                    </li>

                    <li>
                        <span class="">Contact : </span>
                        <span class=""> <?php echo $contact ?> </span>
                    </li>
                </ul>
            </div>

        </div>



        <div class="db_info">
            <div class="buttons_container">
                <div class="buttons_inner">

                    <button class="btn btn-l btn-warning" id="create_notice">Create Notice</button>
                    <button class="btn btn-l btn-info" id="create_assignment">Create Assignment</button>
                </div>
            </div>

            
        </div>
        <div class="view_notices" id="notices">
            <h2 class="my-2">Notice : </h2>
            <table>
                <tr>
                    <th>Title</th>
                    <th>About</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
                <?php

                $sql = "SELECT * FROM notice WHERE from_a ='$name';";
                $result = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr>
                    <td>$row[title]</td>
                    <td>$row[about]</td>
                    <td>$row[descp]</td>
                    <td>$row[date_time]</td>
                </tr>
                    ";
                }
                ?>
            </table>
        </div>


        <div class="view_assignments" id="assignments">
            <h2 class="my-2">Assignments : </h2>
            <table id="myTable">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>CreatedDate</th>
                    <th>Submission</th>
                    <th>View Submission</th>
                </tr>
                <?php

                $sql = "SELECT * FROM assignments WHERE from_a ='$name';";
                $result = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr>
                    <td>$row[title]</td>
                    <td>$row[description]</td>
                    <td>$row[Assigned_dt]</td>
                    <td>$row[submission_dt]</td>
                    <td><button class='btn btn-primary'><a href='./partials/_viewAssignmentSub.php?title=$row[title]' style='background:#0d6efd;color:white;padding:5px 10px;border-radius:10px'>VIEW</a></button></td>
                </tr>
                    ";
                }
                ?>
            </table>
        </div>

        <div class="view_subject" id="subjectMaterials">
            <h2 class="my-2">Subjects Materials : </h2>
            <?php require 'partials/_subjectM.php' ?>
        </div>
    </div>
   






















    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <!-- Jquery CDn  -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


    <!-- DataSet JS -->
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });

        //Add Notice Modal handler
        const notice_add = document.getElementById('create_notice');
        notice_add.addEventListener("click", (e) => {
            e.preventDefault()

            $('#addNotice').modal('toggle')
        })

        //Add assignment Modal handler
        const assignment_add = document.getElementById('create_assignment')
        assignment_add.addEventListener("click", (e) => {
            e.preventDefault()

            $('#addAssignment').modal('toggle')
        })
    </script>
</body>

</html>