<?php
include '_dbconnect.php';



$sql = "SELECT * FROM `subjectmaterials`;";

$result = mysqli_query($connect, $sql);
$count = mysqli_num_rows($result);

$subject_chapters = array("chapter1", "chapter2", "chapter3", "chapter4", "chapter5", "chapter6");

?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<style>
    table {
        border: 1px solid;
        margin: auto;
        width: 100%;
        padding: 10px;
    }

    tr {
        border: 1px solid black;
    }

    th,
    td {
        border: 1px solid;
        padding: 1em;
    }

    a {
        color: white;
        text-decoration: none;
    }
    .card-collapse{
    background-color: rgb(255, 255, 255);
}
</style>


    <?php
    $n=1;
    echo"<div class='accordion' id='accordionExample'>";
    while ($row = mysqli_fetch_assoc($result)) {

        echo"
        <div class='card card-collapse'>
            <div class='card-header' id='heading$n'>
                <h2 class='mb-0'>
                    <button class='btn btn-link collapsed bt-collapse' type='button' data-toggle='collapse' data-target='#collapse$n' aria-expanded='false' aria-controls='collapse$n'>
                        $row[Subject_name]
                    </button>
                </h2>
            </div>
            <div id='collapse$n' class='collapse' aria-labelledby='heading$n' data-parent='#accordionExample'>
                <div class='card-body'>
                    <table>
                    ";


                foreach ($subject_chapters as $chapter) {
                    $current = json_decode($row["$chapter"]);
                    if ($current != null) {
                        if ($current->chap_name !== 'none') {
                            echo "  
                        <tr>
                            <td>$chapter</td>
                            <td>$current->chap_name</td>
                            <td><a target='_blank' href='./subject_materials/syllabus.pdf'><button class='btn btn-primary'>ViewFile</button></a></td>
                        </tr>";
                        } else {
                            null;
                        }
                    }
                }
            echo"
            </table>
            </div>
            </div>
            </div>
            ";
                $n = $n+1;
    }
    ?>

</table>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>