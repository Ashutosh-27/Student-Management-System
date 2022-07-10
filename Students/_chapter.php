<?php
session_start();

include '../partials/_dbconnect.php';

// echo $_SESSION['student_email'];
$_SESSION['subjectTable'] = $_GET['subject'];
$_SESSION['chapter'] = $_GET['chapter'];
$_SESSION['subjectname'] = $_GET['subjectname'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <style>
        .empty_display {
            width: 100%;
            min-height: 80vh;
            background-color: #f4f6f8;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .empty_display span {
            color: #c5c6c7;
        }

        .note_display {
            width: 100%;
            height: 80vh;
            background-color: #fffdda;
            padding: 1em;
            overflow-y: scroll;
        }
    </style>
</head>

<body>

    <div class="container my-5">

        <?php include './_createNote.php' ?>
        <?php include './_updateNote.php' ?>

        <div class="head my-2">
            <?php echo "
            <h3>$_SESSION[subjectname]</h3>
            <h4>$_SESSION[chapter]</h4>
        " ?>
        </div>


        <?php

        $sql = "SELECT $_SESSION[chapter] from $_SESSION[subjectTable] WHERE byStudent = $_SESSION[rollno];";
        $result = mysqli_query($connect, $sql);
        $numExistusers = mysqli_num_rows($result);

        if($numExistusers >0){
        while ($row = mysqli_fetch_assoc($result)) {

            if ($row[$_SESSION['chapter']] !== "") {
                $note = $row[$_SESSION['chapter']];

                echo "
                <button class='btn btn-l btn-info my-2' id='editNote-btn'>Edit<i class='bi bi-plus-lg'></i></button>
                    <div class='note_display' id='note_display'>
                    $note
                    </div>

                    ";
            } else {
                echo "
                    <div class='empty_display my-3'>
                    <span>No notes to display</span>
                    <button class='btn btn-l btn-warning my-2' id='createNote-btn'>Create Notes<i class='bi bi-plus-lg'></i></button>
                </div>
                    ";
            }
        }
    }
    else {
        echo "
            <div class='empty_display my-3'>
            <span>No notes to display</span>
            <button class='btn btn-l btn-warning my-2' id='createNote-btn'>Create Notes<i class='bi bi-plus-lg'></i></button>
        </div>
            ";
    }
        ?>


    </div>











    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


    <!-- Jquery CDn  -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- TinyMCE CDn  -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>



    <script>
        //Add Student Modal handler
        const create_note = document.getElementById('createNote-btn');

        create_note.addEventListener("click", (e) => {
            e.preventDefault()
            $('#createNote').modal('toggle')
        })






        tinymce.init({
            selector: 'textarea#createNote-textarea',
            height: 500,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>

    <script>
        let edit_note = document.getElementById('editNote-btn');
        let note = document.getElementById('note_display').innerHTML
        edit_note.addEventListener("click", (e) => {

            e.preventDefault()

            document.getElementById("updateNote-textarea").value = note
            console.log(document.getElementById("updateNote-textarea").value + 'gdfdgf')
            $('#editNote').modal('toggle')
        })

       

        tinymce.init({
            selector: 'textarea#updateNote-textarea',
            setup: function(editor) {
                editor.on('init', function(e) {
                    editor.setContent(`${note}`);
                });
            },
            height: 500,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
</body>

</html>