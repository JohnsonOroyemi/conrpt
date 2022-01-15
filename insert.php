<?php
require('connection.php');

if(isset($_POST["item_name"]))
{
 $item_name = $_POST["item_name"];
 $item_code = $_POST["item_file"];
 $item_desc = $_POST["item_previous"];
 $item_price = $_POST["item_actual"];
 $item_desc = $_POST["item_challenges"];
 $item_price = $_POST["item_date"];
 $query = '';
 for($count = 0; $count<count($item_name); $count++)
 {
  $item_name_clean = mysqli_real_escape_string($con, $item_name[$count]);
  $item_file_clean = mysqli_real_escape_string($con, $item_file[$count]);
  $item_previous_clean = mysqli_real_escape_string($con, $item_previous[$count]);
  $item_actual_clean = mysqli_real_escape_string($con, $item_actual[$count]);
  $item_challenges_clean = mysqli_real_escape_string($con, $item_challenges[$count]);
  $item_date_clean = mysqli_real_escape_string($con, $item_date[$count]);
  if($item_name_clean != '' && $item_file_clean  != '' &&  $item_previous_clean!= '' &&   $item_actual_clean != '' &&  $item_challenges_clean != '' && $item_date_clean != '')
  {
   $query .= '
   INSERT INTO work_accomplished (item_name, item_file, item_previous, item_actual, item_challenges, item_date) 
   VALUES("'.$item_name_clean.'", "'.$item_file_clean.'", "'.$item_previous_clean.'", "'.$item_actual_clean.'", "'.$item_challenges_clean.'", "'.$item_date_clean.'"); 
   ';
  }
 }
 if($query != '')
 {
  if(mysqli_multi_query($con, $query))
  {
   echo 'Item Data Inserted';
  }
  else
  {
   echo 'Error';
  }
 }
 else
 {
  echo 'All Fields are Required';
 }
}
?>
