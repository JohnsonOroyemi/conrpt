<?php
ob_start();
session_start();
require('top.inc.php');
$material_id='';
$stock	='';
$used	='';
$balance	='';
$purpose	='';
$date	='';
$postedby='';
$msg='';

if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"SELECT * from material_inventory where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$material_id=$row['material_id'];
		$stock=$row['stock'];
		$used=$row['used'];
		$balance=$row['balance'];
		$purpose	=$row['purpose'];
		$date=$row['date'];
		$postedby =  $_SESSION["user_id"];
	
	}else{
		header('location:material_inventory.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$material_id=get_safe_value($con,$_POST['material_id']);
	$stock=get_safe_value($con,$_POST['stock']);
	$used=get_safe_value($con,$_POST['used']);
	$balance=get_safe_value($con,$_POST['balance']);
	$purpose=get_safe_value($con,$_POST['purpose']);
	$date=get_safe_value($con,$_POST['date']);
	$postedby=get_safe_value($con,$_SESSION['user_id']);

	$res=mysqli_query($con,"SELECT * from material_inventory where purpose ='$purpose' and date ='$date'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="inventory already taken";
			}
		}else{
			$msg="inventory already taken";
		}
	}

	

	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$update_sql = "UPDATE material_inventory set material_id='$material_id' ,stock='$stock', used='$used', balance='$balance', purpose='$purpose', date='$date',  PostedBy='$postedby' where id='$id'";
		
			mysqli_query($con,$update_sql);
		}else{
			mysqli_query($con,"INSERT into material_inventory (material_id,stock,used,balance,purpose,date, PostedBy,status) values('$material_id','$stock', '$used','$balance','$purpose','$date', '$postedby','1')");
		}
		header('location:material_inventory.php');
		die();
	}

}
?>


<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Material Inventory</strong><small> Form</small></div>
						<span><?php if(isset($_GET['r'])){echo $_GET['r'];} ?></span>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="materials" class=" form-control-label">Material</label>
									<select class="form-control" name="material_id">
										<option>Select material</option>
										<?php
										$res=mysqli_query($con,"select id,materials from materials order by materials asc");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$material_id){
												echo "<option selected value=".$row['id'].">".$row['materials']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['materials']."</option>";
											}
										}
										?>
									</select>
								</div>

								<div class="form-group">
									<label for="materials" class=" form-control-label">Stock</label>
									<input type="number" name="stock" placeholder="Enter stock" class="form-control" required value="<?php echo $stock?>">
								</div>

								<div class="form-group">
									<label for="materials" class=" form-control-label">Used</label>
									<input type="number" name="used" placeholder="Enter qty of material used on site today" class="form-control" required value="<?php echo $used?>">
								</div>

								<div class="form-group">
									<label for="materials" class=" form-control-label">Balance</label>
									<input type="number" name="balance" placeholder="Balance" class="form-control" required value="<?php echo $balance?>">
								</div>
								

								<div class="form-group">
									<label for="materials" class=" form-control-label">Purpose</label>
									<textarea name="purpose" placeholder="Purpose of usage of materials" class="form-control" required><?php echo $purpose?></textarea>
								</div>

								<div class="form-group">
									<label for="materials" class=" form-control-label">Date</label>
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