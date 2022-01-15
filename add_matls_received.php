<?php
session_start();
require('top.inc.php');
$work_activities_id='';
$file='';
$previous	='';
$actual	='';
$challenges	='';
$date	='';
$postedby='';
$msg='';

$file_required='required';
if(isset($_GET['id']) && $_GET['id']!=''){
	$file_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from work_accomplished where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$work_activities_id=$row['work_activities_id'];
		$previous=$row['previous'];
		$actual	=$row['actual'];
		$challenges	=$row['challenges'];
		$date=$row['date'];
		$postedby =  $_SESSION["user_id"];
	
	}else{
		header('location:work_accomplished.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$work_activities_id=get_safe_value($con,$_POST['work_activities_id']);
	$previous=get_safe_value($con,$_POST['previous']);
	$actual=get_safe_value($con,$_POST['actual']);
	$challenges=get_safe_value($con,$_POST['challenges']);
	$date=get_safe_value($con,$_POST['date']);
	$postedby=get_safe_value($con,$_SESSION['user_id']);

	$res=mysqli_query($con,"select * from work_accomplished where work_activities_id='$work_activities_id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="work already accomplished  exist";
			}
		}else{
			$msg="work already accomplished exist";
		}
	}
	
	
	if($_GET['id']==0){
		if($_FILES['file']['type']!='image/png' && $_FILES['file']['type']!='image/jpg' && $_FILES['file']['type']!='image/jpeg' && $_FILES['file']['type']!='audio/mpeg' && $_FILES['file']['type']!='video/mpeg' && $_FILES['file']['type']!='audio/webm' && $_FILES['file']['type']!='video/webm' && $_FILES['file']['type']!='audio/mp4' && $_FILES['file']['type']!='video/mp4' && $_FILES['file']['type']!='audio/mp3' && $_FILES['file']['type']!='video/Ogg' && $_FILES['file']['type']!='audio/WAV' && $_FILES['file']['type']!='video/WAV' && $_FILES['file']['type']!='application/pdf' && $_FILES['file']['type']!='image/doc'){ 
			$msg="Please select only png,jpg and jpeg image formate";
		}
	}else{
		if($_FILES['file']['type']!=''){
				if($_FILES['file']['type']!='image/png' && $_FILES['file']['type']!='image/jpg' && $_FILES['file']['type']!='image/jpeg' && $_FILES['file']['type']!='audio/mpeg' && $_FILES['file']['type']!='video/mpeg' && $_FILES['file']['type']!='audio/webm' && $_FILES['file']['type']!='video/webm' && $_FILES['file']['type']!='audio/mp4' && $_FILES['file']['type']!='video/mp4' && $_FILES['file']['type']!='audio/mp3' && $_FILES['file']['type']!='video/Ogg' && $_FILES['file']['type']!='audio/WAV' && $_FILES['file']['type']!='video/WAV' && $_FILES['file']['type']!='application/pdf' && $_FILES['file']['type']!='image/doc'){
				$msg="Please select only png,jpg and jpeg image formate";
			}
		}
	}
	
	$targetDir = "uploads/";
    $targetFilePath = $targetDir;

	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['file']['name']!=''){
				$file=$_FILES['file']['name'];
				move_uploaded_file($_FILES['file']['tmp_name'],   $targetFilePath.$file);
				$update_sql="update work_accomplished set work_activities_id='$work_activities_id', previous='$previous' ,actual='$actual', challenges='$challenges', date='$date', PostedBy='$postedby', file='$file' where id='$id'";
			}else{
				$update_sql="update work_accomplished set work_activities_id='$work_activities_id', previous='$previous', actual='$actual', challenges='$challenges', date='$date', PostedBy='$postedby', file='$file'  where id='$id'";
			}
			mysqli_query($con,$update_sql);
		}else{
			$file=$_FILES['file']['name'];
			move_uploaded_file($_FILES['file']['tmp_name'],   $targetFilePath.$file);
			mysqli_query($con,"insert into work_accomplished (work_activities_id,previous,actual,challenges,date,PostedBy,status,file) values('$work_activities_id','$previous','$actual', '$challenges','$date','$postedby',1,'$file')");
		}
		header('location:work_accomplished.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Work Accomplished</strong><small> Form</small></div>
						<span><?php if(isset($_GET['r'])){echo $_GET['r'];} ?></span>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="categories" class=" form-control-label">Activity</label>
									<select class="form-control" name="work_activities_id">
										<option>Select activity</option>
										<?php
										$res=mysqli_query($con,"select id,work_activities from work_activities order by work_activities asc");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$categories_id){
												echo "<option selected value=".$row['id'].">".$row['work_activities']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['work_activities']."</option>";
											}
											
										}
										?>
									</select>
								</div>
			
								<div class="form-group">
									<label for="categories" class=" form-control-label">File</label>
									<input type="file" name="file" class="form-control" <?php echo  $file_required?>>
								</div>

								<div class="form-group">
									<label for="categories" class=" form-control-label">Previous % Completion</label>
									<textarea name="previous" placeholder="Enter previous % completion" class="form-control"><?php echo $previous?></textarea>
								</div>

								<div class="form-group">
									<label for="work_activities" class=" form-control-label">Actual % Completion</label>
									<textarea name="actual" placeholder="Enter actual % completion" class="form-control" required><?php echo $actual?></textarea>
								</div>
								
								<div class="form-group">
									<label for="work_activities" class=" form-control-label">Challenges</label>
									<textarea name="challenges" placeholder="Enter challenges encountered on item of work" class="form-control" required><?php echo $challenges?></textarea>
								</div>

								<div class="form-group">
									<label for="categories" class=" form-control-label">Date</label>
									<input type="date" name="date" placeholder="Enter reporting date" class="form-control" required value="<?php echo $date?>">
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