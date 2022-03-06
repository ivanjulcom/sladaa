<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        <?php
		
		if(isset($_POST['icat']))
		{
			$product = $_POST['product'];
			$mprice = $_POST['mprice'];
			$mtype = stripslashes($mysqli->real_escape_string(trim($_POST['mtype'])));
			$mdiscount = $_POST['mdiscount'];
			$mstock = $_POST['mstock'];
$store_id = $sdata['id'];
  $table="tbl_product_attribute";
  $field_values=array("pid","price","title","discount","ostock","sid");
  $data_values=array("$product","$mprice","$mtype","$mdiscount","$mstock","$store_id");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Attributes Section!!',
    message: 'product Attributes Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="add_product_attributes.php";}, 3000);
</script>
<?php 
		
		
		}
		
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			
			
			            $product = $_POST['product'];
			$mprice = $_POST['mprice'];
			$mtype = stripslashes($mysqli->real_escape_string(trim($_POST['mtype'])));
			$mdiscount = $_POST['mdiscount'];
			$mstock = $_POST['mstock'];
			
			$table="tbl_product_attribute";
						
    $field=array('pid'=>$product,'price'=>$mprice,'title'=>$mtype,'discount'=>$mdiscount,'ostock'=>$mstock);
  
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Attributes Section!!',
    message: 'product Attributes Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="list_product_attributes.php";}, 3000);
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
					<h1>Edit product Attributes</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add product Attributes</h1>
				<?php } ?>
                </div>
				
				<div class="card">
				
				<?php 
				if(isset($_GET['id']))
				{
					$sels = $mysqli->query("select * from tbl_product_attribute where id=".$_GET['id']."")->fetch_assoc();
					?>
					
                                <form method="post" enctype="multipart/form-data" onsubmit="return postForm()">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">
								
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Select product</label>
									<select name="product" class="form-control chosen-select" required>
									<option value="">Select product</option>
									<?php 
									$product = $mysqli->query("select * from tbl_product where sid=".$sdata['id']."");
									while($rmed = $product->fetch_assoc())
									{
									?>
									<option value="<?php echo $rmed['id'];?>" <?php if($sels['pid'] == $rmed['id']){echo 'selected';}?>><?php echo $rmed['mtitle'];?></option>
									<?php } ?>
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Price</label>
									<input type="number" name="mprice" placeholder="Enter product Price" value="<?php echo $sels['price'];?>" class="form-control" required onkeypress='return event.charCode >= 48 && event.charCode <= 57' >
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Type</label>
									<input type="text" name="mtype" placeholder="Enter product Type"  value="<?php echo $sels['title'];?>" class="form-control" required>
								</div>
								</div>
								
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Discount</label>
									<input type="number" name="mdiscount" placeholder="Enter product Discount" value="<?php echo $sels['discount'];?>" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Out OF Stock?</label>
									<select name="mstock" class="form-control" required>
									<option value="">Select Status</option>
									<option value="1" <?php if($sels['ostock'] == 1){echo 'selected';}?>>Yes</option>
									<option value="0" <?php if($sels['ostock'] == 0){echo 'selected';}?>>No</option>
									
									</select>
								</div>
								</div>
								
							

				
								
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" type="submit" class="btn btn-primary">Update product</button>
                                    </div>
                                </form>
								
					<?php 
				}
				else 
				{
					?>
					
					
			
			
			
			
	
			
			
                                <form method="post" >
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">
								
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Select product</label>
									<select name="product" class="form-control chosen-select" required>
									<option value="">Select product</option>
									<?php 
									$product = $mysqli->query("select * from tbl_product where sid=".$sdata['id']."");
									while($rmed = $product->fetch_assoc())
									{
									?>
									<option value="<?php echo $rmed['id'];?>"><?php echo $rmed['mtitle'];?></option>
									<?php } ?>
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Price</label>
									<input type="number" name="mprice" placeholder="Enter product Price" value="" class="form-control" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Type</label>
									<input type="text" name="mtype" placeholder="Enter product Type" value="" class="form-control" required>
								</div>
								</div>
								
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Discount</label>
									<input type="number" name="mdiscount" placeholder="Enter product Discount" value="0" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Out OF Stock?</label>
									<select name="mstock" class="form-control" required>
									<option value="">Select Status</option>
									<option value="1" >Yes</option>
									<option value="0">No</option>
									
									</select>
								</div>
								</div>
								
							

				
								
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add product Attributes</button>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
	<script>
	$(".chosen-select").chosen();
	</script>
 <style>
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

</html>