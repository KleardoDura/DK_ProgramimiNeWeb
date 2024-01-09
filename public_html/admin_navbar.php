<section id="header">
    <a href='#'><img src="img/logo.jpg " class="logo"  alt=" " style="width:90px; height: 36px; border-radius: 13px;"></a>
    <div>
         <ul id="navbar">
            
            <li><a href="admin.php">Home</a></li>
			<li><a href="addproduct.php">AddProduct</a></li>
			<li><a href="allproducts.php">Products</a></li>
               <li><a href="messages.php">Messages</a></li>
             <?php
               if(isset($_SESSION['userid']) && ($_SESSION['role'] =='ADMIN' ) )
                    echo "<li><a href='myaccount.php'>MyAccount</a></li>";
               else {
                    echo "<li><a href='login.php'>LogIn</a></li>";
               }
             ?>
                      
             <a href="#" id="close"><i class="far fa-times"></i></a>
         </ul>
    </div>
    <div id="mobile">
		<i id="bar" class="fas fa-outdent"></i>
    </div>
    
 </section>