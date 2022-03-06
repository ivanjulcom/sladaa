<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>
        <!-- Start main left sidebar menu -->
        <?php 
		if(isset($_POST['icat']))
		{
			$cname = mysqli_real_escape_string($mysqli,$_POST['cname']);
							$status = $_POST['status'];
							$dcharge = $_POST['dcharge'];
							$password = $_POST['password'];
							$email = $_POST['email'];
							$raddress = $_POST['raddress'];
							$area_id = implode(',',$_POST['area_id']);
							$accname = $_POST['accname'];
							$accnum = $_POST['accnum'];
							$commission = $_POST['commission'];
							$ifsc = $_POST['ifsc'];
							$upimob = $_POST['upimob'];
							
							$star = $_POST['star'];
							$check_email = $mysqli->query("select * from vendor where email='".$email."'")->num_rows;
						$check_mobile = $mysqli->query("select * from vendor where mobile='".$dcharge."'")->num_rows;
							$scat = implode(',',$_POST['scat']);
							$target_dir = "assets/category/catimg/";
						$temp = explode(".", $_FILES["v_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);

						if($check_email != 0)
						{
							?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Store Section!!',
    message: 'Email Address Already Used!!',
    position: 'topRight'
  });
  </script>
  
<?php 
						}
						
else if($check_mobile != 0)
						{
							?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Store Section!!',
    message: 'Mobile Number Already Used!!',
    position: 'topRight'
  });
  </script>
  
