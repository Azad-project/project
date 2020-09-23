<?php
include("aheader.php");
include("../SMS.php");
$cn=mysqli_connect("localhost:3308","root","","AzadDB");  

function getSub($std){
	global $cn;


	$str="";
	$rs=mysqli_query($cn,"select * from Subject where Std='$std'");
	$i=1;
	while($row=mysqli_fetch_array($rs))
	{
		$str.="<th><input type='hidden' name='sub$i'  value='{$row[1]}'/>$row[1]</th>";
		$i++;
	}	
	return $str;							
}
$msg="";
$std="";
$div="";
$sem="";

if(isset($_POST["btn2"]))
{
	$std=$_POST["std"];
  	$div=$_POST["div"];
  	$sem=$_POST["sem"];
  	
}
if(isset($_POST["btn"]))
{
	$sem=$_POST["sem"];
	$std=$_POST["std"];
	$div=$_POST["div"];
  	
  	$sub1=$_POST["sub1"];
  	$sub2=$_POST["sub2"];
  	$sub3=$_POST["sub3"];
  	$sub4=$_POST["sub4"];
  	$sub5=$_POST["sub5"];
  	$sub6=$_POST["sub6"];

  	$roll=$_POST["r"];
  	
  	$val1=$_POST["a"];
  	$val2=$_POST["b"];
  	$val3=$_POST["c"];
  	$val4=$_POST["d"];
  	$val5=$_POST["e"];
  	$val6=$_POST["f"];

  	$data="";

  	for($i=0;$i<count($roll);$i++)
  	{
  		$rs=mysqli_query($cn,"select * from Student where RollNo='{$roll[$i]}'");
  		if($row=mysqli_fetch_array($rs))
  		{
  			$nm=str_replace(" ","_",$row[1]);

  		$data="Std:$std:$div:Sem:$sem:$nm:$sub1:{$val1[$i]}:$sub2:{$val2[$i]}:$sub3:{$val3[$i]}:$sub4:{$val4[$i]}:$sub5:{$val5[$i]}:$sub6:{$val6[$i]}";
  		//echo $data;
  		//exit;
  		sendSMS("91".$row[5],$data);
  		}

  	}
  	
	$msg="SMS sent successfully...";
  
}
?>
<div class="container-fluid" style="font-size:10pt">
	<div class="col-md-12">
	<br>	
	<div class="card border-primary">
		<div class="card-header bg-warning text-white">
			<h3>Send SMS to Parent</h3>
		</div>
		<div class="card-body">
		<form name="form1" method="post">
			<table class="table table-bordered">
				<tr>
					<td>Sem</td>
					<td>
					<select name="sem" class="">
					<option value="1">1</option>
					<option value="2">2</option>
					</select>						
					</td>
					<td>Standard</td>
					<td>
					<select name="std" >
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					</select>							
					</td>
					<td>Division</td>
					<td>
					<select name="div" >
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="C">C</option>
					<option value="D">D</option>					
					</select>						
					</td>
					<td>
						<input type="submit" name="btn2" class="btn btn-success" value="Student List"/>
						<input type="submit" name="btn" class="btn btn-success" value="Send SMS"/>
						<?=$msg?>
					</td>

				</tr>
			</table>

			<table width="70%" class="table table-bordered" >

				<tr>
					<th>Roll No</th>
					<?php echo getSub($std); ?>					
				</tr>
				<?php
				$rs=mysqli_query($cn,"select * from Marks where Std='$std' and Division='$div' and Sem='$sem'");
				$i=1;				
				if($row=mysqli_fetch_array($rs)){
					$data=$row[4];					
					
					$data=explode("@", $data);
					
					for($i=0;$i<count($data)-1;$i++) {
						$s=explode(":",$data[$i]);				
					
					
				?>
				<tr>
					<td>
						<input type="hidden" name="r[]" value="<?=$s[1]?>"/><?=$s[1]?>						
					</td>
					<td><input type="hidden" name="a[]" value="<?=$s[3]?>"/><?=$s[3]?></td>
					<td><input type="hidden" name="b[]" value="<?=$s[5]?>"/><?=$s[5]?></td>
					<td><input type="hidden" name="c[]" value="<?=$s[7]?>"/><?=$s[7]?></td>
					<td><input type="hidden" name="d[]" value="<?=$s[9]?>"/><?=$s[9]?></td>
					<td><input type="hidden" name="e[]" value="<?=$s[11]?>"/><?=$s[11]?></td>
					<td><input type="hidden" name="f[]" value="<?=$s[13]?>"/><?=$s[13]?></td>		
				</tr>
						
				<?php
				}
				}
				?>
		
		</table>
		</form>
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