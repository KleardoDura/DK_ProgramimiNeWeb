<?php
//WE CHECK IF THE USER IS LOGEDIN AND HAVE BOUGHT THIS PRODUCT PREVIOUS
    session_start();
    require("../connection.php");
    if(isset($_SESSION['userid'])){
        $productId=(int) $_POST['id'];
        $userId=(int) $_SESSION['userid'];
        $sql="SELECT * FROM purchase WHERE user_id=$userId AND product_id=$productId";
        $result=mysqli_query($con,$sql);
        if ($result) {
            $rowCount = mysqli_num_rows($result);
            if($rowCount> 0){
                $user = array(
                    'userid' => $_SESSION['userid'],
                    'name' => $_SESSION['name'],
                    'surname' => $_SESSION['surname'],
                    'email' => $_SESSION['email']
                );
                echo json_encode($user);
            }
            else echo  json_encode(false);
        }
        else echo  json_encode(false);


    }   
    else echo  json_encode(false);
?>