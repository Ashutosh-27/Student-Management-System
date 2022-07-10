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

$name = $_SESSION['name'];

while ($row = mysqli_fetch_assoc($result)) {
    $post = $row['post'];
    $subject = $row['subject'];
    $workemail = $row['workemail'];
    $contact = $row['contact'];
    $img = $row['img'];
}

$_SESSION['subject'] = $subject;


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

    <title>Welcome ~ <?php echo $_SESSION['staffpost'] ?></title>
    <style>
        <?php include "./css/admin.css" ?>
    </style>
</head>

<body>

    <?php require 'partials/_sidebar.php' ?>

    <?php require 'partials/_addStudent.php' ?>

    <?php require 'partials/_addNotice.php' ?>

    <?php require 'partials/_addAssignment.php' ?>


    <div class="container my-5">

        <div class="alert_container" style="height: 80px;margin:50px auto">
            <?php
            if (isset($_GET['studentadded'])) {
                if ($_GET['studentadded'] == 'false') {
                    echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert' style='width:450px;margin:auto'>
                <strong>Student already Exist</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
                } elseif ($_GET['studentadded'] == 'true') {
                    echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert' style='width:450px;margin:auto'>
                <strong>Student added Successfully</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
                }
            }

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
                    <button class="btn btn-l btn-primary" id="create_studnt">Create Student</button>
                    <button class="btn btn-l btn-warning" id="create_notice">Create Notice</button>
                    <button class="btn btn-l btn-info" id="create_assignment" style="background-color:#0dcaf0;border:none;color:black">Create Assignment</button>
                </div>
            </div>


        </div>

        <div class="reports">
            <div class="card" id="notices">
                <?php
                    $sql = "SELECT * FROM notice";
                    $result = mysqli_query($connect,$sql);
                    $count = mysqli_num_rows($result);

                    echo"<span><b>Total number of <br>Notices</b></span>
                    <span>$count</span>";
                ?>
            </div>
            <div class="card" id="assignments">
                <?php
                    $sql = "SELECT * FROM assignments";
                    $result = mysqli_query($connect,$sql);
                    $count = mysqli_num_rows($result);

                    echo"<span><b>Total number of <br>Assignments</b></span>
                    <span>$count</span>";
                ?>
            </div>

            <div class="card" id="students">
                <?php
                    $sql = "SELECT * FROM studentslobby";
                    $result = mysqli_query($connect,$sql);
                    $count = mysqli_num_rows($result);

                    echo"<span><b>Total number of <br>Students</b></span>
                    <span>$count</span>";
                ?>
            </div>

            <div class="card" id="teachers">
                <?php
                    $sql = "SELECT * FROM teacherslobby";
                    $result = mysqli_query($connect,$sql);
                    $count = mysqli_num_rows($result);

                    echo"<span><b>Total number of <br>Teachers</b></span>
                    <span>$count</span>";
                ?>
            </div>
        </div>

        <div class="view_notices" id="notices">
            <h2 class="my-2">Notice <small>by you</small> : </h2>
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
            <h2 class="my-2">Assignments <small>by you</small> : </h2>
            <table>
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
                    <td><a href='./partials/_viewAssignmentSub.php?title=$row[title] style='background:#0d6efd;color:white;padding:5px 10px;border-radius:10px'>VIEW</a></td>
                </tr>
                    ";
                }
                ?>
            </table>
        </div>

        <div class="view_subject" id="subjectMaterials">
            <h2 class="my-2">Subjects Materials : </h2>
            <?php require 'partials/_adminsubjectM.php' ?>
        </div>





        <div class="view_students" id="students">
            <h2 class="my-2">Students : </h2>
            <table>
                <tr>
                    <th>Rollno</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>Image</th>
                    <th>Std/Div</th>
                </tr>
                <?php

                $sql = "SELECT * FROM studentslobby";
                $result = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr>
                    <td>$row[rollno]</td>
                    <td>$row[studentname]</td>
                    <td>$row[email]</td>
                    <td><a href='./$row[img]' target='_blank' style='color:blue'>View</a></td>
                    <td>$row[std]/$row[division]</td>
                </tr>
                    ";
                }
                ?>
            </table>
        </div>

        <div class="view_staff" id="staff">
            <h2 class="my-2">Teachers Staff : </h2>
            <table>
                <tr>
                    <th>Code</th>
                    <th>TeacherName</th>
                    <th>SubjectCode</th>
                    <th>workEmail</th>
                    <th>Img</th>
                    <th>contact</th>

                </tr>
                <?php

                $sql = "SELECT * FROM teacherslobby";
                $result = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr>
                    <td>$row[code]</td>
                    <td>$row[username]</td>
                    <td>$row[subject_code]</td>
                    <td>$row[workemail]</td>
                    <td><a href='./$row[img]'  target='_blank' style='color:blue'>View</a></td>
                    <td>$row[contact]</td>
                </tr>
                    ";
                }
                ?>
            </table>
        </div>
    </div>























    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <!-- Jquery CDn  -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


    <!-- DataSet JS -->
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    <script>
        //Add Student Modal handler
        const student_add = document.getElementById('create_studnt');
        student_add.addEventListener("click", (e) => {
            e.preventDefault()

            $('#addStudent').modal('toggle')
        })


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