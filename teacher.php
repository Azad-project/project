<?php
include("aheader.php");

$msg="";
$cn=mysqli_connect("localhost:3308","root","","AzadDB");  
if(isset($_POST["btn"]))
{
  	$name=$_POST["name"];
  	mysqli_query($cn,"Insert into Teacher (TeacherName) values('$name')");
	$msg="Teacher added successfully...";
  
}
else
{
	if(isset($_GET["id"]))
	{
		$id=$_GET["id"];
		mysqli_query($cn,"Delete from Teacher where TeacherId=$id");
	}

}
?>
<div class="container">
	<div class="col-md-7 offset-md-2">
	<br>	
	<div class="card border-primary">
		<div class="card-header bg-warning text-white">
			<h3>Teacher Entry</h3>
		</div>
		<div class="card-body">
		<form name="form1" method="post">

			<div class="form-group">
				<label>Teacher Name</label>
				<input type="text" name="name" class="form-control border-primary"/>
			</div>			
			<div class="form-group">				
				<input type="submit" name="btn" class="btn btn-success" value="Add"/>
				<span><?=$msg?></span>
			</div>
		</form>
		<table class="table table-bordered">
			<thead class="bg-warning">
			<tr>
				<th>TeacherID</th>
				<th>Teacher Name</th>
				<th>Actions</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$rs=mysqli_query($cn,"select * from Teacher");
  			while($row=mysqli_fetch_array($rs)){
  			?>
			<tr>
				<td><?=$row[0]?></td>
				<td><?=$row[1]?></td>
				<td><a onclick="return confirm('Delete Entry?');" href="?id=<?=$row[0]?>" class="btn btn-danger">Delete</a></td>
			</tr>
			<?php
			}	
			?>
			</tbody>
		</table>

		</div>
	</div>
	</div>
	<br>	
</div>	
<br>

<br>

<?php
mysqli_close($cn);
include("afooter.php");
?>