<?php
    session_start();
    include("connection.php");
    if((!isset($_SESSION['userid'])) || ($_SESSION['role']!='ADMIN')  ){
      header("location:login.php");
      die();
    }
    $sql="SELECT * FROM chat
        INNER JOIN user ON user.id=chat.user_id
        ORDER BY chat.date DESC";
    $messages=mysqli_query($con,$sql);
   
    if(!$messages){
        echo "Error: " . mysqli_error($con);
        die();
    }
   
       

?>

<!DOCETYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>All Messages</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="style.css">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
        </script>
        <script src='https://code.jquery.com/jquery-3.6.4.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>


    </head>



    <body>
        <?php
          require("admin_navbar.php");
      ?>

        <section id="page-header">
            <h2>All Messages</h2>
        </section>



        <section id="cart-add" class="section-p1">
            <div class="subtotal">
                <h3>Message Leavers</h3>
                <table class="cart-total1" id="message-leavers">
                    <tr>
                        <td><strong>Email</strong></td>
                        <td><strong>Date</strong></td>
                    </tr>

                    <?php
                        while($row=mysqli_fetch_assoc($messages)){         
                    ?>
                    <tr <?php if($row['seen']==0) echo  "style='background-color:#ff5f5f;' " ?>
                            onclick="viewMessage(<?php echo $row['message_id'] ?> ,this)";
                    >
                        <td><?php echo $row['email'] ?> </td>
                        <td><?php echo $row['date'] ?> </td>
                    </tr>
                    <?php 
                        }
                    ?>
                </table>
            </div>
            <?php
                $sql="SELECT * FROM chat
                INNER JOIN user ON user.id=chat.user_id
                ORDER BY chat.date DESC LIMIT 1";
                $messages=mysqli_query($con,$sql);

                if(!$messages){
                    echo "Error: " . mysqli_error($con);
                    die();
                }
                $firstMessage=mysqli_fetch_assoc($messages);

            ?>
            
            <div class="details" id="message">
                <form name="RegForm" action="">
                    <h3>Message</h3>
                    <input type="text" name="name" placeholder="Your Name" readonly
                        value="<?php echo $firstMessage['name']; ?>">
                    <input type="text" name="surname" placeholder="Your Surname" readonly
                        value="<?php  echo $firstMessage['surname']; ?>">
                    <input type="text" name="email" placeholder="Email" readonly
                        value="<?php  echo $firstMessage['email']; ?>">
                    <input type="text" name="subject" placeholder="subject" readonly
                        value="<?php  echo $firstMessage['subject']; ?>">
                    <textarea name="message" id="" cols="30" rows="10" placeholder="Your message"
                        readonly><?php  echo "Sent on: " .$firstMessage['date'] ."\n\n". $firstMessage['message']   ?></textarea>
                </form>
            </div>


        </section>








        <?php
            include("footer.php");
        ?>
        <script src="message.js"></script>
    </body>