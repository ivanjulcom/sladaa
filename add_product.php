<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>
        <!-- Start main left sidebar menu -->
        <?php
		
		if(isset($_POST['icat']))
		{
			
			
			$mtitle = stripslashes($mysqli->real_escape_string($_POST['mtitle']));
			$mstatus = $_POST['mstatus'];
			$mcat = $_POST['mcat'];
			
			
			$pincode = implode(',',$_POST['pincode']);
			$mdesc = $mysqli->real_escape_string($_POST['mdesc']);
			date_default_timezone_set("Asia/Kolkata"); 
			$rdate = date("Y-m-d H:i:s");
							
		
if(count($_FILES['cat_img']['name']) > 3)
		{
			$msgno = "Please Select Max 3 Images Allowed!!"; 
		}
		else 
		{
		
		$arr = array();
							foreach($_FILES['cat_img']['tmp_name'] as $key => $tmp_name ){
	$file_name = uniqid().$_FILES['cat_img']['name'][$key];
	
	$file_size =$_FILES['cat_img']['size'][$key];
	$file_tmp =$_FILES['cat_img']['tmp_name'][$key];
	
	$file_type = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
	

	
	move_uploaded_file($file_tmp,"assets/product/".$file_name);
	$arr[] = "assets/product/".$file_name;

							}
							$related = implode(',',$arr);
							
				

$store_id = $sdata['id'];
  $table="tbl_product";
  $field_values=array("m_img","mtitle","mstatus","mcat","pincode","mdesc","rdate","sid");
  $data_values=array("$related","$mtitle","$mstatus","$mcat","$pincode","$mdesc","$rdate","$store_id");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'product Section!!',
    message: 'product Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="add_product.php";}, 3000);
</script>
<?php 
		
		
		}
		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			
			
			                $mtitle = stripslashes($mysqli->real_escape_string($_POST['mtitle']));
			$mstatus = $_POST['mstatus'];
			$mcat = $_POST['mcat'];
			
			
			$pincode = implode(',',$_POST['pincode']);
			
			
			

			 $mdesc = $mysqli->real_escape_string($_POST['mdesc']);
			date_default_timezone_set("Asia/Kolkata"); 
			$rdate = date("Y-m-d H:i:s");
			
			
	if(empty($_FILES['cat_img']['name'][0]))
							{
								$table="tbl_product";
						
  $field=array('mtitle'=>$mtitle,'mstatus'=>$mstatus,'mcat'=>$mcat,'pincode'=>$pincode,'mdesc'=>$mdesc);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'product Section!!',
    message: 'product Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="list_product.php";}, 3000);
</script>
<?php 
								
							}
							else 
							{
								if(count($_FILES['cat_img']['name']) > 3)
		{
			$msgno = "Please Select Max 3 Images Allowed!!"; 
		}
		else 
		{
							$arr = array();
							foreach($_FILES['cat_img']['tmp_name'] as $key => $tmp_name ){
	$file_name = uniqid().$_FILES['cat_img']['name'][$key];
	
	$file_size =$_FILES['cat_img']['size'][$key];
	$file_tmp =$_FILES['cat_img']['tmp_name'][$key];
	
	$file_type = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
	

	
	move_uploaded_file($file_tmp,"assets/product/".$file_name);
	$arr[] = "assets/product/".$file_name;

	
							}
							$related = implode(',',$arr);
						$table="tbl_product";
						
  $field=array('m_img'=>$related,'mtitle'=>$mtitle,'mstatus'=>$mstatus,'mcat'=>$mcat,'pincode'=>$pincode,'mdesc'=>$mdesc);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'product Section!!',
    message: 'product Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="list_product.php";}, 3000);
</script>
<?php 
	
		}
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
					<h1>Edit product</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add product</h1>
				<?php } ?>
                </div>
				
				<div class="card">
				
				
				<?php 
				if(isset($_GET['id']))
				{
					$sels = $mysqli->query("select * from tbl_product where id=".$_GET['id']."")->fetch_assoc();
					?>
					
                                <form method="post" enctype="multipart/form-data" onsubmit="return postForm()">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Images(Max 3 Images)</label>
									<input type="file" name="cat_img[]" class="form-control-file" id="projectinput8"  multiple>
									<?php 
									$im_list = explode(',',$sels['m_img']);
									foreach($im_list as $ilist)
									{
										?>
										<img src="<?php echo $ilist;?>" width="100px" height="100px"/>
										<?php 
									}
									?>
								</div>
								</div>
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Title</label>
									<input type="text" name="mtitle" placeholder="Enter product Title" value="<?php echo $sels['mtitle'];?>" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								
								
								
								
								
                             
							
							 

  	

<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">product Status </label>
									<select name="mstatus" class="form-control" required>
									<option value="">Select product Status</option>
									<option value="1" <?php if($sels['mstatus'] == 1){echo 'selected';}?>>Publish</option>
									<option value="0" <?php if($sels['mstatus'] == 0){echo 'selected';}?>>Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Category(Import ID)</label>
									<select name="mcat" class="form-control chosen-select" required>
									<option value="">Select product Category</option>
									<?php 
									$web = $mysqli->query("select * from category where cat_status=1 and id IN(".$sdata['scat'].")");
									while($row = $web->fetch_assoc())
									{
										?>
										<option value="<?php echo $row['id'];?>" <?php if($row['id'] == $sels['mcat']){echo 'selected';}?>><?php echo $row['cat_name'].'('.$row['id'].')';?></option>
										<?php 
									}
									?>
									</select>
								</div>
								</div>
								
								
								
 
											
											<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
								<label for="cname">Pincode?(Import ID)</label>
							<select id="projectinput6" name="pincode[]" class="form-control" style="height:auto" multiple required>
											
									<?php 
									$web = $mysqli->query("select * from tbl_pincode where status=1 and id IN(".$sdata['aid'].")");
									$people = explode(',',$sels['pincode']);
									while($row = $web->fetch_assoc())
									{
										?>
										<option value="<?php echo $row['id'];?>" <?php if(in_array($row['id'], $people)){echo 'selected';}?>><?php echo $row['pincode'].'('.$row['id'].')';?></option>
										<?php 
									}
									?>	
												
											</select>
											</div>
											</div>
							
							

<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">product Description </label>
									<textarea class="form-control" rows="5" name="mdesc" id="mdesc" style="resize: none;"><?php echo $sels['mdesc'];?></textarea>
								</div>
							</div>							
								
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update product</button>
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
									<label>product Images(Max 3 Images)</label>
									<input type="file" name="cat_img[]" class="form-control-file" id="projectinput8" required multiple>
								</div>
								</div>
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Title</label>
									<input type="text" name="mtitle" placeholder="Enter product Title" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								
								
								
								
								
                             
							
							 

  	

<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">product Status </label>
									<select name="mstatus" class="form-control" required>
									<option value="">Select product Status</option>
									<option value="1">Publish</option>
									<option value="0">Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Category(Import ID)</label>
									<select name="mcat" class="form-control chosen-select" required>
									<option value="">Select product Category</option>
									<?php 
									$web = $mysqli->query("select * from category where cat_status=1 and id IN(".$sdata['scat'].")");
									while($row = $web->fetch_assoc())
									{
										?>
										<option value="<?php echo $row['id'];?>"><?php echo $row['cat_name'].'('.$row['id'].')';?></option>
										<?php 
									}
									?>
									</select>
								</div>
								</div>
								
								
								

											
											<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
								<label for="cname">Pincode?(Import ID)</label>
							<select id="projectinput6" name="pincode[]" class="form-control" style="height:auto" multiple required>
											
									<?php 
									$web = $mysqli->query("select * from tbl_pincode where status=1 and  id IN(".$sdata['aid'].")");
									while($row = $web->fetch_assoc())
									{
										?>
										<option value="<?php echo $row['id'];?>"><?php echo $row['pincode'].'('.$row['id'].')';?></option>
										<?php 
									}
									?>	
												
											</select>
											</div>
											</div>
							
							

<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">product Description </label>
									<textarea class="form-control" rows="5" id="mdesc" name="mdesc" style="resize: none;"></textarea>
								</div>
							</div>							
								
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add product</button>
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
	$('#mdesc').summernote({
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
	var content = $('textarea[name="mdesc"]').html($('#mdesc').code());
}
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
	<script>
	$(".chosen-select").chosen();
	</script>
 <style>
 .chosen-container.chosen-container-single {
    width: 100% !important;
}
.chosen-container-single .chosen-single
{
	    height: 40px;
    background: white;
    font-size: 14px;
    color: #000 !important;
    padding: 10px 12px;
	border: 1px solid #ced4da !important; 
}
.chosen-container-single .chosen-single div b
{
	    margin-top: 50%;
}
 
 </style>
 
</body>


</html>