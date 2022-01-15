<?php
session_start();
include("connection.php");
if(!isset($_SESSION["user_id"])){
	echo "<script type='text/javascript'>alert('You need to sign in to access your dashboard. Kindly stroll down and sign in. Thanks.'); window.location.href = 'signup.php';</script>";
  }else{
	  }
require('top.inc.php');
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Dashboard </h4>
				</div>
			</div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>