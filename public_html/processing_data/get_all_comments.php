<?php
    session_start();
    require("../connection.php");
    $productId=$_POST['productId'];

    $sql="SELECT *
        FROM comments
        INNER JOIN product ON comments.product_id = product.id
        INNER JOIN user ON comments.user_id = user.id 
        WHERE comments.product_id='$productId'
        ORDER BY comments.publish_date DESC";
    $result=mysqli_query($con,$sql);
    if ($result) {
        $comments = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $comments[] = $row;
        }

        echo json_encode($comments);
    } else {
        echo "Error retrieving comments";
    }	
?>