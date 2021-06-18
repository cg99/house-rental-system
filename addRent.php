<?php
require_once('connect.php');

if (isset($_POST) & !empty($_POST)) {
    $user_id = ($_POST['uid']);
    $house_id = ($_POST['hid']);

    // Execute query
    $query = "INSERT INTO `records` (user_id, house_id) VALUES ('$user_id', '$house_id')";
    $res = mysqli_query($connection, $query);
    if ($res) {
        // header('location: index.php');
        echo 'House Rented Successfully';
    } else {
        echo 'Failed';
        // print_r($res);
    }
}
