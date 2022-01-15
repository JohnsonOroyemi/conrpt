<?php
session_start();
require('connection.php');
require('functions.inc.php');
?>
<!Doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Blueline Site Report</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="css/report_summary.css">
</head>
<body>
  <header>
  <div class="logo">
  <img src="images/bup.PNG" alt="blueline logo" height="85" width="150" />
  </div>


<?php
$sql="select  user.projectName AS projectName, proj_info.PostedBy AS PostedBy from user INNER JOIN proj_info on proj_info.PostedBy = user.userId where PostedBy =user.userId ";
$res=mysqli_query($con,$sql);
?>
<?php while($row=mysqli_fetch_assoc($res)){?>
  <?php 
							if(isset($_SESSION["user_id"])) { 
							if($row["PostedBy"] === $_SESSION["user_id"]){?>
        <div class="invoiceNbr">
            BLUELINE URBAN PROJECT LTD
            <br/>
              &
            <br>
            <?php echo ucwords(strtoupper($row["projectName"])); ?>
            <br>
        </div>
        <?php }
								}else{
							}
								?>
							
							<?php } ?>
    </header>

<?php
$sql="select * from  other_report_details where date (date) = date(now())";
$res=mysqli_query($con,$sql);
?>
<?php while($row=mysqli_fetch_assoc($res)){?>
  <?php 
							if(isset($_SESSION["user_id"])) { 
							if($row["PostedBy"] === $_SESSION["user_id"]){?>
<section class="items">
<p><b>WEATHER:</b> <?php echo $row['weather']?> </p> 
<p><b>STAGE OF WORK:</b> <?php echo $row['stageofwork']?></p>
<p><b>VISITOR:</b> <?php echo $row['visitors']?>  </p> 
<p><b>MATERIALS NEEDED ON SITE:</b> <?php echo $row['matlsneeded']?></p> 
<p><b>ACCIDENT:</b> <?php echo $row['accident']?> </p>
<p><b>ATTENDANCE :</b> <?php echo $row['attendance']?></p> 

</section>
<?php }
								}else{
							}
								?>
							
							<?php } ?>


<?php
$sql="select work_accomplished.*,work_activities.work_activities from work_accomplished,work_activities where work_accomplished.work_activities_id=work_activities.id order by work_accomplished.id asc";
$res=mysqli_query($con,$sql);
?>

<section>
  <!--for demo wrap-->
  <h1>Work Accomplished</h1>
  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
        <th>Item</th>
          <th>Work Activities Achieved Today</th>
          <th>Previous % Completion</th>
          <th>Actual % Completion</th>
          <th>Challenges</th>
        </tr>
      </thead>
    </table>
  </div>
  
        
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody> 
      <?php 
							while($row=mysqli_fetch_assoc($res)){?>
      <tr>
      <?php 
							if(isset($_SESSION["user_id"])) { 
							if($row["PostedBy"] === $_SESSION["user_id"]){?>
							   <td><?php echo $row['id']?></td>
                 <td><?php echo $row['work_activities']?></td>
							   <td><?php echo $row['previous']?></td>
							   <td><?php echo $row['actual']?></td>
							   <td><?php echo $row['challenges']?></td>
        <?php }
        }else{
      }
								?>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>


<?php
$sql="select material_inventory.*,materials.materials from material_inventory,materials where material_inventory.material_id=materials.id  order by material_inventory.id asc";
$res=mysqli_query($con,$sql);
?>

<section>
  <!--for demo wrap-->
  <h1>Material Inventory</h1>
  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
        <th>Item</th>
          <th>Name</th>
          <th>Stock</th>
          <th>Used</th>
          <th>Balance</th>
          <th>Purpose</th>
        </tr>
      </thead>
    </table>
  </div>
  
        
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody> 
      <?php 
							while($row=mysqli_fetch_assoc($res)){?>
      <tr>
      <?php 
							if(isset($_SESSION["user_id"])) { 
							if($row["PostedBy"] === $_SESSION["user_id"]){?>
							   <td><?php echo $row['id']?></td>
                 <td><?php echo $row['materials']?></td>
							   <td><?php echo $row['stock']?></td>
							   <td><?php echo $row['used']?></td>
							   <td><?php echo $row['balance']?></td>
							   <td><?php echo $row['purpose']?></td>
        <?php }
        }else{
      }
								?>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>


<button id="payment-button" onclick="window.print()" class="btn btn-lg btn-info btn-block">
  <span id="">Print</span>
  </button>


  <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
      <script src="js/report_summary.js" type="text/javascript"></script>
</body>
</html>