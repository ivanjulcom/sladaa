<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        <?php 
		if(isset($_POST['icat']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['title']);
			
			$okey = $_POST['status'];
			$popular = $_POST['cat'];
			
			
				


  $table="tbl_home_section";
  $store_id = $sdata['id'];
  $field_values=array("cid","title","status","sid");
  $data_values=array("$popular","$dname","$okey","$store_id");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Home Section!!',
    message: 'Home Section Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="add_home_section.php";}, 3000);
</script>
<?php 
		
		
		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['title']);
			
			$okey = $_POST['status'];
			$popular = $_POST['cat'];
			
	
		
		$table="tbl_home_section";
  $field = array('cid'=>$popular,'title'=>$dname,'status'=>$okey);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Home Section!!',
    message: 'Home Section Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="add_home_section.php";}, 3000);
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
					<h1>Edit Home Section</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add Home Section</h1>
				<?php } ?>
                </div>
				
				<div class="card">
				
				
				<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from tbl_home_section where id=".$_GET['id']."")->fetch_assoc();
					?>
					<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                       <div class="form-body">
								

								

								
								<div class="form-group">
									<label for="cname">Title</label>
									<input type="text" id="pimg" class="form-control"  value="<?php echo $data['title'];?>" placeholder="Enter Title" name="title" required>
								</div>
								
                                		<div class="form-group">
											<label for="projectinput6">Select Category</label>
											<select id="cat_change" name="cat" class="form-control" required>
												<option value="" selected="">Select Category</option>
												<?php 
												$sk = $mysqli->query("select * from category where cat_status=1 and id IN(".$sdata['scat'].")");
												while($h = $sk->fetch_assoc())
												{
												?>
												<option value="<?php echo $h['id'];?>" <?php if($h['id'] == $data['cid']){echo 'selected';}?>><?php echo $h['cat_name'];?></option>
												<?php } ?>
												
											</select>
										</div>
										
										
										
										<div class="form-group">
											<label for="projectinput6">Status?</label>
											<select id="sub_list" name="status" class="form-control" required>
												<option value="" selected="">Select Status</option>
												<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Yes</option>
												<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>No</option>
												
												
											</select>
										</div>

								
								
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update Home Section</button>
                                    </div>
                                </form>
					<?php 
				}
				else 
				{
					?>
                                <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="form-body">
								

								

								
								<div class="form-group">
									<label for="cname">Title</label>
									<input type="text" id="pimg" class="form-control"  placeholder="Enter Title" name="title" required>
								</div>
								
                                		<div class="form-group">
											<label for="projectinput6">Select Category</label>
											<select id="cat_change" name="cat" class="form-control" required>
												<option value="" selected="">Select Category</option>
												<?php 
												$sk = $mysqli->query("select * from category where cat_status=1 and id IN(".$sdata['scat'].")");
												while($h = $sk->fetch_assoc())
												{
												?>
												<option value="<?php echo $h['id'];?>"><?php echo $h['cat_name'];?></option>
												<?php } ?>
												
											</select>
										</div>
										
										
										
										<div class="form-group">
											<label for="projectinput6">Status?</label>
											<select  name="status" class="form-control" required>
												<option value="" selected="">Select Status</option>
												<option value="1">Yes</option>
												<option value="0">No</option>
												
												
											</select>
										</div>

								
								
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add Home Section</button>
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