<?php 
						}
						else 
						{
							move_uploaded_file($_FILES["v_img"]["tmp_name"], $target_file);
  $table="vendor";
  
  $field_values=array("name","mobile","email","aid","status","address","password","upimob","accname","accnum","ifsc","v_img","scat","commission","star");
  $data_values=array("$cname","$dcharge","$email","$area_id","$status","$raddress","$password","$upimob","$accname","$accnum","$ifsc","$target_file","$scat","$commission","$star");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Store Section!!',
    message: 'Store Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}

?>
<script>
setTimeout(function(){ window.location.href="list_store.php";}, 3000);
</script>
<?php 
		
		
		}
		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			$cname = mysqli_real_escape_string($mysqli,$_POST['cname']);
							$status = $_POST['status'];
							$dcharge = $_POST['dcharge'];
							$password = $_POST['password'];
							$email = $_POST['email'];
							$raddress = $_POST['raddress'];
							$area_id = implode(',',$_POST['area_id']);
							$accname = $_POST['accname'];
							$accnum = $_POST['accnum'];
							$commission = $_POST['commission'];
							$ifsc = $_POST['ifsc'];
							$upimob = $_POST['upimob'];
							
							$star = $_POST['star'];
							$scat = implode(',',$_POST['scat']);
			if($_FILES["v_img"]["name"] != '')
								{
									$target_dir = "assets/category/catimg/";
								$temp = explode(".", $_FILES["v_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
	

	move_uploaded_file($_FILES["v_img"]["tmp_name"], $target_file);
	$table="vendor";
  $field = array('name'=>$cname,'mobile'=>$dcharge,'email'=>$email,'aid'=>$area_id,'status'=>$status,'address'=>$raddress,'password'=>$password,'upimob'=>$upimob,'accname'=>$accname,'accnum'=>$accnum,'ifsc'=>$ifsc,'v_img'=>$target_file,'scat'=>$scat,'commission'=>$commission,'star'=>$star);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Store Section!!',
    message: 'Store Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}



								}
								else 
								{
								
	$table="vendor";
  $field = array('name'=>$cname,'mobile'=>$dcharge,'email'=>$email,'aid'=>$area_id,'status'=>$status,'address'=>$raddress,'password'=>$password,'upimob'=>$upimob,'accname'=>$accname,'accnum'=>$accnum,'ifsc'=>$ifsc,'scat'=>$scat,'commission'=>$commission);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Store Section!!',
    message: 'Store Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
								}
			
?>
<script>
setTimeout(function(){ window.location.href="list_store.php";}, 3000);
</script>
<?php 
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
					<h1>Edit Store</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add Store</h1>
				<?php } ?>
                </div>
				
				<div class="card">
				
				
				<?php 
				if(isset($_GET['id']))
				{
					$vinfo = $mysqli->query("select * from vendor where id=".$_GET['id']."")->fetch_assoc();
	
	if($vinfo['email'] == '')
	{
		?>
		<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.error({
    title: 'Operation DISABLED!!',
    message: 'Store Not Exist!!',
    position: 'topRight'
  });
  setTimeout(function(){ window.location.href="list_store.php";}, 1500);
	 </script>
		<?php 
	}
					?>
					<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                       <h5>Personal Information</h5>
						<hr style="    padding: 0px;
    margin-top: 0px;"> 
							<div class="form-body row">
								

								
<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Store Name</label>
									<input type="text" id="aname" class="form-control" placeholder="Enter Store Name"  name="cname" value="<?php echo $vinfo['name'];?>" required >
								</div>
								</div>
								<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Store Mobile Number(Only Digit)</label>
									<input type="text" id="dcharge"  value="<?php echo $vinfo['mobile'];?>" class="form-control" pattern="[0-9]+"  placeholder="Enter Store Mobile Number" name="dcharge" required >
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Store Email Address</label>
									<input type="email"   class="form-control"   value="<?php echo $vinfo['email'];?>" placeholder="Enter Store Email Address" name="email" required >
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Store Image</label>
									<input type="file"   class="form-control"    name="v_img"  ><br>
									<img src="<?php echo $vinfo['v_img'];?>" width="100" height="100"/>
								</div>
								</div>
								
								
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Star Of store?</label>
									<select name="star" class="form-control" required>
									<option value="">Select A Rating</option>
									<option value="1" <?php if($vinfo['star'] == 1){echo 'selected';}?>>1</option>
									<option value="2" <?php if($vinfo['star'] == 2){echo 'selected';}?>>2</option>
									<option value="3" <?php if($vinfo['star'] == 3){echo 'selected';}?>>3</option>
									<option value="4" <?php if($vinfo['star'] == 4){echo 'selected';}?>>4</option>
									<option value="5" <?php if($vinfo['star'] == 5){echo 'selected';}?>>5</option>
									</select>
								</div>
								</div>
								
								
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Store Password</label>
									<input type="text"   class="form-control" value="<?php echo $vinfo['password'];?>"  placeholder="Enter Store Password" name="password" required >
								</div>
								</div>
								
								
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
 	<div class="form-group">
									<label for="cname">Select A Pincode</label>
									<select name="area_id[]" id="sub_list" class="form-control" multiple style="height:120px;" required>
									   

<?php
                                    $store = explode(',',$vinfo['aid']);
                                      									
									$sel = $mysqli->query("select * from tbl_pincode");
									while($rs = $sel->fetch_assoc())
									{
										
										?>
										<option value="<?php echo $rs['id'];?>" <?php if(in_array($rs['id'],$store)){echo 'selected';} ?>><?php echo $rs['pincode'];?></option>
										<?php 
									}
									?>
									   
									</select>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">	
									<div class="form-group">
									<label for="cname">Status</label>
									<select name="status" class="form-control">
									    <option value="1" <?php if($vinfo['status'] == 1){echo 'selected';} ?>>Active</option>
									    <option value="0" <?php if($vinfo['status'] == 0){echo 'selected';} ?> >Deactive</option>
									</select>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Commission(Admin)</label>
									<input type="number"   class="form-control"  value="<?php echo $vinfo['commission'];?>"  step="any" name="commission" required >
								</div>
								</div>
								
								<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Store Category</label>
									<select name="scat[]" class="form-control" multiple required style="height:120px;">
									
									<?php
                                    $store = explode(',',$vinfo['scat']);
                                      									
									$sel = $mysqli->query("select * from category");
									while($rs = $sel->fetch_assoc())
									{
										
										?>
										<option value="<?php echo $rs['id'];?>" <?php if(in_array($rs['id'],$store)){echo 'selected';} ?>><?php echo $rs['cat_name'];?></option>
										<?php 
									}
									?>
									</select>
								</div>
								</div>
								
								<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Store  Address</label>
								<textarea style="resize: none;min-height: 120px;" rows="3" cols="4" class="form-control" name="raddress" required><?php echo $vinfo['address'];?></textarea>
								</div>
								</div>
							
								
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
<h5>Payment Information</h5>
						<hr style="    padding: 0px;
    margin-top: 0px;"> 
	</div>
							

								<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Store Mobile Number(Only Digit)(UPI)</label>
									<input type="text" id="dcharge"   class="form-control" pattern="[0-9]+" value="<?php echo $vinfo['upimob'];?>" placeholder="Enter Store Mobile Number" name="upimob"  >
								</div>
								</div>
								<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Store Bank Account Name</label>
									<input type="text"   class="form-control"   value="<?php echo $vinfo['accname'];?>" placeholder="Enter Store Bank Account Name" name="accname"  >
								</div>
								</div>
								<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Store Bank Account Number</label>
									<input type="text"   class="form-control"  pattern="[0-9]+" value="<?php echo $vinfo['accnum'];?>"  placeholder="Enter Store Bank Account Number" name="accnum"  >
								</div>
								</div>
								<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Store IFSC CODE</label>
									<input type="text"   class="form-control"   value="<?php echo $vinfo['ifsc'];?>" placeholder="Enter IFSC CODE" name="ifsc"  >
								</div>
								</div>
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update Store</button>
                                    </div>
                                </form>
					<?php 
				}
				else 
				{
					?>
                                <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <h5>Personal Information</h5>
						<hr style="    padding: 0px;
    margin-top: 0px;"> 
							<div class="form-body row">
								

								
<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Store Name</label>
									<input type="text" id="aname" class="form-control" placeholder="Enter Store Name"  name="cname" required >
								</div>
								</div>
								<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Store Mobile Number(Only Digit)</label>
									<input type="text" id="dcharge"  maxlength="10" class="form-control" pattern="[0-9]+"  placeholder="Enter Store Mobile Number" name="dcharge" required >
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Store Email Address</label>
									<input type="email"   class="form-control"   placeholder="Enter Store Email Address" name="email" required >
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Store Image</label>
									<input type="file"   class="form-control"    name="v_img" required >
								</div>
								</div>
								
								
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Star Of store?</label>
									<select name="star" class="form-control" required>
									<option value="">Select A Rating</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									</select>
								</div>
								</div>
								
								
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Store Password</label>
									<input type="text"   class="form-control"   placeholder="Enter Store Password" name="password" required >
								</div>
								</div>
								
								
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
 	<div class="form-group">
									<label for="cname">Select A Pincode</label>
									<select name="area_id[]" id="sub_list" class="form-control" multiple style="height:120px;" required>
									  
									    <?php
									    $sr = $mysqli->query("select * from tbl_pincode");
									    while($r = $sr->fetch_assoc())
									    {
									    ?>
									    <option value="<?php echo $r['id'];?>"><?php echo $r['pincode'];?></option>
									    <?php } ?>
									   
									</select>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">	
									<div class="form-group">
									<label for="cname">Status</label>
									<select name="status" class="form-control">
									    <option value="1">Active</option>
									    <option value="0">Deactive</option>
									</select>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Commission(Admin)</label>
									<input type="number"   class="form-control"    step="any" name="commission" required >
								</div>
								</div>
								
								<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Store Category</label>
									<select name="scat[]" class="form-control" multiple required style="height:120px;">
									
									<?php 
									$sel = $mysqli->query("select * from category");
									while($rs = $sel->fetch_assoc())
									{
										?>
										<option value="<?php echo $rs['id'];?>"><?php echo $rs['cat_name'];?></option>
										<?php 
									}
									?>
									</select>
								</div>
								</div>
								
								<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Store  Address</label>
								<textarea style="resize: none;min-height: 120px;" rows="8" cols="8" class="form-control" name="raddress" required></textarea>
								</div>
								</div>
							
								
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
<h5>Payment Information</h5>
						<hr style="    padding: 0px;
    margin-top: 0px;"> 
	</div>
							

								<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Store Mobile Number(Only Digit)(UPI)</label>
									<input type="text" id="dcharge"   class="form-control" pattern="[0-9]+"  placeholder="Enter Store Mobile Number" name="upimob"  >
								</div>
								</div>
								<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Store Bank Account Name</label>
									<input type="text"   class="form-control"   placeholder="Enter Store Bank Account Name" name="accname"  >
								</div>
								</div>
								<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Store Bank Account Number</label>
									<input type="text"   class="form-control"  pattern="[0-9]+"  placeholder="Enter Store Bank Account Number" name="accnum"  >
								</div>
								</div>
								<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Store IFSC CODE</label>
									<input type="text"   class="form-control"   placeholder="Enter IFSC CODE" name="ifsc"  >
								</div>
								</div>
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add Store</button>
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
</body>


</html>