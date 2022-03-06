<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        <?php 
		if(isset($_POST['icat']))
		{
			
			
			$ccode = $mysqli->real_escape_string($_POST['ccode']);
							$cdate = $_POST['cdate'];
							$minamt = $_POST['minamt'];
							$ctitle = $mysqli->real_escape_string($_POST['ctitle']);
							$cstatus = $_POST['cstatus'];
							$cvalue = $_POST['cvalue'];
							$cdesc = $mysqli->real_escape_string($_POST['cdesc']);
							
			$target_dir = "assets/category/coupon/";
			$temp = explode(".", $_FILES["f_up"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
		
		
   
			
		move_uploaded_file($_FILES["f_up"]["tmp_name"], $target_file);
				


  $table="tbl_coupon";
  $store_id = $sdata['id'];
  $field_values=array("c_img","c_desc","c_value","c_title","status","cdate","ctitle","min_amt","sid");
  $data_values=array("$target_file","$cdesc","$cvalue","$ccode","$cstatus","$cdate","$ctitle","$minamt","$store_id");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Coupon Section!!',
    message: 'Coupon Code Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="add_coupon.php";}, 3000);
</script>
<?php 
		
		
		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			
			
			                $ccode = $mysqli->real_escape_string($_POST['ccode']);
							$cdate = $_POST['cdate'];
							$minamt = $_POST['minamt'];
							$ctitle = $mysqli->real_escape_string($_POST['ctitle']);
							$cstatus = $_POST['cstatus'];
							$cvalue = $_POST['cvalue'];
							$cdesc = $mysqli->real_escape_string($_POST['cdesc']);
							
			$target_dir = "assets/category/coupon/";
			$temp = explode(".", $_FILES["f_up"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["f_up"]["name"] != '')
	{		
    
			
		move_uploaded_file($_FILES["f_up"]["tmp_name"], $target_file);
				 
$table="tbl_coupon";
  $field=array('c_img'=>$target_file,'c_desc'=>$cdesc,'c_value'=>$cvalue,'c_title'=>$ccode,'status'=>$cstatus,'cdate'=>$cdate,'ctitle'=>$ctitle,'min_amt'=>$minamt);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	   $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Coupon Section!!',
    message: 'Coupon Code Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="list_coupon.php";}, 3000);
</script>
<?php 
		
		
	}
	else 
	{
		
		$table="tbl_coupon";
  $field=array('c_desc'=>$cdesc,'c_value'=>$cvalue,'c_title'=>$ccode,'status'=>$cstatus,'cdate'=>$cdate,'ctitle'=>$ctitle,'min_amt'=>$minamt);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Coupon Section!!',
    message: 'Coupon Code Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="list_coupon.php";}, 3000);
</script>
<?php 
	}
		}
		?>
		

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
				<?php 
				if(isset($_GET['id']))
				{
					?>
					<h1>Edit Coupon</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add Coupon</h1>
				<?php } ?>
                </div>
				
				<div class="card">
				
				
				<?php 
				if(isset($_GET['id']))
				{
					$sels = $mysqli->query("select * from tbl_coupon where id=".$_GET['id']."")->fetch_assoc();
					?>
					<form method="post" enctype="multipart/form-data" onsubmit="return postForm()">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Image</label>
									<input type="file" name="f_up" class="form-control-file" id="projectinput8" >
									<br>
									<img src="<?php echo $sels['c_img'];?>" width="100" height="100"/>
								</div>
								</div>
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Expiry Date</label>
									<input type="date" name="cdate" value="<?php echo $sels['cdate'];?>" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
								
									<label for="cname">Coupon Code </label>
									<div class="row">
								<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
									<input type="text" id="ccode" value="<?php echo $sels['c_title'];?>" class="form-control" onkeypress="return isNumberKey(event)" 
    maxlength="8" name="ccode" oninput="this.value = this.value.toUpperCase()" required >
									</div>
									
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
									<button id="gen_code" class="btn btn-success"><i class="fas fa-sync" aria-hidden="true"></i></button>
									</div>
									</div>
								</div>
								</div>
								
								
                             
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon title </label>
									<input type="text"  class="form-control" value="<?php echo $sels['ctitle'];?>"  name="ctitle" required >
								</div>
							</div>
							

  

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Status </label>
									<select name="cstatus" class="form-control" required>
									<option value="">Select Coupon Status</option>
									<option value="1" <?php if($sels['status'] == 1){echo 'selected';}?>>Publish</option>
									<option value="0" <?php if($sels['status'] == 0){echo 'selected';}?>>Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Min Order Amount</label>
									<input type="number" id="cname" value="<?php echo $sels['min_amt'];?>" class="form-control"  name="minamt" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
								</div>
								
							
 <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Value </label>
									<input type="number" id="cname" class="form-control"  value="<?php echo $sels['c_value'];?>" name="cvalue" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
							</div>

<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Description </label>
									<textarea class="form-control" rows="5" id="cdesc" name="cdesc" style="resize: none;"><?php echo $sels['c_desc'];?></textarea>
								</div>
							</div>							
								
							</div>

								
							
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update Coupon</button>
                                    </div>
                                </form>
					<?php 
				}
				else 
				{
					?>
                                <form method="post" enctype="multipart/form-data" onsubmit="return postForm()">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Image</label>
									<input type="file" name="f_up" class="form-control-file" id="projectinput8" required>
								</div>
								</div>
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Expiry Date</label>
									<input type="date" name="cdate" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
								
									<label for="cname">Coupon Code </label>
									<div class="row">
								<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
									<input type="text" id="ccode" class="form-control" onkeypress="return isNumberKey(event)" 
    maxlength="8" name="ccode" required  oninput="this.value = this.value.toUpperCase()">
									</div>
									
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
									<button id="gen_code" class="btn btn-success"><i class="fas fa-sync" aria-hidden="true"></i></button>
									</div>
									</div>
								</div>
								</div>
								
								
                             
							
							 <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon title </label>
									<input type="text"  class="form-control"  name="ctitle" required >
								</div>
							</div>

  	

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Status </label>
									<select name="cstatus" class="form-control" required>
									<option value="">Select Coupon Status</option>
									<option value="1">Publish</option>
									<option value="0">Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Min Order Amount</label>
									<input type="number" id="cname"  class="form-control"  name="minamt" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
								</div>
								
 <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Value</label>
									<input type="number" id="cname" class="form-control"  name="cvalue" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
							</div>

<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Description </label>
									<textarea class="form-control" rows="5" id="cdesc" name="cdesc" style="resize: none;"></textarea>
								</div>
							</div>							
								
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add Coupon</button>
                                    </div>
                                </form>
				<?php } ?>
                            </div>
            </div>
					
                
            </section>
        </div>
        
       
    </div>
</div>

<?php require 'include/footer.php';?>

<script type="text/javascript">
$(document).ready(function() {
	$('#cdesc').summernote({
		height: "500px",
		toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]
	});
});
var postForm = function() {
	var content = $('textarea[name="cdesc"]').html($('#cdesc').code());
}
</script>

 <script>
 function makeid(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

 

$(document).ready(function()
{
	$(document).on('click','#gen_code',function()
	{
		$('#ccode').val(makeid(8));
		return false;
	});
	
});

</script>
</body>


</html>