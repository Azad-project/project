<?php
session_start();
include("cheader.php");
$msg="";

if(isset($_POST["btn"]))
{
  $user=$_POST["user"];
  $pass=$_POST["pass"];  

  $cn=mysqli_connect("localhost:3308","root","","AzadDB");  
  $rs=mysqli_query($cn,"select * from AdminLogin where UserName='$user' and Password='$pass'");
  if($row=mysqli_fetch_array($rs)){
  		$_SESSION["user"]=$user;
  		//header("location: admin/home.php");
  		echo "<script>window.location='admin/home.php';</script>";
  		
  }
  else{
		$msg="Login Failed Try again...";
  }
  mysqli_close($cn);
  
}
?>
<div class="container">
	<div class="col-md-6 offset-md-3">
	<br>	
	<div class="card border-primary">
		<div class="card-header bg-warning text-white">
			<h3>Admin Login</h3>
		</div>
		<div class="card-body">
		<form name="form1" method="post">

			<div class="form-group">
				<label>Username</label>
				<input type="text" name="user" class="form-control border-primary"/>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="pass" class="form-control border-primary"/>
			</div>
			<div class="form-group">				
				<input type="submit" name="btn" class="btn btn-success" value="Login"/>
				<span><?=$msg?></span>
			</div>
		</form>
		</div>
	</div>
	</div>
	<br>	
</div>	
<br>

<br>


<?php
include("footer.php");
?>