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
		</span> 
	   </div>

	    <div id="products_box">
		<br>
	    <form action="" method="post" enctype="multipart/form-data">
		 <table align="center" width="700" bgcolor="lightblue" >
		   <tr align="center">
		    <td colspan="5"><h2>Update your cart or checkout</h2></td>
		   </tr>
		   <tr align="center">
		     <th>Remove</th>
			 <th>Product(S)</th>
			 <th>Quantity</th>
			 <th>Total Price</th>
		   </tr>
		   <?php 
		     $total = 0;
	         global $con;
	         $ip = getIp();
	         $sel_price = "select * from cart where ip_add='$ip'";
	         $run_price = mysqli_query($con,$sel_price);
	 
	     while($p_price = mysqli_fetch_array($run_price)){
		 
		 $pro_id = $p_price['p_id'];
		 $pro_price = "select * from products where product_id='$pro_id'";
		 $run_pro_price = mysqli_query($con,$pro_price);
		 
		  while($pp_price = mysqli_fetch_array($run_pro_price)){
			  $product_price = array($pp_price['product_price']);
			  $product_title = $pp_price['product_title'];
			  $product_image = $pp_price['product_image'];
			  $single_price = $pp_price['product_price'];
			 // $remove_id = $pp_price['product_id'];
			 $values = array_sum($product_price);
		     $total += $values;
	 
	 echo "$" . $total;
		   ?>
		   <tr align="center">
		    <td><input type="checkbox" name="remove" value="<?phpecho $pro_id?>"/></td>
			<td><?php echo $product_title;?><br>
			<img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60" />
			</td>
			<td><input type="text" size="3" name="qty" value="
			<?php //echo $_SESSION['qty']; ?>"></td>
			<?php
			   if(isset($_POST['update_cart'])){
				   $qty = $_POST['qty'];
				   $update_qty = "update cart set qty='$qty'";
				   $run_qty = mysqli_query($con,$update_qty);
				   
				   $_SESSION['qty'] = $qty;
				   $total = $total * (int)$qty;
			   }
			?>
			<td><?php echo "$" . $single_price;?></td>
		   </tr>
		   
		   <?php }}?>
		   <tr align="right">
		     <td colspan="4"><b>Sub Total</b></td>
			 <td colspan="4"><?php echo "$" . $total;?></td>
		   </tr>
		   
		   <tr>  
		    <td colspan="2"><input type="submit" name="update_cart" value="Update cart"></td>
			<td><input type="submit" name="continue" value="Continue"></td>
			<td><a href="checkout.php" style="text-decoration:none; color:black;">Checkout</a></td>
		   </tr>
		 </table>
        </form>		
		
		<?php
		
		      global $con;
			  $ip = getIp();
	          $products = "select * from cart where ip_add='$ip'";
			  $run_products = mysqli_query($con,$products);
			  $row_products = mysqli_fetch_array($run_products);
			  $remove_id = $row_products['p_id'];
		     if(isset($_POST['update_cart']) AND isset($_POST['remove'])){ 			 
				$delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
                $run_delete = mysqli_query($con,$delete_product);	
                 if($run_delete){ 
				 echo"<script>window.open('cart.php','_self')</script>";
				}
			  
		  }
		  
		?>
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