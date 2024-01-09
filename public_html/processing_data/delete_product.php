<?php
    session_start();
    require("../connection.php");
    $productId=$_POST['productId'];
    $sql="DELETE FROM product where id=$productId";
    $result=mysqli_query($con,$sql);
    if($result){
        echo  json_encode(true);
    }else echo  json_encode(false);
?>  