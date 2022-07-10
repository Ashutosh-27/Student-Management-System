<?php
include 'partials/_dbconnect.php';
session_start();

$name = $_SESSION['name'];

$insert = false;
$update = false;
$delete = false;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['title'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $dt = $_POST['date'];

        $sql = "INSERT INTO teacherstodos(from_a,title,descprition,dueDT) VALUES ('$name','$title', '$description','$dt')";

        $result = mysqli_query($connect, $sql);
        $insert = true;
    }

    if (isset($_POST['titleEdit'])) {
        $titleEdit = $_POST['titleEdit'];
        $descriptionEdit = $_POST['descriptionEdit'];
        $dateEdit = $_POST['dateEdit'];
        $serialNoEDit = $_POST['idEdit'];

        $sql = "UPDATE `teacherstodos` SET `title` = '$titleEdit' , `descprition` = '$descriptionEdit', `dueDT` = '$dateEdit' WHERE `teacherstodos`.`id` =$serialNoEDit";

        $result = mysqli_query($connect, $sql);

        $update = true;
    }
}


if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $sql = "DELETE FROM `teacherstodos` WHERE id = $sno";
    $result = mysqli_query($connect, $sql);
    $delete = true;
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

    <!-- BootStrap - Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- DataSet CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <title>iNotes - for staff</title>
</head>

<body>

    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form method="post" action="./teachertodos.php ">
                        <input type="hidden" name='idEdit' id="idEdit">
                        <div class="mb-3">
                            <label for="title" class="form-label">Note Title : </label>
                            <input type="text" class="form-control" id="titleEdit" name='titleEdit' aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Note Description : </label>
                            <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Todo date : </label>
                            <input type="date" class="form-control" id="dateEdit" name='dateEdit' aria-describedby="emailHelp">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="status_container" style='width:300px;margin:2em auto;height:70px'>
        <?php
        if ($insert == true) {
            echo "
                <div class='alert alert-success' role='alert'>
                <strong>Inserted Successfully</strong>
                </div>
                ";
        } elseif ($update == true) {
            echo "
            <div class='alert alert-primary' role='alert'>
            <strong>Updated Successfully</strong>
            </div>
            ";
        } elseif ($delete == true) {
            echo "
            <div class='alert alert-danger' role='alert'>
            <strong>deleted Successfully</strong>
            </div>
            ";
        } else {
            NULL;
        }
        ?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" style="display: none;">
            Launch demo modal
        </button>
    </div>



    <div class="container my-4">

        <?php
        echo "
<div><button class='btn btn-primary my-5'><a href='./teachers.php?username=$name' style='color:white;text-decoration:none'>Home page</a></button></div>";
        ?>

        <h2>Add a Todo </h2>

        <form method="post" action="./teachertodos.php ">
            <div class="mb-3">
                <label for="title" class="form-label">Title : </label>
                <input type="text" class="form-control" id="title" name='title' aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description : </label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Due Date: </label>
                <input type="date" class="form-control" id="date" name='date' aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <div class="container">
        <table class="table" >
            <thead>
                <tr>
                    <th scope="col">srNO</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">assigned</th>
                    <th scope="col">due</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `teacherstodos` WHERE from_a = '$name'";
                $result = mysqli_query($connect, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    //echo var_dump($row)
                    echo "
                <tr>
                <th scope='row'>" . $sno . "</th>
                <td>" . $row['title'] . "</td>
                <td>" . $row['descprition'] . "</td>
                <td style='display:none;'>" . $row['id'] . "</td>
                <td>$row[assigned_dt]</td>
                <td>$row[dueDT]</td>
                <td><button id='editModal' class='btn btn-sm btn-primary edit'>Edit</button></td>
                <td><button class='btn btn-sm btn-primary delete' id=" . $row['id'] . ">Delete</td>
                </tr>
                ";
                }
                ?>

            </tbody>
        </table>


    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



    <!-- Jquery CDn  -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


    <!-- DataSet JS -->
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        edits = document.getElementsByClassName('edit');
        titleEDit = document.getElementById('titleEdit');
        descriptionEdit = document.getElementById('descriptionEdit');
        SerialnoEdit = document.getElementById('idEdit');
        dateEdit = document.getElementById('dateEdit');


        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {

                tr = e.target.parentNode.parentNode;

                title = tr.getElementsByTagName("td")[0].innerText;
                descp = tr.getElementsByTagName("td")[1].innerText;
                serialNo = tr.getElementsByTagName("td")[2].innerText;
                duedt = tr.getElementsByTagName("td")[4].innerText;

                titleEDit.value = title
                descriptionEdit.value = descp
                SerialnoEdit.value = serialNo
                dateEdit.value = duedt

                $('#editModal').modal('toggle')
                console.log(serialNo)
            })
        })

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {

                serialNo = e.target.id


                if (confirm("Are you Sure you want to delete")) {
                    console.log('YEs')
                    window.location = `teachertodos.php?delete=${serialNo}`
                } else {
                    console.log('noe')
                }
            })
        })
    </script>
</body>

</html>