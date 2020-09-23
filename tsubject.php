<?php
include("aheader.php");

$msg="";
$cn=mysqli_connect("localhost:3308","root","","AzadDB");  
if(isset($_POST["btn"]))
{
  	$std=$_POST["std"];
  	$div=$_POST["div"];
  	$tid=$_POST["tid"];
  	$sid=$_POST["sid"];
  	mysqli_query($cn,"Insert into TeacherSubject (Standard,Division,TeacherId,SubjectId) values('$std','$div','$tid','$sid')");
	$msg="Teacher Subject added successfully...";
  
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
	<div class="col-md-8 offset-md-2">
	<br>	
	<div class="card border-primary">
		<div class="card-header bg-warning text-white">
			<h3>Teacher Subject Entry</h3>
		</div>
		<div class="card-body">
		<form name="form1" method="post">

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
				<label>Teacher</label>
				<select name="tid" class="form-control border-primary">
					<?php
					$rs=mysqli_query($cn,"select * from Teacher");
  					while($row=mysqli_fetch_array($rs)){
					?>
					<option value="<?=$row[0]?>"><?=$row[1]?></option>
					<?php
					}
					?>
				</select>				
			</div>
			<div class="form-group">
				<label>Subject</label>
				<select name="sid" class="form-control border-primary">
					<?php
					$rs=mysqli_query($cn,"select * from Subject");
  					while($row=mysqli_fetch_array($rs)){
					?>
					<option value="<?=$row[0]?>"><?=$row[1]?></option>
					<?php
					}
					?>
				</select>				
			</div>				

				
			<div class="form-group">				
				<input type="submit" name="btn" class="btn btn-success" value="Assign"/>
				<span><?=$msg?></span>
			</div>
		</form>
		<table class="table table-bordered">
			<thead class="bg-warning">
			<tr>
				<th>ID</th>
				<th>Standard</th>
				<th>Division</th>
				<th>Teacher</th>
				<th>Subject</th>
				<th>Actions</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$rs=mysqli_query($cn,"select * from tsview");
  			while($row=mysqli_fetch_array($rs)){
  			?>
			<tr>
				<td><?=$row[0]?></td>
				<td><?=$row[1]?></td>
				<td><?=$row[2]?></td>
				<td><?=$row[4]?></td>
				<td><?=$row[6]?></td>
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