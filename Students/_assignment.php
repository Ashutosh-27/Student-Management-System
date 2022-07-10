<?php
session_start();

include '../partials/_dbconnect.php';
$id = $_GET['id'];
$rollno = $_SESSION['rollno'];

$sql = "SELECT * FROM assignments WHERE id='$id'";
$result = mysqli_query($connect, $sql);



while ($row = mysqli_fetch_assoc($result)) {
    $title = $row['title'];
    $by = $row['from_a'];
    $subject = $row['subject'];
    $assigned_dt = $row['Assigned_dt'];
    $submission_dt = $row['submission_dt'];
    $file = $row['pdf'];
    $description = $row['description'];
    $linkfile = substr("$file",17);
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        h3,h4 {
            text-align: center;
        }
        hr{
            margin: 10px;
        }
        .container
        {
            padding: 2em ;
            border: 1px solid;
        }

        .Dates,.file,.description,.footer{
            margin: 2em;
            display: block;
        }

        .Dates{
            margin-top:3em;
            text-align:left;
            display: flex;
            flex-direction: column;
            justify-content:left;
            align-items: center;
        }
        .Dates div,hr,
        .footer div{
            width: 200px;
            margin: 2px auto;
            position: relative;
           right: -25%;
        }

        .description{
           width: 80%;
           margin: 20px auto;
        }
    </style>
</head>

<body>


    <div class="container my-5">
        <?php
        
        echo "
        
        <h3>Subject : $subject</h3>
        <h4>Title : $title</h4>
        <div class='Dates'>
            <div class='assigned'>
                <span>Assigned Date :
                </span>
                <br>
                <span>$assigned_dt</span>
            </div>
            <hr>
            <div class='submisson'>
                <span>Submission Date :
                </span>
                <br>
                <span>$submission_dt</span>
            </div>
        </div>
        <div class='file'><b>File : </b><a href='../$file' target='_blank'>$linkfile</a></div>
        <div class='description'>$description</div>
        <div class='file_upload'>
";
       
        $sq = "SELECT * FROM `submittedassignments` WHERE (subject='$subject') AND (title='$title') AND (student_id = '$rollno')";
        $res = mysqli_query($connect,$sq);
        $count = mysqli_num_rows($res);

        if($count > 0){
            while($row = mysqli_fetch_assoc($res)){
                $Assignmentid = $row['id'];
                $Upfile = $row['uploaded_file'];
                $filename = substr($file,19);
            }
            echo "<div class='file'><b>Submitted File : </b><a href='../$Upfile' target='_blank'>$filename</a><br>
                <button><a href='./_deleteAssignment.php?id=$id&assignmentid=$Assignmentid'>Delete</a></button>
            </div>
            ";
        }
        else{
            echo"
            <form method='post' action='_uploadassignment.php' enctype='multipart/form-data'>
                    <label for='exampleInputPassword1' class='form-label'>Profile Pic</label>
                    <input type='file' class='form-control' id='file_upload' name='file_upload' required>
                    <input type='hidden' class='form-control' id='title' name='title' value='$title'>
                    <input type='hidden' class='form-control' id='subject' name='subject' value='$subject'>
                    <input type='hidden' class='form-control' id='returnID' name='returnID' value='$id'>
                    <br>
                    <input type='submit' value='upload'>
            </form>";
        }
       
        

       


        echo"
        </div>
        <div class='footer'><div><b>assignment by -</b><br>$by</div></div>
        ";
        ?>
      
    </div>




    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>