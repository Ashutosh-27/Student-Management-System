<?php
    include '../partials/_dbconnect.php';

    $id = $_GET['id'];
    $assignmentID = $_GET['assignmentid'];

    $sql = "DELETE FROM `submittedassignments` WHERE id=$assignmentID ";
    $result = mysqli_query($connect,$sql);
 
    if ($result) {
       header("Location: _assignment.php?id=$id");
    } else {
        echo "Error deleting record: ";
    }

?>