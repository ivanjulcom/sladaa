<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        <?php 
		if(isset($_POST['icat']))
		{
			
			
			$okey = $_POST['status'];
			$cid = $_POST['bcat'];
			$target_dir = "assets/category/catimg/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
   
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				


  $table="banner";
  $field_values=array("img","status","cid");
  $data_values=array("$target_file","$okey","$cid");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Banner Section!!',
    message: 'Banner Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="add_banner.php";}, 3000);
</script>
<?php 
		
		
		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			
			$cid = $_POST['bcat'];
			$okey = $_POST['status'];
			$target_dir = "assets/category/catimg/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
    
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="banner";
  $field = array('status'=>$okey,'img'=>$target_file,'cid'=>$cid);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Banner Section!!',
    message: 'Banner Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="list_banner.php";}, 3000);
</script>
<?php 
		
		
	}
	else 
	{
		
		$table="banner";
  $field = array('status'=>$okey,'cid'=>$cid);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Banner Section!!',
    message: 'Banner Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="list_banner.php";}, 3000);
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
					<h1>Edit Banner</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add Banner</h1>
				<?php } ?>
                </div>
				
				<div class="card">
				
				
				<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from banner where id=".$_GET['id']."")->fetch_assoc();
					?>
					<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        
                                        <div class="form-group">
                                            <label>Banner Image</label>
                                            <input type="file" class="form-control" name="cat_img">
											<img src="<?php echo $data['img']?>" width="100px"/>
                                        </div>
										
										<div class="form-group">
                                            <label>Banner Category</label>
                                            <select name="bcat" class="form-control">
											<option value="0">Unclickable</option>
											<?php 
											$cat = $mysqli->query("select * from category where cat_status=1");
											while($row = $cat->fetch_assoc())
											{
												?>
												<option value="<?php echo $row['id'];?>" <?php if($row['id'] == $data['cid']) {echo 'selected';}?>><?php echo $row['cat_name'];?></option>
												<?php 
											}
											?>
											</select>
                                        </div>
										
										 <div class="form-group">
                                            <label>Banner Status</label>
                                            <select name="status" class="form-control">
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update Banner</button>
                                    </div>
                                </form>
					<?php 
				}
				else 
				{
					?>
                                <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        
                                        <div class="form-group">
                                            <label>Banner Image</label>
                                            <input type="file" class="form-control" name="cat_img"  required="">
                                        </div>
										
										<div class="form-group">
                                            <label>Banner Category</label>
                                            <select name="bcat" class="form-control">
											<option value="0">Unclickable</option>
											<?php 
											$cat = $mysqli->query("select * from category where cat_status=1");
											while($row = $cat->fetch_assoc())
											{
												?>
												<option value="<?php echo $row['id'];?>"><?php echo $row['cat_name'];?></option>
												<?php 
											}
											?>
											</select>
                                        </div>
										
										 <div class="form-group">
                                            <label>Banner Status</label>
                                            <select name="status" class="form-control">
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add Banner</button>
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