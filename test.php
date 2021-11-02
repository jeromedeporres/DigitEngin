<?php
include 'header.php';

?><form id="frmDate" action="" method="post">
<div>
<label style="padding-top:20px;">Start Date</label><br/>
<input type="datetime-local" name="startdate" value="<?php if(!empty($_POST["startdate"])) { echo $_POST["startdate"]; } ?>" class="demoInputBox">
</div>

<div>
<label>End Date</label>
<span id="userEmail-info" class="info"></span><br>
<input type="datetime-local" name="enddate" value="<?php if(!empty($_POST["startdate"])) { echo $_POST["enddate"]; } ?>" class="demoInputBox">
</div>

<div>
<input type="submit" name="submit" value="Find Difference" class="btnAction">
</div>
</form>

<?php
function differenceInHours($startdate,$enddate){
	$starttimestamp = strtotime($startdate);
	$endtimestamp = strtotime($enddate);
	$difference = abs($endtimestamp - $starttimestamp)/3600;
	return $difference;
}
if(!empty($_POST["submit"])) {
	$hours_difference = differenceInHours($_POST["startdate"],$_POST["enddate"]);	
	$message = "The Difference is " . $hours_difference . " hours";
}

echo $message;
?>
<?php
  include 'footer.php'
?>