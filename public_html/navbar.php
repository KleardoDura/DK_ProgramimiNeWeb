<section id="header">
    <a href='#'><img src="img/logo.jpg " class="logo"  alt=" " style="width:90px; height: 36px; border-radius: 13px;"></a>
    <div>
         <ul id="navbar">
			<li><a href="index.php">Home</a></li>
			<li><a href="shop.php">Shop</a></li>
               
             <?php
               if(isset($_SESSION['userid']))
                    echo "<li><a href='myaccount.php'>MyAccount</a></li>";
               else {
                    echo "<li><a href='login.php'>LogIn</a></li>";
                    echo "<li><a href='signup.php'>SignUp</a></li>";
               }
             ?>
                      
             <li><a href="contact.php">Contact</a></li>
             <li id="lg-bag"><a  href="cart.php"><i class="far fa-shopping-bag"><span>0</span></i></a></li>
			     <a href="#" id="close"><i class="far fa-times"></i></a>
         </ul>
    </div>
    <div id="mobile">
		<a href="cart.php"><i id="shopping-bag" class="far fa-shopping-bag  mobile-shopping-bag"><span>0</span></i></a>
		<i id="bar" class="fas fa-outdent"></i>
    </div>
    
 </section>