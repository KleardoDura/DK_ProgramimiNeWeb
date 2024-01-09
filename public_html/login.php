<?php
 require("connection.php");
 session_start();
 if(isset($_SESSION['userid'])){
    if(isset($_SESSION['role']) && $_SESSION['role']=='USER'){
        header("location:index.php");
        die();
    }
    else if(isset($_SESSION['role']) && $_SESSION['role']=='ADMIN'){
        header("location:admin.php");
        die();
    }
 }
   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="jstyle.css">
    <script src="jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <?php
		require("navbar.php");
        if(isset($_POST['login'])){
            if(empty($_POST["email"])){
                echo "<script>Swal.fire({
                    icon: 'info',
                    title: '',
                    text:'Email required'
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
            if( isset($_POST["email"]) && !empty($_POST["email"]) && preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST['email']) &&
                isset($_POST["password"]) && !empty($_POST["password"]) && preg_match('/^(?=.*[A-Za-z]{6,})(?=.*\d)[A-Za-z\d]+$/', $_POST['password'])){

                $email=$_POST["email"];
                $password=$_POST["password"];

                $checkEmailQuery="SELECT * FROM user
                    INNER JOIN role ON user.role_relate=role.role_id
                 WHERE email='$email'"; 
                $result1=mysqli_query($con,$checkEmailQuery);
                if(mysqli_num_rows($result1)==0){
                    echo "<script> Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'User with email:".$email." is not registered.'
                    });</script>";
                }
                else{
                    $row = mysqli_fetch_assoc($result1);
                    $verify = password_verify( $password, $row['password']); 
                    if($verify){
                        $_SESSION['userid']=$row['id'];
                        $_SESSION['name']=$row['name'];
                        $_SESSION['surname']=$row['surname'];
                        $_SESSION['email']=$row['email'];
                        $_SESSION['role']=$row['role'];
                        $_SESSION['points']=$row['points'];

                        $userId=(int) $row['id'];
                        $sql="SELECT * FROM cart WHERE user_id=$userId";
                        $result=mysqli_query($con,$sql);
                        $noOfRows=mysqli_num_rows($result);
                        if(($_SESSION['role']=='USER')){
                            if($noOfRows> 0){
                                echo '<script>
                                Swal.fire({
                                    title: "Are you sure?",
                                    text: "Do you want to keep the old cart?",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Yes, keep it!"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        updateLocalStroage();
                                    }
                                    window.location.href="index.php";
                                });
                            </script>';
                            //header("location:index.php");
                            }else header("location:index.php");
                        }
                        else if($_SESSION['role']=='ADMIN')
                            header("location:admin.php");

                    }else {
                        echo "<script> Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Incorrect password!'
                        });</script>";
                    }
                }
            }
        }
	?>

    <!--login form-->
    <div class="jcontainer">
        <div class="wrapper">
            <header>Login</header>
            <form id="loginForm" action="" method="post">
                <div class="field email">
                    <div class="input-area">
                        <input type="text" id="email" name="email" placeholder="Email Address"
                            value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                        <span class="error error-email" id="error-email"></span>
                    </div>
                </div>
                <div class="field password">
                    <div class="input-area">
                        <input type="password" id="password" name="password" placeholder="Password"
                            value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
                        <span class="error error-password"></span>
                    </div>
                </div>
                <input type="submit" name="login" value="Login">
            </form>
            <div class="sign-txt">Not yet a member? <a href="signup.php">Sign up</a></div>
        </div>
    </div>



    <?php
		include("footer.php");
	?>
    <script src="main.js"></script>
    <script>
    function updateLocalStroage() {
        //SHTO PRODUKTE NE DB
        $.ajax({
            type: "POST",
            url: "processing_data/get_cart.php",
            success: function(response) {

                console.log(response);
                console.log(JSON.parse(response));
                //localStorage.setItem("productsInCart", response);
                //
                let productNumbers = 0;
                let total = 0;
                let cartItems;
                response = JSON.parse(response);
                for (let key in response) {

                    if (response.hasOwnProperty(key)) {
                        let product = response[key];

                        product.inCart = parseInt(product.inCart);


                        if (cartItems != undefined) {
                            cartItems = {
                                ...cartItems,
                                [product.tag]: product
                            }
                        } else {
                            cartItems = {
                                [product.tag]: product
                            }
                        }

                        console.log(product);
                        productNumbers += parseInt(product.inCart);
                        total += (parseInt(product.inCart) * parseInt(product.price));
                    }
                }

                console.log(cartItems);
                localStorage.setItem('cartNumbers', parseInt(productNumbers));
                document.querySelector('.fa-shopping-bag span').textContent = productNumbers;
                document.querySelector('.mobile-shopping-bag span').textContent = productNumbers;

                localStorage.setItem('totalCost', parseInt(total));
                localStorage.setItem("productsInCart", JSON.stringify(cartItems));


            },
            error: function(err) {
                console.log(err);
            }
        });
    }
    </script>
</body>

</html>