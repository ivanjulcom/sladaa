 <?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
<?php 
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="tbl_pincode";
$where = "where id=".$id."";
$h = new Common();
	$check = $h->Deletedata($where,$table);

if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Pincode Section!!',
    message: 'Pincode Delete Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}

?>
<script>
setTimeout(function(){ window.location.href="list_pincode.php";}, 3000);
</script>
<?php 
}
?>
        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <div class="col-md-9 col-lg-9 col-xs-12">
					<?php 
					if(isset($_GET['payout']))
					{
						?>
						<h1>Payout Fill Form</h1>
						<?php 
					}
					else 
					{
					?>
                    <h1>Payout List</h1>
					<?php } ?>
					</div>
					
                </div>
				<div class="card">
				
                               <div class="card-body">
							   <?php 
							   if($_SESSION['ltype'] == 'Admin')
	{
						if(isset($_GET['payout']))
						{
							?>
							<form class="form" method="post"  enctype="multipart/form-data">
							<div class="form-body">
								

								

								
								<div class="form-group">
									<label for="cname">PayOut By?</label>
									<select name="pby" class="form-control" required>
									<option value="">select a Method</option>
									<option value="UPI">UPI</option>
									<option value="BANK">BANK</option>
									</select>
								</div>
								

								
<div class="form-group">
									<label for="cname">Payment Proof</label>
<input type="hidden" name="request_id" value="<?php echo $_GET['payout'];?>"/>								
								<input type="file" name="p_proof" class="form-control" required>
								</div>

								
							</div>

							 <div class="card-footer text-left">
                                        <button name="mark_com" class="btn btn-primary">Complete Payout <i class="fas fa-receipt"></i></button>
                                    </div>
							
							
						</form>
						
						<?php 
						if(isset($_POST['mark_com']))
						{
							$pby = $_POST['pby'];
							$id = $_POST['request_id'];
							
       $target_dir = "assets/category/payment/";
								$temp = explode(".", $_FILES["p_proof"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
       
        if(end($temp) != "jpg" && end($temp) != "png" && end($temp) != "jpeg") {
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Store Section!!',
    message: 'Sorry, only JPG, JPEG, PNG  files are allowed!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
else 
{
       move_uploaded_file($_FILES["p_proof"]["tmp_name"], $target_file);
						
						$status = 'completed';
						$table="payout_setting";
  $field = array('proof'=>$target_file,'p_by'=>$pby,'status'=>$status);
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'PayOut Section!!',
    message: 'Payout Sent Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}

			?>
			<script>
setTimeout(function(){ window.location.href="list_payout.php";}, 2000);
</script>
<?php 			
						}
						}
						}
						else 
						{
						?>
						
                                    <div class="table-responsive">
                                        <table class="table table-striped v_center" id="table-1">
                                            <thead>
                                                <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                               <th>Request Id</th>
                                    <th>Amount</th>
                                   
									<th>Vendor Name</th>
									<th>Upi Address</th>
                                    <th>Bank Details</th>
									<th>Vendor Mobile</th>
									<th>Request Date</th>
									 <th>Status</th>
<th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $mysqli->query("SELECT * FROM `payout_setting`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td><?php echo $row['rid'];?></td> 
                                    <td><?php echo $row['amt'].' '.$fset['currency'];?></td>
									<?php 
									$vdetails = $mysqli->query("select * from vendor where id=".$row['vid']."")->fetch_assoc();
									?>
									<td><?php echo $vdetails['name'];?></td>
									<td><?php echo $vdetails['upimob'];?></td>
									<td><?php echo 'A/C No: '.$vdetails['accnum'].'<br>'.'A/C Name: '.$vdetails['accname'].'<br>'.'IFSC CODE: '.$vdetails['ifsc'].'<br>';?></td>
									 <td><?php echo $vdetails['mobile'];?></td>
									 <td><?php echo $row['r_date'];?></td>
									 <td><?php echo ucfirst($row['status']);?></td>
                                     <td>
									 <?php if($row['status'] == 'pending') {?>
									<a href="?payout=<?php echo $row['id'];?>"><button class="btn shadow-z-2 btn-danger gradient-pomegranate">Make A Payout</button></a>
									 <?php } else { ?>
									 <p>Completed</p>
									 <?php } ?>
									</td>
                                                </tr>
<?php } ?>                                           
                                            </tbody>
                                        </table>
                                    </div>
	<?php } } else if($_SESSION['ltype'] == 'Vendor') {
		?>
		<div class="table-responsive">
                                        <table class="table table-striped v_center" id="table-1">
                                            <thead>
                                                <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                               <th>Request Id</th>
                                    <th>Amount</th>
                                   
									<th>Payment Proof</th>
									<th>Payment By(UPI,BANK A/C)</th>
                                    
									<th>Request Date</th>
									 <th>Status</th>
                                                </tr>
                                            </thead>
                                           <tbody>
                                <?php 
                                $sel = $mysqli->query("select * from payout_setting where vid=".$sdata['id']."");
                                $i=0;
                                while($row = $sel->fetch_assoc())
                                {
                                    $i= $i + 1;
                                ?>
                                <tr>
                                    
                                    <td><?php echo $i; ?></td>
			<td><?php echo $row['rid'];?></td> 
                                    <td><?php echo $row['amt'].' '.$fset['currency'];?></td>
									
									<td><?php if($row['proof'] == ''){echo 'wait_for_admin_status';}else{?>
									<img src="<?php echo $row['proof'];?>" width="100" height="100"/><?php }?></td>
									<td><?php if($row['p_by'] == ''){echo 'wait_for_admin_status';}else{echo $row['p_by'];}?></td>
									 <td><?php echo $row['r_date'];?></td>
									 <td><?php echo $row['status'];?></td>
                                   
                                   
                                </tr>
								<?php } ?>
                            </tbody>
                                        </table>
                                    </div>
		<?php 
	}else {
		?>
		<div class="table-responsive">
                                        <table class="table table-striped v_center" id="table-1">
                                            <thead>
                                                <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                               <th>Request Id</th>
                                    <th>Amount</th>
                                   
									<th>Payment Proof</th>
									<th>Payment By(UPI,BANK A/C)</th>
                                    
									<th>Request Date</th>
									 <th>Status</th>
                                                </tr>
                                            </thead>
                                           <tbody>
                                <?php 
                                $sel = $mysqli->query("select * from payout_ride_setting where riderid=".$ddata['id']."");
                                $i=0;
                                while($row = $sel->fetch_assoc())
                                {
                                    $i= $i + 1;
                                ?>
                                <tr>
                                    
                                    <td><?php echo $i; ?></td>
			<td><?php echo $row['rid'];?></td> 
                                    <td><?php echo $row['amt'].' '.$fset['currency'];?></td>
									
									<td><?php if($row['proof'] == ''){echo 'wait_for_admin_status';}else{?>
									<img src="<?php echo $row['proof'];?>" width="100" height="100"/><?php }?></td>
									<td><?php if($row['p_by'] == ''){echo 'wait_for_admin_status';}else{echo $row['p_by'];}?></td>
									 <td><?php echo $row['r_date'];?></td>
									 <td><?php echo $row['status'];?></td>
                                   
                                   
                                </tr>
								<?php } ?>
                            </tbody>
                                        </table>
                                    </div>
		<?php 
	}?>
                                </div>
                            </div>
            </div>
					
                
            </section>
        </div>
        
       
    </div>
</div>

<?php require 'include/footer.php';?>
</body>


</html>