<?php

include "config/conn_config.php";

//write query
$sql = 'SELECT id, first_name, last_name, email, phone, created_at, type FROM admissions';
//make query
$result = mysqli_query($conn, $sql);

//fetch the resulting rows as an array
$names = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);
// print_r($names);
?>
<?php include "templates/header.php"; ?>

<div class="row m-3">
    <?php foreach ($names as $name) { ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body bg-light">
                    <h5 class="card-title"> <?php echo "$name[first_name] $name[last_name]"; ?></h5>
                    <p class="card-text">
                        <ul>
                            <li>
                                Email: <?php echo "$name[email]"; ?>
                            </li>
                            <li>Type:
                            </li>
                            <ul style="list-style-type:circle;">
                                <?php foreach (explode(",", "$name[type]") as $dance) { ?>
                                    <li>
                                        <?php echo $dance; ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </ul>
                    </p>
                    <a href="details.php?id=<?php echo $name["id"];?>" class="btn btn-primary">Click to see details</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
        <?php include "templates/footer.php"; ?>