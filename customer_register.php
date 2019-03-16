<!DOCTYPE html>
<?php 
      session_start();
      include("functions/functions.php");
      include("includes/db.php");
 ?>
<html>
  <head>
   <title>My online shop</title>
   <link rel="stylesheet" href="style/style.css" >
  </head>
  
  <body>
   <?php echo getIp(); ?>
    <div class="main_wrapper"> 
	   <div class="header_wrapper">
	    <img id="cover_top" src="images/imageCover.jpg" >
		<div class="menubar">
		  <ul id="menu"> 
		     <li><a href="index.php">Home</a></li>
			 <li><a href="all_products.php">All products</a></li>
			 <li><a href="customer/my_account.php">My Account</a></li>
			 <li><a href="#">Sign up</a></li>
			 <li><a href="#">Shopping Cart</a></li>
             <li><a href="#">Contact Us</a></li>
		  </ul>
         <div id="form">
		  <form method="GET" action="results.php" enctype="multipart/form-data">
		    <input type="text" name="user_query"/>
            <input type="submit" name="search" value="Search"/>			
          </form>		  
         </div>		 
		</div>
	   </div>
	</div>
	
	<div class="content_wrapper"> 
	  <div id="sidebar"> 
          <div id="sidebar_title" > Categories </div>
          <ul id="cats">
		  <?php getCats();?>
          </ul>		  
 	
	  <ul>
	    
          <div id="sidebar_title" > Brands </div>
          <ul id="cats">
		  <?php getBrands(); ?>
          </ul>		  
 	  </div>
	  </ul>
	  
	  <div id="content_area">
	  <?php cart(); ?>
	   <div id="shopping_cart">
	    <span style="float:right;font-size:18px;color:white;padding:5px;line-height:40px;" >Welcome Guest!
		<b style="color:yellow">Shopping cart-</b>
		Total items :<?php total_items(); ?> Total Price <?php total_price(); ?>
		<a href="cart.php">Go to cart</a>
		</span> 
	   </div>
   
        <form action="customer_register.php" method="post" enctype="multipart/form-data">
         <table align="center" width="750">
		   <tr>
		     <td><h2>Create an Account</h2></td>
		   </tr>
		   <tr>
		     <td align="right">Customer Name:</td>
			 <td><input type="text" name="c_name" required></td>
		   </tr>
		   <tr>
		     <td align="right">Customer Email:</td>
			 <td><input type="email" name="c_email" required></td>
		   </tr>
		   <tr>
		     <td align="right">Customer Password:</td>
			 <td><input type="password" name="c_pass" required></td>
		   </tr>
		   <tr>
		     <td align="right">Customer Image:</td>
			 <td><input type="file" name="c_image" ></td>
		   </tr>
		   <tr>
		     <td align="right">Customer Country:</td>
			 <td>
			  <select name="c_country" required>
			   <option>Select a Country</option>
			   <option>Romania</option>
			   <option>Spain</option>
			   <option>Italy</option>
			   <option>UK</option>
			   <option>India</option>
			   <option>France</option>
			  </select>
			 </td>
		   </tr>
		   <tr>
		     <td align="right">Customer City:</td>
			 <td><input type="text" name="c_city" required></td>
		   </tr>
		   <tr>
		     <td align="right">Customer Contact:</td>
			 <td><input type="text" name="c_contact" required></td>
		   </tr>
		   <tr>
		     <td align="right">Customer Address:</td>
			 <td><textarea cols="20" rows="10" name="c_address" required></textarea></td>
		   </tr>
		   <tr>
		     <td><input type="submit" name="register" value="Create Account"></td>
		   </tr>
		 </table>
        </form>		
	   
		</div>
	  </div>
	  	<div id="footer">
		 <h2 style="text-align:center;padding-top:30px;">
		 &copy:2014 by www.OnlineTuting.com </h2>
		 </h2>
		</div>
	</div>

  </body>
</html>
 
 <?php 
 
 if(isset($_POST['register'])){
	
		
		$ip = getIp();
		
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_pass'];
		$c_image = $_FILES['c_image']['name'];
		$c_image_tmp = $_FILES['c_image']['tmp_name'];
		$c_country = $_POST['c_country'];
		$c_city = $_POST['c_city'];
		$c_contact = $_POST['c_contact'];
		$c_address = $_POST['c_address'];
	
		
		move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");
		
		 $insert_c = "insert into customers (customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
	
		$run_c = mysqli_query($con, $insert_c); 
		
		$sel_cart = "select * from cart where ip_add='$ip'";
		
		$run_cart = mysqli_query($con,$sel_cart);
		
		$check_cart = mysqli_num_rows($run_cart);
		
		if($check_cart==0){
			$_SESSION['customer_email'] = $c_email;
			echo "<script>alert('Account has been created succcesful')</script>";
			echo "<script>window.open('customer/my_account.php','_self')</script>";
		}else
		{
			$_SESSION['customer_email'] = $c_email;
			echo "<script>alert('Account has been created succcesful')</script>";
			echo "<script>window.open('checkout.php','_self')</script>";
		}
 }
 
 ?>
 


