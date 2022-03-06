 <?php 
require 'include/navbar.php';
require 'include/sidebar.php';

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
							$area_id = $_POST['area_id'];
							$commission = $_POST['commission'];
							
						$check_email = $mysqli->query("select * from rider where email='".$email."'")->num_rows;
						$check_mobile = $mysqli->query("select * from rider where mobile='".$dcharge."'")->num_rows;
			
				
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
							

  $table="rider";
  $field_values=array("name","mobile","email","aid","status","address","password","commission");
  $data_values=array("$cname","$dcharge","$email","$area_id","$status","$raddress","$password","$commission");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Delivery Boy Section!!',
    message: 'Delivery Boy Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}

?>
<script>
setTimeout(function(){ window.location.href="list_deliveryboy.php";}, 3000);
</script>
<?php 
		
		
		}
		}
		?>
		
	
		

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
				
                    <h1>Add Delivery Boy <i class="fas fa-motorcycle"></i></h1>
				
                </div>
				
				<div class="card">
				
				
				
                                <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="form-body row">
								

								
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Delivery Boy Name</label>
									<input type="text" id="aname" class="form-control" placeholder="Enter Delivery Boy Name"  name="cname" required >
								</div>
								</div>
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								
								<div class="form-group">
									<label for="cname">Delivery Boy Mobile Number(Only Digit)</label>
									<input type="text" id="dcharge"  maxlength="10" class="form-control" pattern="[0-9]+"  placeholder="Enter Delivery Boy Mobile Number" name="dcharge" required >
								</div>
								</div>
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Delivery Boy Email Address</label>
									<input type="email"   class="form-control"   placeholder="Enter Delivery Boy Email Address" name="email" required >
								</div>
								</div>
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Delivery Boy Password</label>
									<input type="text"   class="form-control"   placeholder="Enter Delivery Boy Password" name="password" required >
								</div>
								</div>
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
 	
 <div class="form-group">
									<label for="cname">Select A Pincode</label>
									<select name="area_id" id="sub_list" class="form-control chosen-select" required>
									   <option value="">Select A Pincode</option>
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
									<label for="cname">Delivery Boy Commission(Admin %)</label>
									<input type="number"   class="form-control"   placeholder="Enter Delivery Boy Commission" name="commission" required >
								</div>
								</div>

 	<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Delivery Boy  Address</label>
								<textarea style="resize: none;min-height:120px;" class="form-control" name="raddress"></textarea>
								</div>
								</div>
								

							

								
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add Delivery Boy <i class="fas fa-motorcycle"></i></button>
                                    </div>
                                </form>
				
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
 .select2-container {
    width: 100% !important;
}
 </style>

</html>