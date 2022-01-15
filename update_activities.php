<?php
ob_start();
session_start();
require('top.inc.php');

$categories='';
$postedby='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from work_activities where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$work_activities=$row['work_activities'];
		$postedby =  $_SESSION["user_id"];
	}else{
		header('location:work_activities.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$work_activities=get_safe_value($con,$_POST['work_activities']);
	$postedby=get_safe_value($con,$_SESSION['user_id']);
	$res=mysqli_query($con,"select * from work_activities where work_activities='$categories'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Activities already exist";
			}
		}else{
			$msg="Activities already exist";
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			mysqli_query($con,"update work_activities set work_activities='$work_activities', PostedBy='$postedby' where id='$id'");
		}else{
			mysqli_query($con,"insert into work_activities(work_activities, PostedBy, status) values('$work_activities','$postedby','1')");
		}
		header('location:work_activities.php');
		die();
	}
}
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Work Activities</strong><small> Form</small></div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="activities" class=" form-control-label">Activities</label>
									<input type="text" name="work_activities" placeholder="Enter activity name" class="form-control" required value="<?php echo $categories?>">
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