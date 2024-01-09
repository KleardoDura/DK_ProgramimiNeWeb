<?php
    session_start();
    require("../connection.php");
    if(isset($_SESSION['userid'])){
        $newPoints=$_POST['newPoints'];
		$newPoints=intval($newPoints);
		$newPoints=$newPoints/10;
        $userId=$_SESSION['userid'];

        $sql="SELECT * FROM user WHERE id=$userId";
        $result=mysqli_query($con,$sql);
        if(!$result){
            echo "Error: " . mysqli_error($con);
            die();
        }
        $row=mysqli_fetch_assoc($result);
        $points=(int)$row['points'];

        $newPoints=$newPoints+$points;
        echo $newPoints;
        $sql="UPDATE user SET points=$newPoints WHERE id=$userId";
        $result=mysqli_query($con,$sql);
        if(!$result){
            echo "Error: " . mysqli_error($con);
            die();
        }
    }
?>  