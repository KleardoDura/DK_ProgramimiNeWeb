<?php
    session_start();
    require("../connection.php");
    $messageId = $_POST['messageId'];

    $sql = "SELECT * FROM chat
            INNER JOIN user ON user.id = chat.user_id
            WHERE message_id = $messageId";
    $result = mysqli_query($con, $sql);
    
    if ($result) {
        $message = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $message[] = $row;
        }
        echo json_encode($message);
    } else {
        echo json_encode(false);
    }
?>
