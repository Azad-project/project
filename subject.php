<?php
include("aheader.php");

$msg="";
$std="5";
$name="";
$cn=mysqli_connect("localhost:3308","root","","AzadDB");  
if(isset($_POST["btn"]))
{
  	$name=$_POST["name"];
  	$std=$_POST["std"];
  	mysqli_query($cn,"Insert into Subject (SubjectName,Std) values('$name','$std')");
	$msg="Subject added successfully...";
  
}
else if(isset($_POST["std"]))
{
	$std=$_POST["std"];
	$name=$_POST["name"];

}
else
{
	if(isset($_GET["id"]))
	{
		$id=$_GET["id"];
		mysqli_query($cn,"Delete from Subject where SubjectId=$id");
	}

}
?>
<div class="container">
	<div class="col-md-7 offset-md-2">
	<br>	
	<div class="card border-primary">
		<div class="card-header bg-warning text-white">
			<h3>Subject Entry</h3>
		</div>
		<div class="card-body">
		<form name="form1" method="post">

			<div class="form-group">
				<label>Subject Name</label>
				<input type="text" name="name" class="form-control border-primary" value="<?=$name?>"/>
			</div>
			<div class="form-group">
				<label>Standard</label>
				<select name="std" class="form-control border-primary" onchange="form1.submit();">
					<option <?=$std=="5"?"selected": ""?> value="5">5</option>
					<option <?=$std=="6"?"selected": ""?> value="6">6</option>
					<option <?=$std=="7"?"selected": ""?> value="7">7</option>
					<option <?=$std=="8"?"selected": ""?> value="8">8</option>
					<option <?=$std=="9"?"selected": ""?> value="9">9</option>
					<option <?=$std=="10"?"selected": ""?> value="10">10</option>
				</select>				
			</div>			
			<div class="form-group">				
				<input type="submit" name="btn" class="btn btn-success" value="Add"/>
				<span><?=$msg?></span>
			</div>
		</form>
		<table class="table table-bordered">
			<thead class="bg-warning">
			<tr>
				<th>SubjectID</th>
				<th>Subject Name</th>
				<th>Standard</th>
				<th>Actions</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$rs=mysqli_query($cn,"select * from Subject where Std='$std'");
  			while($row=mysqli_fetch_array($rs)){
  			?>
			<tr>
				<td><?=$row[0]?></td>
				<td><?=$row[1]?></td>
				<td><?=$row[2]?></td>
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