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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="jstyle.css">
</head>

<body>
    <?php
		require("navbar.php");
	?>

    <div class="jcontainer">
        <div class="wrapper">
            <header>Sign Up</header>
            <form  action="" method="POST" id="loginForm">
                <div class="field name">
                    <label for="name">Name</label>
                    <div class="input-area">
                        <input type="text" name="name" id="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
                        <span class="error error-name">
                        </span>
                    </div>
                </div>
                <div class="field surname">
                    <label for="surname">Surname</label>
                    <div class="input-area">
                        <input type="text" id="surname" name="surname" value="<?php echo isset($_POST['surname']) ? $_POST['surname'] : ''; ?>">
                        <span class="error error-surname">
                        </span>
                    </div>
                </div>
                <div class="field email">
                    <label for="email">Email</label>
                    <div class="input-area">
                        <input type="text" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                        <span class="error error-email">
                        </span>
                    </div>
                </div>
                <div class="field password">
                    <label for="password">Password</label>
                    <div class="input-area">
                        <input type="password" id="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
                        <span class="error error-password">
                        </span>
                    </div>
                </div>
                <div class="field confirm-password">
                    <label for="confirm-password">Confirm Password</label>
                    <div class="input-area">
                        <input type="password" id="confirm-password" name="confirm-password" value="<?php echo isset($_POST['confirm-password']) ? $_POST['confirm-password'] : ''; ?>">
                        <span class="error error-confirm-password">
                        </span>
                    </div>
                </div>
                <input type="submit" name="signup" value="Sign Up">
            </form>
            <a href="login.php" class="sign-txt">Go back to Login page</a>
        </div>
    </div>


    <?php
		include("footer.php");
	?>
    <script src="main.js"></script>
</body>

<?php
        require("signup_senddata.php");
    ?>
</html>