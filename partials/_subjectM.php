<?php
include '_dbconnect.php';



$sql = "SELECT * FROM `subjectmaterials` WHERE Subject_name='$_SESSION[subject]';";

$result = mysqli_query($connect, $sql);

$subject_chapters = array("chapter1", "chapter2", "chapter3", "chapter4", "chapter5", "chapter6");

?>


<style>
    table {
        border: 1px solid;
        margin: auto;
        width: 100%;
        padding: 10px;
    }
    tr{
        border: 1px solid black;
    }
    th,td{
        border: 1px solid;
        padding: 1em;
    }
    a{
        color: white;
        text-decoration: none;
    }
</style>


<table >
    <tr>
        <th>Chapter</th>
        <th>ChapName</th>
        <th>file</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($subject_chapters as $chapter) {
            $current = json_decode($row["$chapter"]);
            if ($current != null) {
                if($current->chap_name !== 'none'){
                echo " 
                <tr>
                    <td>$chapter</td>
                    <td>$current->chap_name</td>
                    <td><a target='_blank' href='./subject_materials/syllabus.pdf'><button class='btn btn-primary'>ViewFile</button></a></td>
                </tr>";
                }
                else{
                    null;
                }
            }
        }
    }
    ?>

</table>