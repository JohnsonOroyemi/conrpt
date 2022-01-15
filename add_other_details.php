<?php
ob_start();
session_start();
require('top.inc.php');
$weather='';
$stageofwork	='';
$reportno	='';
$week	='';
$day	='';
$date	='';
$accident='';
$visitors='';
$attendance='';
$matlsneeded='';
$projectedact='';
$postedby='';
$msg='';

if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"SELECT * from other_report_details where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$weather=$row['weather'];
		$stageofwork=$row['stageofwork'];
		$reportno	=$row['reportno'];
		$week	=$row['week'];
		$day	=$row['daynr'];
		$date=$row['date'];
		$accident=$row['accident'];
		$visitors=$row['visitors'];
		$attendance=$row['attendance'];
		$matlsneeded=$row['matlsneeded'];
		$projectedact=$row['projectedact'];
		$postedby =  $_SESSION["user_id"];
	
	}else{
		header('location:other_report_details.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$weather=get_safe_value($con,$_POST['weather']);
	$stageofwork=get_safe_value($con,$_POST['stageofwork']);
	$reportno=get_safe_value($con,$_POST['reportno']);
	$week=get_safe_value($con,$_POST['week']);
	$day=get_safe_value($con,$_POST['daynr']);
	$date=get_safe_value($con,$_POST['date']);
	$accident=get_safe_value($con,$_POST['accident']);
	$visitors=get_safe_value($con,$_POST['visitors']);
	$attendance=get_safe_value($con,$_POST['attendance']);
	$matlsneeded=get_safe_value($con,$_POST['matlsneeded']);
	$projectedact=get_safe_value($con,$_POST['projectedact']);
	$postedby=get_safe_value($con,$_SESSION['user_id']);

	$res=mysqli_query($con,"SELECT * from other_report_details where id ='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="details already uploaded";
			}
		}else{
			$msg="details already uploaded";
		}
	}

	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$update_sql = "UPDATE other_report_details set weather='$weather' ,stageofwork ='$stageofwork', reportno ='$reportno', week ='$week', daynr='$day', date='$date', accident='$accident',  visitors='$visitors', attendance='$attendance',matlsneeded='$matlsneeded', projectedact='$projectedact', PostedBy ='$postedby'  where id='$id'";

			mysqli_query($con,$update_sql);
		}else{
			mysqli_query($con,"INSERT into other_report_details (weather,stageofwork,reportno,week,daynr, date, accident,visitors,attendance,matlsneeded,projectedact, PostedBy,status) values('$weather','$stageofwork', '$reportno','$week','$day', '$date','$accident', '$visitors','$attendance', '$matlsneeded','$projectedact','$postedby','1')");
		}
		header('location:other_report_details.php');
		die();
	}

}
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Other Report Details</strong><small> Form</small></div>
						<span><?php if(isset($_GET['r'])){echo $_GET['r'];} ?></span>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">

								<div class="form-group">
									<label for="details" class=" form-control-label">Weather</label>
									<input type="text" name="weather" placeholder="Enter weather report" class="form-control" required value="<?php echo $weather?>">
								</div>

								<div class="form-group">
									<label for="details" class=" form-control-label">Stage of Work</label>
									<input type="text" name="stageofwork" placeholder="Enter Stage of work" class="form-control" required value="<?php echo $stageofwork?>">
								</div>

								<div class="form-group">
									<label for="details" class=" form-control-label">Report No</label>
									<input type="number" name="reportno" placeholder="Enter Report No" class="form-control" required value="<?php echo $reportno?>">
								</div>
								

								<div class="form-group">
									<label for="details" class=" form-control-label">Week No</label>
									<input type="number" name="week" placeholder="Enter Week No" class="form-control" required value="<?php echo $reportno?>">
								</div>

								<div class="form-group">
									<label for="details" class=" form-control-label">Day No</label>
									<input type="number" name="daynr" placeholder="Enter Day No" class="form-control" required value="<?php echo $reportno?>">
								</div>

								<div class="form-group">
									<label for="materials" class=" form-control-label">Date</label>
									<input type="date" name="date" placeholder="Enter reporting date" class="form-control" required value="<?php echo $date?>">
								</div>

								<div class="form-group">
									<label for="details" class=" form-control-label">Accident</label>
									<textarea name="accident" placeholder="Enter Accident that occured on site (if any)" class="form-control" required><?php echo $accident?></textarea>
								</div>

								<div class="form-group">
									<label for="details" class=" form-control-label">Visitors</label>
									<textarea name="visitors" placeholder="Enter Name of visitors on site today (if any)" class="form-control" required><?php echo $visitors?></textarea>
								</div>

								<div class="form-group">
									<label for="details" class=" form-control-label">Attendance</label>
									<textarea name="attendance" placeholder="Enter Tradesmen and number " class="form-control" required><?php echo $attendance?></textarea>
								</div>

								<div class="form-group">
									<label for="details" class=" form-control-label">Materials needed</label>
									<textarea name="matlsneeded" placeholder="Enter materials needed on site " class="form-control" required><?php echo $matlsneeded?></textarea>
								</div>

								<div class="form-group">
									<label for="details" class=" form-control-label">Projected Activities for the week</label>
									<textarea name="projectedact" placeholder="Enter Projected Activities for the week " class="form-control" required><?php echo $projectedact?></textarea>
								</div>

							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
<?php
require('footer.inc.php');
?>