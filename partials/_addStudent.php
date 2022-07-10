<?php

include '_dbconnect.php';

$inserted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $student_rollno = $_POST['student_rollno'];
    $student_name = $_POST['student_name'];
    $student_email = $_POST['student_email'];
    $student_img = $_POST['student_img'];
    $student_std = $_POST['student_std'];
    $student_division = $_POST['student_division'];
    $student_password = $_POST['student_password'];
    $student_cpassword = $_POST['student_cpassword'];


    $existStudent = "SELECT * FROM `studentslobby` WHERE  rollno = '$student_rollno' AND division = '$student_division'";
    $result = mysqli_query($connect, $existStudent);
    $numExistStudents = mysqli_num_rows($result);

    if ($numExistStudents > 0) {
        header("location:../HOD.php?studentadded=false");
    } else {
        if ($student_password == $student_cpassword) {
            // $hashpwrd = password_hash($password,PASSWORD_DEFAULT);

            if (isset($_FILES['student_img'])) {
                $_file_name = $_FILES['student_img']['name'];
                $_file_tmp = $_FILES['student_img']['tmp_name'];
                move_uploaded_file($_file_tmp, "../students_images/".$_file_name);
                $student_img = "students_images/".$_file_name;
            }
            




            $sql = "INSERT INTO `studentslobby` (`rollno`, `studentname`, `password`, `img`, `email`, `std`, `division`) VALUES ('$student_rollno', '$student_name', '$student_password', '$student_img', '$student_email', '$student_std', '$student_division');";

            $result = mysqli_query($connect, $sql);
            $inserted = true;

            if ($result) {
                header("location:../admin.php?studentadded=true");
            } else {
                echo "ERROR";
            }
        } else {
            echo "$student_password<br>$student_cpassword";
        }
    }
}
?>


<!-- Add Student Modal -->
<div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="add_form" method="POST" action="partials/_addStudent.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Roll NO</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp" id="student_rollno" name="student_rollno">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" class="form-control" " aria-describedby=" emailHelp" id="student_name" name="student_name">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="student_email" aria-describedby="emailHelp" name="student_email">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="student_img" name="student_img" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Standard</label>
                        <input type="text" class="form-control" id="student_std" name="student_std" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Division</label>
                        <input type="text" class="form-control" id="student_division" name="student_division" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="student_password" name="student_password">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="student_cpassword" name="student_cpassword">
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>