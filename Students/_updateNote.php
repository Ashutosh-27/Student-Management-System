<?php

include '../partials/_dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();
    $note = $_POST['updatedNote'];

    $sql = "UPDATE $_SESSION[subjectTable] SET $_SESSION[chapter] = '$note' WHERE byStudent = $_SESSION[rollno];";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        header("location: _chapter.php?subject=$_SESSION[subjectTable]&chapter=$_SESSION[chapter]&subjectname=$_SESSION[subjectname]");
    }
}

?>




<!-- Modal -->
<div class="modal fade" id="editNote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 80%;min-height:80vh">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form method="POST" action="./_updateNote.php">
                    <div class="mb-3 text_area-container" style="height: 60vh">
                        <label for="exampleFormControlTextarea1" class="form-label">Edit Note</label>

                        <textarea class="form-control textarea" id="updateNote-textarea" rows="3" style="height: 95%;overflow-y:scroll" name="updatedNote"></textarea>

                    </div>

                    <input type="submit" value="EditNote" name="editnote" class="btn btn-info my-4">
                </form>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


