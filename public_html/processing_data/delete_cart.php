<?php
session_start();
if (isset($_SESSION['userid'])) {
    include("../connection.php");

    $userId = $_SESSION['userid'];

    $sql = "DELETE FROM cart WHERE user_id = $userId";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
} else {
    echo json_encode(false);
}
?>
