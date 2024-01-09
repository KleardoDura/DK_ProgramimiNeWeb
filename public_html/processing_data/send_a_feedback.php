<?php
    session_start();
    require("../connection.php");
    if(isset($_SESSION['userid'])){
        $rating = (float)$_POST['rating'];
        $comment=$_POST['comment'];
        $date=date("Y-m-d");
        $productId=$_POST['productId'];
        $userId=$_SESSION['userid'];
        $sql="INSERT INTO comments(comment,user_id,product_id,comment_rating,publish_date) VALUES ('$comment',$userId,$productId,$rating,'$date')";
        $result=mysqli_query($con,$sql);

        if(!$result){
            echo "Error: " . mysqli_error($con);
            die();
        }


        $sql="SELECT * FROM product WHERE id=$productId";
        $result=mysqli_query($con,$sql);
        if (!$result) {
            echo "Error: " . mysqli_error($con);
            die();
        }

        $row=mysqli_fetch_assoc($result);
        $noOfComments=(int)( $row['no_of_comments'] );
        $oldRating=(float)( $row['rating'] );
        $newRating=(( $noOfComments * $oldRating)+ $rating)/($noOfComments+1);
        $noOfComments=$noOfComments+1;
        $sql="UPDATE product SET rating= $newRating , no_of_comments= $noOfComments WHERE id=$productId";
        $result=mysqli_query($con,$sql);
        if (!$result) {
            echo "Error: " . mysqli_error($con);
            die();
        }
        
        
    }

?>