<?php 
$conn = mysqli_connect('localhost', 'prabh', 'prabh123', 'super_dizzy');
if ($conn) {
    // echo "Database connected.";
} else {
    echo "Connection to database error." . mysqli_connect_error();
}

?>