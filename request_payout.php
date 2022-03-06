 <?php 
require 'include/navbar.php';
require 'include/sidebar.php';
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>
        <!-- Start main left sidebar menu -->
       
		
		
		

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
			
                    <h1>REQUEST PAYOUT</h1>
				
                </div>
				<?php 
				if($_SESSION['ltype'] == 'Vendor')
				{
				?>
				<div class="card">
				<div class="row">
				<div class="col-md-4">
			<div class="media-body text-center" style="background:#563d7c;padding:10px;color:#fff;">
                <h6 class="mb-1"><?php $sales  = $mysqli->query("select sum((o_total-d_charge) - (o_total-d_charge) * vcommission/100) as full_total from tbl_order where o_status='completed'  and  sid=".$sdata['id']."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payout from payout_setting where vid=".$sdata['id']."")->fetch_assoc();
			  $total = $sales['full_total'];
			 $wallet = number_format((float)(($total)) - $payout['full_payout'], 2, '.', '');
                 if($sales['full_total'] == ''){echo '0'.' '.$set['currency'];}else {echo  $wallet.' '.$set['currency']; } ?></h6>
                <span>Wallet Balance</span>
              </div>
			  </div>
			  <div class="col-md-4">
			  </div>
			  <div class="col-md-4">
			<div class="media-body text-center" style="background:#563d7c;padding:10px;color:#fff;">
                <h6 class="mb-1"><?php echo $set['p_limit'].' '.$set['currency'];?></h6>
                <span>Wallet Min Balance For Withdraw</span>
              </div>
			  </div>
			  </div>
				
                                <form method="post" >
                                    
                                    <div class="card-body">
                                        
                                        <div class="form-group">
                                            <label>Payout Amount</label>
                                            <input type="number" min="1"
                  step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"  name="amt" required >
                                        </div>
										 
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Request Payout</button>
                                    </div>
                                </form>
				
                            </div>
            </div>
					
                
            </section>
        </div>
        
       
    </div>
</div>

 <?php 
		if(isset($_POST['icat']))
		{
			
			$amt = $_POST['amt'];
if($set['p_limit'] > $amt)
{
?>
	
  
  <script src="assets/modules/izitoast/js/iziToast.min.js"></script>
	 <script>
	 var currency = "<?php echo $set['currency'];?>";
	var limit = "<?php echo $set['p_limit']; ?>";
 iziToast.error({
    title: 'Limit Cross REQUEST!!',
    message: 'Minimum '+limit+currency+' for withdraw amount.!!',
    position: 'topRight'
  });
	 </script>
	 
	<?php 
}
else if($wallet < $amt)
{
	?>
	<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.error({
    title: 'Not Enough Wallet Balance!!',
    message: 'You Do Not Have Requested Amount In Wallet.!!',
    position: 'topRight'
  });
	 </script>
	<?php 
}
else 
{
	$timestamp = date("Y-m-d H:i:s");
	$rand = substr(md5(microtime()),rand(0,26),3).'-'.$timestamp;
$store_id = $sdata['id'];
 $table="payout_setting";
  $field_values=array("amt","status","vid","r_date","rid");
  $data_values=array("$amt",'pending',"$store_id","$timestamp","$rand");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Payout Section!!',
    message: 'Payout Submit Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
 
}
}
		?>
		
		<?php } else { ?>
		
		<div class="card">
				<div class="row">
				<div class="col-md-4">
			<div class="media-body text-center" style="background:#563d7c;padding:10px;color:#fff;">
                <h6 class="mb-1"><?php $sales  = $mysqli->query("select sum(d_charge - (d_charge * dcommission/100)) as full_total from tbl_order where o_status='completed' and   rid=".$ddata['id']."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payout from payout_ride_setting where riderid=".$ddata['id']."")->fetch_assoc();
			  $total = $sales['full_total'];
			 $wallet = number_format((float)(($total)) - $payout['full_payout'], 2, '.', '');
                 if($sales['full_total'] == ''){echo '0'.' '.$set['currency'];}else {echo  $wallet.' '.$set['currency']; } ?></h6>
                <span>Wallet Balance</span>
              </div>
			  </div>
			  <div class="col-md-4">
			  </div>
			  <div class="col-md-4">
			<div class="media-body text-center" style="background:#563d7c;padding:10px;color:#fff;">
                <h6 class="mb-1"><?php echo $set['p_limit'].' '.$set['currency'];?></h6>
                <span>Wallet Min Balance For Withdraw</span>
              </div>
			  </div>
			  </div>
				
                                <form method="post" >
                                    
                                    <div class="card-body">
                                        
                                        <div class="form-group">
                                            <label>Payout Amount</label>
                                            <input type="number" min="1"
                  step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"  name="amt" required >
                                        </div>
										 
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Request Payout</button>
                                    </div>
                                </form>
				
                            </div>
            </div>
					
                
            </section>
        </div>
        
       
    </div>
</div>

 <?php 
		if(isset($_POST['icat']))
		{
			
			$amt = $_POST['amt'];
if($set['p_limit'] > $amt)
{
?>
	
  
  <script src="assets/modules/izitoast/js/iziToast.min.js"></script>
	 <script>
	 var currency = "<?php echo $set['currency'];?>";
	var limit = "<?php echo $set['p_limit']; ?>";
 iziToast.error({
    title: 'Limit Cross REQUEST!!',
    message: 'Minimum '+limit+currency+' for withdraw amount.!!',
    position: 'topRight'
  });
	 </script>
	 
	<?php 
}
else if($wallet < $amt)
{
	?>
	<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.error({
    title: 'Not Enough Wallet Balance!!',
    message: 'You Do Not Have Requested Amount In Wallet.!!',
    position: 'topRight'
  });
	 </script>
	<?php 
}
else 
{
	$timestamp = date("Y-m-d H:i:s");
	$rand = substr(md5(microtime()),rand(0,26),3).'-'.$timestamp;
$store_id = $ddata['id'];
 $table="payout_ride_setting";
  $field_values=array("amt","status","riderid","r_date","rid");
  $data_values=array("$amt",'pending',"$store_id","$timestamp","$rand");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Payout Section!!',
    message: 'Payout Submit Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
} 
}
}
		?>
		<?php } ?>
		
<?php require 'include/footer.php';?>
</body>


</html>