<?php
session_start();

include '../partials/_dbconnect.php';



$subject_codes = array("os_notes" => 1, "st_notes" => 2, "wt_notes" => 3, "da_notes" => 4, "java_notes" => 5, "cc_notes" => 6);

$subject_chapters = array("chapter1", "chapter2", "chapter3", "chapter4", "chapter5", "chapter6");

$current_subject = $_GET['subject'];

$sql = "SELECT * FROM `subjectmaterials` WHERE subject_code=" . $subject_codes[$current_subject] . ";";
$result = mysqli_query($connect, $sql);


$subject_name = $current_subject;



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document <?php echo $_SESSION['username'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .chap_card {
            margin: 2em;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            padding: 20px;
            width: 28em;
            border-radius: 15px;
        }

        .chap_card-link,
        .chap_card-link:hover {
            color: black;
            text-decoration: none;
        }

        .chap_card-link h3 {
            letter-spacing: 0px;
            transition: .2s;
        }


        .chap_card-link:hover h3 {
            letter-spacing: 2px;
            transition: .2s;
        }
    </style>

</head>

<body>
    <div class="container my-5">
        <div class="section1">

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $subject_name = $row["Subject_name"];
                echo "
                    <div class='subject_name'>
                    <h2> $subject_name</h2>
                    </div>
                ";

                foreach ($subject_chapters as $chapter) {
                    $current = json_decode($row["$chapter"]);
                    if ($current != null) {
                        if ($current->chap_name !== 'none') {
                            echo "
                                <div class='chap_card'>
                                <a href='./_chapter.php?subject=$current_subject&chapter=$chapter&subjectname=$subject_name' class='chap_card-link'>
                                <h4>$chapter :</h4> 
                                <h3>$current->chap_name</h3>
                                </a>
                                </div>
                            ";
                        } else {
                            null;
                        }
                    }
                }
            }
            ?>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>


</html>