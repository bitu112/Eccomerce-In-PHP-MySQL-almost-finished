<!DOCTYPE html>
<?php include("includes/db.php");

?>
<html>
  <head>
   <title>Inserting Products </title>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
  </head>
  
 <body bgcolor="skyblue">  
   <form action="insert_product.php" method="post" enctype="multipart/form-data" >
     <table align="center" width="700px" border="2px" bgcolor="orange">
	  <tr align="center"> 
	   <td><h3>Insert new post here</h3></td>
	  </tr>
	  <tr>
	    <td align="center">Product Title:</td>
		<td><input type="text" name="product_title"/ required></td>
	  </tr>
	  <tr>
	    <td align="center">Product Category:</td>
		<td>
		<select name="product_cat" required>
		  <option> Select a category</option>
		  <?php 
		  $get_cats = "select * from categories";
	      $run_cats = mysqli_query($con,$get_cats);
	 
	      while($row_cats = mysqli_fetch_array($run_cats)){
	       $cat_id = $row_cats['cat_id'];
	       $cat_title = $row_cats['cat_title'];
	       echo"<option value='$cat_id'><a href='#'>$cat_title</a></option>";
	      }
		 ?></td>
	  </tr>
	  <tr>
	    <td align="center">Product Brand:</td>
		<td>
		<select name="product_brand" required>
		  <option> Select a brand</option>
		  <?php 
		  $get_brands = "select * from brands";
	      $run_brands = mysqli_query($con,$get_brands);
	
	      while($row_brands = mysqli_fetch_array($run_brands)){
		   $brand_id = $row_brands['brand_id'];
		   $brand_title = $row_brands['brand_title'];
		   echo"<option value='$brand_id'><a href='#'>$brand_title</a></option>";
           }
		 ?>
		</td>
	  </tr>
	  <tr>
	  <tr>
	    <td align="center">Product Image:</td>
		<td><input type="file" name="product_image" required /></td>
	  </tr>
	  <tr>
	    <td align="center">Product Price:</td>
		<td><input type="text" name="product_price" required /></td>
	  </tr>
	  <tr>
	    <td align="center"> Product Description:</td>
		<td><textarea name="product_desc" cols="20" rows="6" ></textarea></td>
	  </tr>
	    <tr>
	    <td align="center">Product Keywords:</td>
		<td><input type="text" name="product_keywords" required /></td>
	  </tr>
	  <tr align="center">
		<td colspan="7"><input type="submit" name="insert_post" value="Insert"/></td>
	  </tr>
	 </table>
   </form>
 </body>
</html>
<?php 
  //global $con;
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecommerce";

// Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_POST['insert_post'])){
	$product_title = $_POST['product_title'];
	$product_cat = $_POST['product_cat'];
	$product_brand = $_POST['product_brand'];
	$product_price = $_POST['product_price'];
	$product_desc = $_POST['product_desc'];
	$product_keywords = $_POST['product_keywords'];
   
    // getting the image from the field
	 $product_image = $_FILES['product_image']['name'];
	 $product_image_tmp = $_FILES['product_image']['tmp_name'];
	  
	 move_uploaded_file($product_image_tmp,"product_images/$product_image");
    
    $insert_product = "insert into products (product_cat,
	 product_brand,product_title,product_price,product_desc,
	 product_image,product_keywords) 
	 values ('$product_cat','$product_brand','$product_title',
	 $product_price,'$product_desc','$product_image','$product_keywords')";
	
if (mysqli_query($conn, $insert_product)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $insert_product . "<br>" . mysqli_error($conn);
}
 }
 
 
 
  mysqli_close($conn);
?>