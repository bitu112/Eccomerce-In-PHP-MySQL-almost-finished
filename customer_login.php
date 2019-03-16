 <?php
 
 //session_start();
 include("includes/db.php");
 
 ?>
 
 
  <div>
  
   <form method="post" action="">
      <table width="600px" align="center" bgcolor="lightblue">
	    <tr> 
		 <td><h2>Login or Register to buy</h2></td>
		</tr>
		<tr>
		  <td align="right">Email</td>
		  <td><input style="float:left;" type="text" name="email" placeholder="enter an email" required /></td>
		</tr>
		
		<tr>
		  <td align="right">Password : </td>
		  <td><input style="float:left;" type="password" name="pass" placeholder="Password" required />
		</tr>
		
		<tr>
		 <td align="right" colspan="1"><a href="checkout.php?forgot_pass">Forgot Password?</a></td>
		</tr>
		<tr>
		 <td align="right"><input type="submit" name="login" value="Login" /></td>
		</tr>		
	  </table>
	  <h3 style="float:left; position:absolute; left:700px"><a href="customer_register.php">New?Register here </a></h3>
   </form>
  <?php
    if(isset($_POST['login'])){
		$c_email = $_POST['email'];
		$c_pass = $_POST['pass']; 
		$sel_c = "select * from customers where customer_pass='$c_pass' AND customer_email='$c_email'";
	    $run_c = mysqli_query($con,$sel_c);
		$check_customer = mysqli_num_rows($run_c);
		
		if($check_customer == 0){
		echo "<script>alert('Passsword or email is incorect')</script>";
		exit();
		}
		$ip = getIp();
		$sel_cart = "select * from cart where ip_add='$ip'";
	    $run_cart = mysqli_query($con,$sel_cart);
        $check_cart = mysqli_num_rows($run_cart);	
        if($check_customer>0 AND $check_cart==0){
			$_SESSION['customer_email'] = $c_email;
			echo "<script>alert('You logged in successfully')</script>";
			echo "<script>window.open('customer/my_account.php')</script>";
		}
		 else{
			 $_SESSION['customer_email'] = $c_email;
			 echo"<script>alert('Account has been created')</script>";
			 echo"<script>window.open('checkout.php','_self')</script>"; 
		 }		
	}
  ?>

  </div>