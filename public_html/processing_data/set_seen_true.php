<?php
    session_start();
    require("../connection.php");
    $messageId = $_POST['messageId'];


    $sql="UPDATE chat SET seen=1 WHERE message_id=$messageId";
    $result = mysqli_query($con, $sql);
    
    if (!$result) {
        echo json_encode(false);
    }
?>
