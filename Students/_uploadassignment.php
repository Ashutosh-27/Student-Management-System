<?php
    include '../partials/_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();

    $title = $_POST['title'];
    $subject = $_POST['subject'];
    $id= $_POST['returnID'];

    if (isset($_FILES['file_upload'])) {
        $_file_name = $_FILES['file_upload']['name'];
        $_file_tmp = $_FILES['file_upload']['tmp_name'];
        move_uploaded_file($_file_tmp, "../assignmentsUploaded/".$_file_name);
        $uploadedFile = "assignmentsUploaded/".$_file_name;
    }

    $sql = "INSERT INTO `submittedassignments`(`subject`, `title`, `student_id`, `uploaded_file`) VALUES ('$subject', '$title', '$_SESSION[rollno]', '$uploadedFile');";

    $result = mysqli_query($connect, $sql);
    $inserted = true;
    echo"Inserted";

    header("Location:_assignment.php?id=$id");
}

?>