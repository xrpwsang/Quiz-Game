<?php
    $conn = mysqli_connect('localhost', 'root', '', 'quiz_database');

    if (!$conn) {
        echo "Connection failed: " . mysqli_connect_error();
    } 

?>
