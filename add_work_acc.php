<?php
ob_start();
session_start();
require('top.inc.php');
$work_activities_id='';
$file='';
$previous	='';
$actual	='';
$challenges	='';
$date	='';
$postedby='';
$file_required='';
$msg='';
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Work Accomplished</strong><small> Form</small></div>
  
<div class="table-responsive">
    <table class="table table-bordered" id="crud_table">
    <thead>
     <tr>
      <th>Activities</th>
      <th>File</th>
      <th>Previous % Completion</th>
      <th>Actual % Completion</th>
      <th>Challenges</th>
      <th>Date</th>
     </tr>
     </thead>

     <tbody>
     <tr>
     
      <td contenteditable="true" class="item_name"> 
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
									</select></td>
      <td ><input  class="item_file" type="file" name="file" class="form-control" <?php echo  $file_required?>></td>

      <td contenteditable="true" class="item_previous" name="previous" placeholder="Enter previous % completion" class="form-control"><?php echo $previous?></td>

      <td contenteditable="true" class="item_actual" placeholder="Enter actual % completion" class="form-control" required><?php echo $actual?></td>

      <td contenteditable="true" class="item_challenges"  placeholder="Enter challenges encountered on item of work" class="form-control" required><?php echo $challenges?></td>

      <td><input type="date" placeholder="Enter reporting date" class="item_date" required value="<?php echo $date?>"></td>
    
     </tr>
     </tbody>
    </table>
    <div align="right">
     <button type="button" name="add" id="add" class="btn btn-success btn-xs">+</button>
    </div>
    <div align="center">
     <button type="button" name="save" id="save" class="btn btn-info">Save</button>
    </div>
    <br />
    <div id="inserted_item_data"></div>
   </div>
  </div>
                     </div>
                  </div>
               </div>
            </div>



         <script>
$(document).ready(function(){
 var count = 1;
 $('#add').click(function(){
  count = count + 1;
  var html_code = "<tr id='row"+count+"'>";
   html_code += "<td  class='item_name'>  <select class='form-control' name='work_activities_id' ><option>Select activity</option><?php  $select_work_act =  "SELECT id,work_activities FROM work_activities order by work_activities asc"; $res=mysqli_query($con,$select_work_act);while($row=mysqli_fetch_assoc($select_work_act)){if($row['id']==$categories_id){ echo '<option selected value='.$row['id'].'>'.$row['work_activities'].'</option>'; }else{ echo '<option value='.$row['id'].'>'.$row['work_activities'].'</option>'; } }?></select></td>";
   html_code += "<td  class='item_file'><input type='file' name='file' class='form-control' <?php echo  $file_required?>></td>";
   html_code += "<td contenteditable='true' class='item_previous'></td>";
   html_code += "<td contenteditable='true' class='item_actual'></td>";
   html_code += "<td contenteditable='true' class='item_challenges'></td>";
   html_code += "<td  class='item_date'><input type='date' placeholder='Enter reporting date'  required value='<?php echo $date?>'></td>";
   html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
   html_code += "</tr>";  
   $('#crud_table').append(html_code);
 });
 
 $(document).on('click', '.remove', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
 });
 
 $('#save').click(function(){
  var item_name = [];
  var item_file = [];
  var item_previous = [];
  var item_actual = [];
  var item_challenges = [];
  var item_date = [];
  $('.item_name').each(function(){
   item_name.push($(this).find('input').val());
});
  $('.item_file').each(function(){
   var filename = $('input[type=file]').val().split('\\').pop();      
   image.push(filename);
  });
  $('.item_previous').each(function(){
   item_previous.push($(this).text());
  });
  $('.item_actual').each(function(){
   item_actual.push($(this).text());
  });
  $('.item_challenges').each(function(){
   item_challenges.push($(this).text());
  });
  $('.item_date').each(function(){
   item_date.push($(this).find('input').val());
});
  $.ajax({
   url:"insert.php",
   method:"POST",
   data:{item_name:item_name, item_file:item_file, item_previous:item_previous, item_actual:item_actual, item_challenges:item_challenges, item_date:item_date},
   success:function(data){
    alert(data);
    $("td[contentEditable='true']").text("");
    for(var i=2; i<= count; i++)
    {
     $('tr#'+i+'').remove();
    }
   }
  });
 });
});
</script>

<?php
require('footer.inc.php');
?>

