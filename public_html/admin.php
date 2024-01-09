<?php
  session_start();
  include("connection.php");
  if((!isset($_SESSION['userid'])) || ($_SESSION['role']!='ADMIN')  ){
    header("location:login.php");
    die();
  }
  $sql="SELECT * FROM user INNER JOIN role ON user.role_relate=role.role_id
   WHERE role='USER' ORDER BY points DESC";
  $users=mysqli_query($con,$sql);

  if(!$users){
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
    <title>Admin</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
    </script>
    <script type="text/javascript">
      (function () {
        emailjs.init("aHxlyyt3xBnTZ_q4O");
      })();
    </script>
    
  </head>



  <body>
      <?php
          require("admin_navbar.php");
      ?>

    <section id="page-header">

      <h2>#Welcome Admin</h2>
      <p>Users List</p>
    
    </section>



    <section id="cart" class="section-p1">
      <table width="100%">
        <thead>
          <tr>
            <td>Name</td>
            <td>Surname</td>
            <td>Email</td>
            <td>Total Points</td>
          </tr>
        </thead>
        <tbody class="products">
          <tr>
            <?php
              while($row=mysqli_fetch_assoc($users)){
            ?>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['surname'];?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['points']; ?></td>

               </tr>
            <?php    
              } 

            ?>
        </tbody>

      </table>

     </br>
     </br>   
    </section>



    
      
        <!-- Trigger/Open The Modal -->
     




    <?php
      include("footer.php");
    ?>





    <script>
      const bar = document.getElementById('bar');
      const close = document.getElementById('close');
      const nav = document.getElementById('navbar');
      const shoppingBag = document.getElementById('shopping-bag');
      if (bar) {
        bar.addEventListener('click', () => {
          nav.classList.add('active');
          shoppingBag.classList.add('active');
        })
      }
      if (close) {
        close.addEventListener('click', () => {
          nav.classList.remove('active');
          shoppingBag.classList.remove('active');
        })
      }






    </script>
  
  </body>



  </html>