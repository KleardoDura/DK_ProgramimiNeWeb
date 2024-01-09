<?php
    
if (isset($_POST['signup'])) {
    if(empty($_POST["name"])){
          echo "<script>Swal.fire({
            icon: 'info',
            title: '',
            text: 'Name required'
        });</script>";
    }
    else if(empty($_POST["surname"])){
          echo "<script>Swal.fire({
            icon: 'info',
            title: '',
            text: 'Surname required'
        });</script>";
    }
    else if(empty($_POST["email"])){
        echo "<script>Swal.fire({
            icon: 'info',
            title: '',
            text: 'Enter a valid email'
        });</script>";
    }
    else if(!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST['email'])){
          echo "<script>Swal.fire({
            icon: 'info',
            title: '',
            text: 'Enter a valid email'
        });</script>";
    }
    else if(!preg_match('/^(?=.*[A-Za-z]{6,})(?=.*\d)[A-Za-z\d]+$/', $_POST['password'])){
          echo "<script>Swal.fire({
            icon: 'info',
            title: '',
            text: 'Password must contain at least 6 characters and include at least 1 number.'
        });</script>";
    }
    else if(empty($_POST["confirm-password"])){
          echo "<script>Swal.fire({
            icon: 'info',
            title: '',
            text: 'Confirm password required'
        });</script>";
    }
    else if($_POST["confirm-password"]!=$_POST["password"]){
          echo "<script>Swal.fire({
            icon: 'info',
            title: '',
            text: 'Passwords do not match'
        });</script>";
    }
    if(isset($_POST["name"]) && !empty($_POST["name"]) && 
        isset($_POST["surname"]) && !empty($_POST["surname"]) && 
        isset($_POST["email"]) && !empty($_POST["email"]) && preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST['email']) &&
        isset($_POST["password"]) && !empty($_POST["password"]) && preg_match('/^(?=.*[A-Za-z]{6,})(?=.*\d)[A-Za-z\d]+$/', $_POST['password']) &&
        isset($_POST["confirm-password"]) && !empty($_POST["confirm-password"]) && ($_POST['password'] == $_POST['confirm-password']) ){

        $name=$_POST["name"];
        $surname=$_POST["surname"];
        $email=$_POST["email"];
        $password= password_hash($_POST["password"], PASSWORD_DEFAULT);
        
        echo("fd");

        $checkEmailQuery="SELECT * FROM user WHERE email='$email'";
        $result1=mysqli_query($con,$checkEmailQuery);
        if(mysqli_num_rows($result1)!=0){
            echo "<script> Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'User with email:".$email." is already registered. Please use a different email address.'
              });</script>";
              $_POST=array();
        }else{
            $insertUser="INSERT INTO user (name,surname,email,password,points,role_relate) VALUES ('$name','$surname','$email','$password',0,1)";
            $result2=mysqli_query($con,$insertUser);
            if($result2){
                echo "<script> Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'User successfully registered!'
                  }).then(function() {
                    window.location.href = 'signup.php';
                    });</script>";
                  $_POST=array();
            }else{
                echo "<script> Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Server error,please try again later'
                  });</script>";
            }

        } 
    }
}
?>