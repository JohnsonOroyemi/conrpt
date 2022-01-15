<?php
ob_start();
session_start();
require('top.inc.php');

$materials='';
$postedby='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from materials where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$materials=$row['materials'];
		$postedby =  $_SESSION["user_id"];
	}else{
		header('location:materials.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$materials=get_safe_value($con,$_POST['materials']);
	$postedby=get_safe_value($con,$_SESSION['user_id']);
	$res=mysqli_query($con,"select * from materials where materials='$materials'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Materials already exist";
			}
		}else{
			$msg="Materials already exist";
		}
	}

	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			mysqli_query($con,"update materials set materials='$materials', PostedBy='$postedby' where id='$id'");
		}else{
			mysqli_query($con,"insert into materials (materials,PostedBy, status) values('$materials', '$postedby','1')");
		}
		header('location:materials.php');
		die();
	}
}
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Materials</strong><small> Form</small></div>
						<span><?php if(isset($_GET['r'])){echo $_GET['r'];} ?></span>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="materials" class=" form-control-label">Materials</label>
									<input type="text" name="materials" placeholder="Enter material name" class="form-control" required value="<?php echo $materials?>">
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