<?php
include "config/conn_config.php";
if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    //write the query 
    $sql = "DELETE FROM admissions WHERE id = $id_to_delete";
    //
    //make the query
    if (mysqli_query($conn, $sql)) {
        header("Location:out.php");
    } else {
        echo "there is an error:" . mysqli_error($conn);
    }
}

if (isset($_GET['id'])) {
    //to get rid of any malicious content input by user and storing the id
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //make query
    $sql = "SELECT * FROM admissions WHERE id = $id";
    // get the query result

    $result = mysqli_query($conn, $sql);
    //making array from the result
    $candidate_detail = mysqli_fetch_assoc($result);
    print_r($candidate_detail);
    mysqli_free_result($result);
    mysqli_close($conn);
}

?>



<?php include "templates/header.php"; ?>
<?php if ($candidate_detail) : ?>
    <div class="container">
        <div class="card my-3 text-center">

            <div class="card-body bg-light">
                <h5 class="card-title">
                    <?php echo "Candidate Name: $candidate_detail[first_name] $candidate_detail[last_name]"; ?>
                </h5>
                <div class="">
                    <p class="card-text"><?php echo "Email: $candidate_detail[email]"; ?></p>
                    <p class="card-text"><?php echo "Phone: $candidate_detail[phone]"; ?></p>
                    <p class="card-text"><?php echo "Type: $candidate_detail[type]"; ?></p>
                    <p class="card-text"><?php echo "Enrolled on: $candidate_detail[created_at]"; ?></p>
                    <a href="out.php" class="btn btn-primary">Go back</a>
                    <form action="details.php" method="POST">
                        <input type="hidden" name="id_to_delete" value="<?php echo $candidate_detail['id']; ?>">
                        <input type="submit" name= "delete" value="Delete" class="btn btn-danger mt-3">
                    </form>

                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="container my-3">
        <h3 class="text-center">
            No such candidate is registered!
        </h3>
    </div>

<?php endif; ?>







<?php include "templates/footer.php"; ?>