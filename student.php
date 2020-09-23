<?php
include("aheader.php");

$msg="";
$cn=mysqli_connect("localhost:3308","root","","AzadDB");  
if(isset($_POST["btn"]))
{
	$roll=$_POST["roll"];
	$name=$_POST["name"];
	$address=$_POST["address"];
  	$std=$_POST["std"];
  	$div=$_POST["div"];
  	$mob=$_POST["mob"];
  	
  	mysqli_query($cn,"Insert into Student values('$roll','$name','$address','$std','$div','$mob')");
	$msg="Student added successfully...";
  
}
else
{
	if(isset($_GET["id"]))
	{
		$id=$_GET["id"];
		mysqli_query($cn,"Delete from Student where RollNo=$id");
	}

}
?>
<div class="container">
	<div class="col-md-10 offset-md-1">
	<br>	
	<div class="card border-primary">
		<div class="card-header bg-warning text-white">
			<h3>Student Entry</h3>
		</div>
		<div class="card-body">
		<form name="form1" method="post">

			<div class="form-group">
				<label>Roll No</label>
				<input type="text" name="roll" class="form-control border-primary"/>
			</div>
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control border-primary"/>
			</div>
			<div class="form-group">
				<label>Address</label>
				<input type="text" name="address" class="form-control border-primary"/>
			</div>

			<div class="form-group">
				<label>Standard</label>
				<select name="std" class="form-control border-primary">
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				</select>				
			</div>			
			<div class="form-group">
				<label>Division</label>
				<select name="div" class="form-control border-primary">
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="C">C</option>
					<option value="D">D</option>					
				</select>				
			</div>			
			<div class="form-group">
				<label>Parent Mobile No</label>
				<input type="text" name="mob" class="form-control border-primary"/>
			</div>
				
			<div class="form-group">				
				<input type="submit" name="btn" class="btn btn-success" value="Add Student"/>
				<span><?=$msg?></span>
			</div>
		</form>
		<table class="table table-bordered">
			<thead class="bg-warning">
			<tr>
				<th>RollNo</th>
				<th>Name</th>
				<th>Address</th>
				<th>Standard</th>
				<th>Division</th>
				<th>ParentMobile</th>
				<th>Actions</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$rs=mysqli_query($cn,"select * from Student");
  			while($row=mysqli_fetch_array($rs)){
  			?>
			<tr>
				<td><?=$row[0]?></td>
				<td><?=$row[1]?></td>
				<td><?=$row[2]?></td>
				<td><?=$row[3]?></td>
				<td><?=$row[4]?></td>
				<td><?=$row[5]?></td>
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