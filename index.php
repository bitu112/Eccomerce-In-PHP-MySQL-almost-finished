<!DOCTYPE html>
<?php 
session_start();
include("functions/functions.php") ?>
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
		<?php 
		if(!isset($_SESSION['customer_email'])){
			echo "<a href='checkout.php' style='color:orange;'>Login</a>";
		}
		else {
			echo "<a href='logout.php'>Logout</a>";
		}
		
		?>
		</span> 
	   </div>

	    <div id="products_box">
		 <?php getPro(); ?>
		 <?php getCatPro(); ?>
		 <?php getBrandPro(); ?>
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