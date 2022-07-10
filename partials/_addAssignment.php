<?php


include '_dbconnect.php';

$inserted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();


    $assignment_title = $_POST['assignment_title'];
    $assignment_subject = $_SESSION['subject'];
    $assignment_file = "";
    $assignment_descp = $_POST['assignment_descp'];
    $assignment_submitDT = $_POST['assignment_submitDT'];
    $assignment_from = $_SESSION['name'];


    if (isset($_FILES['assignment_file'])) {
        $_file_name = $_FILES['assignment_file']['name'];
        $_file_tmp = $_FILES['assignment_file']['tmp_name'];
        move_uploaded_file($_file_tmp, "../assignment_files/".$_file_name);
        $assignment_file = "assignment_files/".$_file_name;
    }


    $sql = "INSERT INTO `assignments` (`title`, `subject`, `from_a`, `pdf`, `submission_dt`, `description`) VALUES ('$assignment_title', '$assignment_subject', '$assignment_from', '$assignment_file', '$assignment_submitDT', '$assignment_descp');";

    $result = mysqli_query($connect, $sql);
    $inserted = true;

    if ($result) {
        if($_SESSION['code'] == '23F7'){
            header("location:../admin.php?assignmentadded=true");
        }
        else{
            header("location:../teachers.php?assignmentadded=true");
        }
        
    } else {
        if($_SESSION['code'] == '23F7'){
            header("location:../admin.php?assignmentadded=false");
        }
        else{
            header("location:../teachers.php?assignmentadded=false");
        }
    }


}
?>



<!-- Add Student Modal -->
<div class="modal fade" id="addAssignment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form class="create-Assignment_form" method="POST" action="partials/_addAssignment.php" enctype="multipart/form-data">
                    <div class="inputs_container">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Title</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" id="assignment_title" name="assignment_title">
                        </div>

                        

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Refrence File</label>
                            <input type="file" class="form-control" " aria-describedby=" emailHelp" id="assignment_file" name="assignment_file">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Submission Date</label>
                            <input type="date" class="form-control" " aria-describedby=" emailHelp" id="assignment_submitDT" name="assignment_submitDT">
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" id="assignment_descp" name="assignment_descp" rows="3"></textarea>
                    </div>




                    <button type="submit" class="btn btn-primary check_date">Submit</button>
                </form>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>