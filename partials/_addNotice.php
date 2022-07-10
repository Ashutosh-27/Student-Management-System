<?php




include '_dbconnect.php';

$inserted = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    $notice_title = $_POST['notice_title'];
    $notice_about = $_POST['notice_about'];
    $notice_descp = $_POST['notice_descp'];
    $notice_from = $_SESSION['name'];



    $sql = "INSERT INTO `notice` (`title`, `from_a`, `about`, `descp`) VALUES ( '$notice_title', '$notice_from', '$notice_about', '$notice_descp');";

    $result = mysqli_query($connect, $sql);
    $inserted = true;

    if ($result) {
        if ($_SESSION['code'] == '23F7') {
            header("location:../admin.php?noticeadded=true");
        } else {
            header("location:../teachers.php?noticeadded=true");
        }
    } else {
        if ($_SESSION['code'] == '23F7') {
            header("location:../admin.php?noticeadded=false");
        } else {
            header("location:../teachers.php?noticeadded=false");
        }
    }
}
?>



<!-- Add Student Modal -->
<div class="modal fade" id="addNotice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="create_form" method="POST" action="partials/_addNotice.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">title</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp" id="notice_title" name="notice_title">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">About</label>
                        <input type="text" class="form-control" " aria-describedby=" emailHelp" id="notice_about" name="notice_about">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" id="notice_descp" name="notice_descp" rows="3"></textarea>
                    </div>




                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>