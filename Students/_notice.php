<?php

include '../partials/_dbconnect.php';
$id = $_GET['id'];


$sql = "SELECT * FROM notice WHERE id='$id'";
$result = mysqli_query($connect, $sql);



while ($row = mysqli_fetch_assoc($result)) {
    $title = $row['title'];
    $by = $row['from_a'];
    $about = $row['about'];
    $dt = $row['date_time'];
    $description = $row['descp'];
    
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
        <h3>$title</h3>
        
        <div class='Dates'>
            <div class='assigned'>
                <span>Assigned Date :
                </span>
                <br>
                <span>$dt</span>
            </div>
           
        </div>
        <div class='file'><b>About : </b>$about</div>
        <div class='description'>$description</div>
        <div class='footer'><div><b>Notice by -</b><br>$by</div></div>
        ";
        ?>
      
    </div>




    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>