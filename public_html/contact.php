<?php
    session_start();
?>

<!DOCETYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Contact</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="style.css">
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    </head>

    <body>
        <?php
		require("navbar.php");
	?>

        <section id="page-header">

            <h2>#let's talk</h2>
            <p>Leave a message</p>
        </section>

        <section id="contact-details" class="section-p1">
            <div class="details">
                <span>GET IN TOUCH</span>
                <h2>Contact us today</h2>
                <h3>Head Office</h3>

                <li>
                    <i class="fal fa-map"></i>
                    <p>Sheshi Nënë Tereza 4, Tiranë</p>
                </li>
                <li>
                    <i class="far fa-envelope"></i>
                    <p>fti@fti.com</p>
                </li>
                <li>
                    <i class="fas fa-phone-alt"></i>
                    <p>(+355) 69 99 99 999</p>
                </li>
                <li>
                    <i class="far fa-clock"></i>
                    <p>Mondey to Saturday: 8.00am to 21.00pm</p>
                </li>
            </div>
            <div class="map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2996.6616679596646!2d19.8191297751883!3d41.316223300407714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x135030e26036f881%3A0xdf5dc3ad387e1db5!2sFTI%20-%20Fakulteti%20i%20Teknologjis%C3%AB%20s%C3%AB%20Informacionit!5e0!3m2!1sen!2s!4v1701285779436!5m2!1sen!2s"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>
        </section>


        <section id="form-details">
            <?php
                	if(isset($_SESSION['userid']) && ($_SESSION['role'] == 'USER' ) ){
                        $name=$_SESSION['name'];
                        $email=$_SESSION['email'];
                        echo "
                        <form action='#'  method='POST'>
                        <span>LEAVE A MESSAGE</span>
                        <h2>We love to hear from you</h2>
                        <input type='text' placeholder='Your Name' name='name' value='$name' readonly>
                        <input type='text' placeholder='Email' name='email' value='$email' readonly>
                        <input type='text' placeholder='Subject' name='subject'>
                        <textarea name='message' id='' cols='30' rows='10' placeholder='Your Message' required></textarea>
                        <button class='normal' name='addmessage'>Submit</button>
                    </form>
                        ";
                    }else  echo "<form>
                    <h2 style='padding-top:100px'>...Please login to access</br> the 'LEAVE A MESSAGE' section...</h2>
                    </form>
                    ";
            ?>


            <div class="people">
                <div>
                    <img src="img/people/kleardo.png" alt="">
                    <p><span>Kleardo Dura</span>Chief Executive Officer<br>
                        Phone: +0011011111<br>kleardo.dura@fti.edu.al</p>
                </div>
                <div>
                    <img src="img/people/joni.jpeg" alt="">
                    <p><span>Erjon Zyka</span>Chief Operating Officer<br>
                        Phone: +0011011111<br>erjon.zyka@fti.edu.al</p>
                </div>
                <div>
                    <img src="img/people/endri.jpeg" alt="">
                    <p><span>Endri Gjini</span>Chief Financial Officer<br>
                        Phone: +0011011111<br>endri.gjini@fti.edu.al</p>
                </div>
                <div>
                    <img src="img/people/aldini.jpeg" alt="">
                    <p><span>Aldin Xhaxhamani</span>Chief Information Officer<br>
                        Phone: +0011011111<br>aldin.xhaxhamani@fti.edu.al</p>
                </div>
            </div>


        </section>







        <?php
    	include("newsletter.php");
		include("footer.php");
	?>
        <script src="main.js"></script>
    </body>

    <?php 

	if(isset($_SESSION['userid']) && ($_SESSION['role'] == 'USER' ) ){
	require("connection.php");


	print_r($_POST);
	if(isset($_POST['addmessage']) && !empty($_POST['message'])){
		$userId=$_SESSION['userid'];
		$date=date("Y-m-d H:i:s");
        if(isset($_POST['subject'])) $subject=$_POST['subject'];
        else $subject=" ";
		$message=$_POST['message'];
		$sql="INSERT INTO chat (user_id,admin_id,sender,subject,message,seen,date) VALUES($userId,4,'USER','$subject','$message',0,'$date')";
		$result=mysqli_query($con,$sql);
		if(!$result){
			echo "Error: " . mysqli_error($con);
			die();
		}else{
			//echo "<script>window.location.href='contact.php' </script>";
            echo "    
            <script> Swal.fire({
            icon: 'success',
            title: 'Your message has been sent',
            showConfirmButton: false,
            timer: 2500
            }).then(function() {
            window.location.href = 'contact.php';
            });</script>";
		}
	}

}
?>

    </html>