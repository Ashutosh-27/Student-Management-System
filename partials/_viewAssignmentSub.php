<?php
                include '_dbconnect.php';
                session_start();
                $title = $_GET['title'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Assignments</title>
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> 
    <style>
        table, th, td {
  border: 1px solid;
  border-collapse: collapse;
  margin: 0;
}

th, td {
    padding: 10px;
    margin: 0;
}
    </style>
</head>

<body style="padding:1em;">
<div class="container">
<h1><?php echo"$_SESSION[subject]"?></h1>
    <h2><?php echo"$title"?></h2>
    <div style="width: 80%;margin: 5em auto">
        <table style="width:100%;text-align:center;border:1px solid" id="myTable">
           
                <tr style="border:1px solid black;">
                    <th>Title</th>
                    <th>Student Id</th>
                    <th>Uploaded file</th>
                </tr>
            
               <?php
              

                $sql = "SELECT * FROM `submittedassignments` WHERE subject='$_SESSION[subject]' AND title='$title'";

                $result = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo"
                        <tr>
                            <td>$row[title]</td>
                            <td>$row[student_id]</td></td>
                            <td><button btn btn-primary><a href='../$row[uploaded_file]'>View</a></button></td>
                        </tr>
                    ";
                }
                ?>
                
            
        </table>
    </div>
</div>
   

    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
</body>

</html>