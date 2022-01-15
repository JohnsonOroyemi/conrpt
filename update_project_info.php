<?php
ob_start();
session_start();
require('top.inc.php');
$client='';
$location	='';
$pm	='';
$arc	='';
$seng	='';
$mep	='';
$qs	='';
$postedby='';
$msg='';

if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"SELECT * from proj_info where client='$client'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$client=$row['client'];
		$location=$row['location'];
		$pm=$row['pm'];
		$arc=$row['arc'];
		$seng	=$row['seng'];
		$mep=$row['mep'];
		$qs=$row['qs'];
		$postedby =  $_SESSION["user_id"];
	
	}else{
	}
}

if(isset($_POST['submit'])){
	$client=get_safe_value($con,$_POST['client']);
	$location=get_safe_value($con,$_POST['location']);
	$pm=get_safe_value($con,$_POST['pm']);
	$arc=get_safe_value($con,$_POST['arc']);
	$seng=get_safe_value($con,$_POST['seng']);
	$mep=get_safe_value($con,$_POST['mep']);
	$qs=get_safe_value($con,$_POST['qs']);
	$postedby=get_safe_value($con,$_SESSION['user_id']);

	$res=mysqli_query($con,"SELECT * from proj_info where id ='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="project already taken";
			}
		}else{
			$msg="project already taken";
		}
	}

	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$update_sql = "UPDATE proj_info set client='$client' ,location ='$location ', pm='$pm', arc='$arc', seng='$seng', mep='$mep', qs ='$qs',  PostedBy='$postedby' where id='$id'";
		
			mysqli_query($con,$update_sql);
		}else{
			mysqli_query($con,"INSERT into proj_info (client,location,pm,arc,seng,mep, qs, PostedBy,status) values('$client','$location', '$pm','$arc','$seng','$mep', '$qs','$postedby','1')");
		}
		header('location:Project Information.php');
		die();
	}

}


?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Project Information</strong><small> Form</small></div>
						<span><?php if(isset($_GET['r'])){echo $_GET['r'];} ?></span>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							<div class="form-group">
									<label for="projinfo" class=" form-control-label">Client</label>
									<input type="text" name="client" placeholder="Enter Client Name" class="form-control" required value="<?php echo $client?>">
								</div>
								<div class="form-group">
									<label for="projinfo" class=" form-control-label">Location</label>
									<input type="text" name="location" placeholder="Enter Project Location" class="form-control" required value="<?php echo $location?>">
								</div>

								<div class="form-group">
									<label for="projinfo" class=" form-control-label">Project Manager</label>
									<input type="text" name="pm" placeholder="Enter Project Manager" class="form-control" required value="<?php echo $pm?>">
								</div>

								<div class="form-group">
									<label for="projinfo" class=" form-control-label">Architect</label>
									<input type="text" name="arc" placeholder="Architect" class="form-control" required value="<?php echo $arc?>">
								</div>

								<div class="form-group">
									<label for="projinfo" class=" form-control-label">Structural Engineer</label>
									<input type="text" name="seng" placeholder="Enter Structural Engineer" class="form-control" required value="<?php echo $seng?>">
								</div>

								<div class="form-group">
									<label for="projinfo" class=" form-control-label">MEP Consultant</label>
									<input type="text" name="mep" placeholder="Enter MEP Consultant" class="form-control" required value="<?php echo $mep?>">
								</div>

								<div class="form-group">
									<label for="projinfo" class=" form-control-label">Quantity Surveyor</label>
									<input type="text" name="qs" placeholder="Enter Quantity Surveyor" class="form-control" required value="<?php echo $qs?>">
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