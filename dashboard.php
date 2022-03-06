
<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
 ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); 
?>
        <!-- Start main left sidebar menu -->
        
<?php 
if($_SESSION['ltype'] == 'Vendor')
	{
		?>
		<div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Dashboard</h1>
                </div>
				<div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                        <div class="card-stats-title"> Product Order Statistics 
                            
                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $mysqli->query("select * from tbl_order where o_status='Pending' and sid=".$sdata['id']."")->num_rows;?></div>
                                <div class="card-stats-item-label">Pending</div>
                            </div>
							<div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $mysqli->query("select * from tbl_order where o_status='Processing' and sid=".$sdata['id']."")->num_rows;?></div>
                                <div class="card-stats-item-label">Process</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $mysqli->query("select * from tbl_order where o_status='On Route' and sid=".$sdata['id']."")->num_rows;?></div>
                                <div class="card-stats-item-label">On Route</div>
                            </div>
							<div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $mysqli->query("select * from tbl_order where o_status='Cancelled' and sid=".$sdata['id']."")->num_rows;?></div>
                                <div class="card-stats-item-label">Cancel</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $mysqli->query("select * from tbl_order where o_status='Completed' and sid=".$sdata['id']."")->num_rows; ?></div>
                                <div class="card-stats-item-label">Completed</div>
                            </div>
                        </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-shopping-bag heart"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Orders</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $mysqli->query("select * from tbl_order where sid=".$sdata['id']."")->num_rows; ?>
                        </div>
                        </div>
                    </div>
                    </div>
					
					
                   <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="card card-statistic-2">
                        
                        <div class="card-icon shadow-primary bg-primary" style="color:white;font-weight:bold;">
                       <?php echo $set['currency'];?>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header"> 
                            <h4>Total Sales(Not Included Delivery Charge)</h4>
                        </div>
                        <div class="card-body heart">
                           <?php $sales  = $mysqli->query("select sum((o_total-d_charge) - (o_total-d_charge) * vcommission/100) as full_total from tbl_order where o_status='completed'  and  sid=".$sdata['id']."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payout from payout_setting where vid=".$sdata['id']."")->fetch_assoc();
                 $bs = 0;
				
				
				 if($sales['full_total'] == ''){echo $bs.' '.$set['currency'];}else {echo  number_format((float)($sales['full_total']) - $payout['full_payout'], 2, '.', '').' '.$set['currency']; } ?>
                        </div>
                        </div>
                    </div>
					
					<div class="card card-statistic-2">
                        
                        <div class="card-icon shadow-primary bg-primary" style="color:white;font-weight:bold;">
                      <i class="fas fa-motorcycle"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Delivery Boy</h4>
                        </div>
                        <div class="card-body">
                             <?php echo $mysqli->query("select * from rider where aid IN(".$sdata['aid'].")")->num_rows; ?>
                        </div>
                        </div>
                    </div>
                    </div>
					
					<div class="col-lg-3 col-md-3 col-sm-12">
                    
					<div class="card card-statistic-2">
                        
                        <div class="card-icon shadow-primary bg-primary" style="color:white;font-weight:bold;">
                      <i class="fas fa-store"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Make A Store Open Or Close ?</h4>
                        </div>
                        <div class="card-body">
                             <?php if($sdata['vstatus']==1) { 
	?>
	<a href="?shop=0"><button class="btn shadow-z-2 btn-danger"  style="margin: 10px;">Make Shop Close</button></a>
	<?php }else { ?>
	<a href="?shop=1"><button class="btn shadow-z-2 btn-success" style="margin: 10px;">Make Shop Open</button></a>
	<?php } ?>
                        </div>
                        </div>
                    </div>
					
					<div class="card card-statistic-2">
                        
                        <div class="card-icon shadow-primary bg-primary" style="color:white;font-weight:bold;">
                      <i class="fas fa-home"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Dynamic Section</h4>
                        </div>
                        <div class="card-body">
                             <?php echo $mysqli->query("select * from tbl_home_section where sid=".$sdata['id']."")->num_rows; ?>
                        </div>
                        </div>
                    </div>
                    </div>
					
					<?php 
	if(isset($_GET['shop']))
	{
		
		$shop = $_GET['shop'];
		
		if($shop == 1)
		{
			$table="vendor";
  $field = array('vstatus'=>$shop);
  $where = "where id=".$sdata['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Store Section!!',
    message: 'Store Open Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="dashboard.php";}, 3000);
</script>
<?php 
		}
else 
{
	$table="vendor";
  $field = array('vstatus'=>$shop);
  $where = "where id=".$sdata['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Store Section!!',
    message: 'Store Close Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
}
?>
<script>
setTimeout(function(){ window.location.href="dashboard.php";}, 3000);
</script>
<?php 	
	}
	?>
                    
                </div>
                <div class="row">
                    
                    
					
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
					<a href="list_coupon.php">
                        <div class="card card-statistic-1">
                            <div class="card-icon shadow-success bg-success">
                                <i class="fas fa-gift"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Coupon</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $mysqli->query("select * from tbl_coupon where sid=".$sdata['id']."")->num_rows;?>
                                </div>
                            </div>
                        </div> 
						</a>
                    </div>
					
					
					
					
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
					<a href="list_product.php">
                        <div class="card card-statistic-1">
                            <div class="card-icon shadow-warning bg-warning">
                               <i class="fas fa-carrot"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Product</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $mysqli->query("select * from tbl_product where sid=".$sdata['id']."")->num_rows;?>
                                </div>
                            </div>
                        </div> 
						</a>
                    </div>
					
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<section class="section">
                <div class="section-header">
                    <div class="col-md-9 col-lg-9 col-xs-12">
                    <h1>Latest Order</h1>
					</div>
					<div class="col-md-3 col-lg-3 col-xs-12">
					<a href="pending.php" class="btn btn-primary"> View All Order</a>
					</div>
                </div>
					<div class="card">
				
                               <div class="card-body">
					<div class="table-responsive">
                                        <table class="table table-striped v_center" id="table-1">
                                            <thead>
                                                <tr>
                                               <th>#</th>
												 <th>Order Id</th>
                                                 <th>Order Date </th>
												
                                                 <th>Current Status</th>
												 
                                                 
												
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											$store_id = $sdata['id'];
											 $stmt = $mysqli->query("SELECT * FROM `tbl_order` where o_status!='Cancelled' and o_status!='Completed' and sid=".$store_id." order by id desc limit 5");

while($row = $stmt->fetch_assoc())
{
	
											?>
                                                <tr>
												
												<?php 
												if($row['o_status'] == 'Pending')
												{
													?>
												<td class="beep">  </td>
                                                <?php } else if($row['o_status'] == 'Processing') {?>
												<td class="beeps">  </td>
                                                <?php } else {?>
												<td class="beepss">  </td>
												<?php }?>
												
												<td> <?php echo $row['id']; ?> </td>
                                                
                                                
                                               <td> <?php 
											   $date=date_create($row['odate']);
echo date_format($date,"d-m-Y");
											   ?></td>
											  
											   <td> <?php echo $row['o_status']; ?></td>
											   
												 
                                               
												
                                                </tr>
<?php } ?>                                           
                                            </tbody>
                                        </table>
                                    </div>
									 </div>
									  </div>
					</section>
					</div>
                    

					
                </div>
                
                
                      
                    </div>
		<?php 
	}
	else if($_SESSION['ltype'] == 'D_boy')
{
	?>
	<div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Dashboard</h1>
                </div>
	<div class="row">
                    
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
					
                        <div class="card card-statistic-1">
                            <div class="card-icon shadow-warning bg-warning">
                                <i class="fas fa-thumbs-up"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Accept</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $ddata['accept'];?>
                                </div>
                            </div>
                        </div> 
						
                    </div>
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
					
                        <div class="card card-statistic-1">
                            <div class="card-icon shadow-warning bg-danger">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Reject</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $ddata['reject'];?>
                                </div>
                            </div>
                        </div> 
						
                    </div>
					
					
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
					
                        <div class="card card-statistic-1">
                            <div class="card-icon shadow-success bg-success">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Completed</h4>
                                </div>
                                <div class="card-body">
                                  <?php echo $ddata['complete'];?>
                                </div>
                            </div>
                        </div> 
						
                    </div>
					
					
					
					
					
					
					
					
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
					
                        <div class="card card-statistic-1">
                            <div class="card-icon shadow-info bg-info">
                                <i class="fas fa-receipt"></i>
                            </div>
                             <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Trip</h4>
                        </div>
                        <div class="card-body heart">
                           <?php $sales  = $mysqli->query("select sum(d_charge - (d_charge * dcommission/100)) as full_total from tbl_order where o_status='completed' and   rid=".$ddata['id']."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payout from payout_ride_setting where riderid=".$ddata['id']."")->fetch_assoc();
                 $bs = 0;
				 if($sales['full_total'] == ''){echo $bs.' '.$set['currency'];}else {echo  number_format((float)($sales['full_total'])  - $payout['full_payout'], 2, '.', '').' '.$set['currency']; } ?>
                        </div>
                        </div>
                        </div> 
						
                    </div>
					
					
					
					
                    

					
                </div>
                </section>
				</div>
	<?php 
}
	else 
	{
?>
        <!-- Start app main Content --> 
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Dashboard</h1>
                </div>
				<div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                        <div class="card-stats-title"> Product Order Statistics 
                            
                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $mysqli->query("select * from tbl_order where o_status='Pending'")->num_rows;?></div>
                                <div class="card-stats-item-label">Pending</div>
                            </div>
							<div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $mysqli->query("select * from tbl_order where o_status='Processing'")->num_rows;?></div>
                                <div class="card-stats-item-label">Process</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $mysqli->query("select * from tbl_order where o_status='On Route'")->num_rows;?></div>
                                <div class="card-stats-item-label">On Route</div>
                            </div>
							<div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $mysqli->query("select * from tbl_order where o_status='Cancelled'")->num_rows;?></div>
                                <div class="card-stats-item-label">Cancel</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $mysqli->query("select * from tbl_order where o_status='Completed'")->num_rows; ?></div>
                                <div class="card-stats-item-label">Completed</div>
                            </div>
                        </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-shopping-bag heart"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Orders</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $mysqli->query("select * from tbl_order")->num_rows; ?>
                        </div>
                        </div>
                    </div>
                    </div>
					
					<div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                        <div class="card-stats-title"> Package  Order Statistics 
                            
                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $mysqli->query("select * from pkg_order where o_status='Pending'")->num_rows;?></div>
                                <div class="card-stats-item-label">Pending</div>
                            </div>
							<div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $mysqli->query("select * from pkg_order where o_status='Processing'")->num_rows;?></div>
                                <div class="card-stats-item-label">Process</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $mysqli->query("select * from pkg_order where o_status='On Route'")->num_rows;?></div>
                                <div class="card-stats-item-label">On Route</div>
                            </div>
							<div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $mysqli->query("select * from pkg_order where o_status='Cancelled'")->num_rows;?></div>
                                <div class="card-stats-item-label">Cancel</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $mysqli->query("select * from pkg_order where o_status='Completed'")->num_rows; ?></div>
                                <div class="card-stats-item-label">Completed</div>
                            </div>
                        </div>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-people-carry"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Package Orders</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $mysqli->query("select * from pkg_order")->num_rows; ?>
                        </div>
                        </div>
                    </div>
                    </div>
					
                    <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="card card-statistic-2">
                        
                        <div class="card-icon shadow-primary bg-primary" style="color:white;font-weight:bold;">
                       <?php echo $set['currency'];?>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Sales</h4>
                        </div>
                        <div class="card-body heart">
                            <?php $sales  = $mysqli->query("select sum(o_total) as full_total from tbl_order where o_status='Completed'")->fetch_assoc();
               $sa = 0;
               if($sales['full_total'] == ''){echo $sa.' '.$set['currency'];}else {echo number_format((float)$sales['full_total'], 2, '.', '').' '.$set['currency']; } ?>
                        </div>
                        </div>
                    </div>
					
					<div class="card card-statistic-2">
                       
                        <div class="card-icon shadow-primary bg-primary">
                       <i class="fas fa-money-bill-alt"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Payment Gateway</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $mysqli->query("select * from tbl_payment_list")->num_rows; ?>
                        </div>
                        </div>
                    </div>
                    </div>
					
					<div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="card card-statistic-2">
                        
                        <div class="card-icon shadow-primary bg-primary" style="color:white;font-weight:bold;">
                      <i class="fas fa-motorcycle"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Delivery Boy</h4>
                        </div>
                        <div class="card-body">
                             <?php echo $mysqli->query("select * from rider")->num_rows; ?>
                        </div>
                        </div>
                    </div>
					
					<div class="card card-statistic-2">
                       
                        <div class="card-icon shadow-primary bg-primary">
                      <i class="fas fa-store"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Store</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $mysqli->query("select * from vendor")->num_rows; ?>
                        </div>
                        </div>
                    </div>
                    </div>
					
					<div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="card card-statistic-2">
                        
                        <div class="card-icon shadow-primary bg-primary" style="color:white;font-weight:bold;">
                      <i class="fas fa-list-ol"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Package Category</h4>
                        </div>
                        <div class="card-body">
                             <?php echo $mysqli->query("select * from pkg_category")->num_rows; ?>
                        </div>
                        </div>
                    </div>
					
					<div class="card card-statistic-2">
                       
                        <div class="card-icon shadow-primary bg-primary">
                      <i class="fas fa-image"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Package Banner</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $mysqli->query("select * from pkg_banner")->num_rows; ?>
                        </div>
                        </div>
                    </div>
                    </div>
					
					
					<div class="col-lg-3 col-md-3 col-sm-12">
                    <a href="list_testimonial.php">
                        <div class="card card-statistic-2">
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-receipt"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Vendor Payout</h4>
                                </div>
                                <div class="card-body">
                                    <?php $sales  = $mysqli->query("select sum(amt) as full_payouts from payout_setting where status='completed'")->fetch_assoc();
               $bs = 0;
                 if($sales['full_payouts'] == ''){echo $bs.' '.$set['currency'];}else {echo number_format((float)$sales['full_payouts'], 2, '.', '').' '.$set['currency']; } ?>
                                </div>
                            </div>
                        </div> 
						</a>
					
					<a href="list_testimonial.php">
                        <div class="card card-statistic-2">
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-receipt"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Delivery Boy Payout</h4>
                                </div>
                                <div class="card-body">
                                    <?php $sales  = $mysqli->query("select sum(amt) as full_payouts from payout_ride_setting where status='completed'")->fetch_assoc();
               $bs = 0;
                 if($sales['full_payouts'] == ''){echo $bs.' '.$set['currency'];}else {echo number_format((float)$sales['full_payouts'], 2, '.', '').' '.$set['currency']; } ?>
                                </div>
                            </div>
                        </div> 
						</a>
                    </div>
					
					
                    
                </div>
                <div class="row">
                    
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
					<a href="list_category.php">
                        <div class="card card-statistic-1">
                            <div class="card-icon shadow-warning bg-warning">
                                <i class="fas fa-list-ol"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Category</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $mysqli->query("select * from category")->num_rows;?>
                                </div>
                            </div>
                        </div> 
						</a>
                    </div>
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
					<a href="list_banner.php">
                        <div class="card card-statistic-1">
                            <div class="card-icon shadow-info bg-info">
                                <i class="fas fa-image"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Banner</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $mysqli->query("select * from banner")->num_rows;?>
                                </div>
                            </div>
                        </div> 
						</a>
                    </div>
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
					
                        <div class="card card-statistic-1">
                            <div class="card-icon shadow-success bg-success">
                                <i class="fas fa-gift"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Coupon</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $mysqli->query("select * from tbl_coupon")->num_rows;?>
                                </div>
                            </div>
                        </div> 
						
                    </div>
					
					
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
					<a href="list_pincode.php">
                        <div class="card card-statistic-1">
                            <div class="card-icon shadow-success bg-success">
                                <i class="fas fa-map-pin"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Pincode</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $mysqli->query("select * from tbl_pincode")->num_rows;?>
                                </div>
                            </div>
                        </div> 
						</a>
                    </div>
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
					
                        <div class="card card-statistic-1">
                            <div class="card-icon shadow-warning bg-warning">
                               <i class="fas fa-carrot"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Product</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $mysqli->query("select * from tbl_product")->num_rows;?>
                                </div>
                            </div>
                        </div> 
						
                    </div>
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
					<a href="customer.php">
                        <div class="card card-statistic-1">
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Customer</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $mysqli->query("select * from tbl_user")->num_rows;?>
                                </div>
                            </div>
                        </div> 
						</a>
                    </div>
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
					<a href="list_testimonial.php">
                        <div class="card card-statistic-1">
                            <div class="card-icon shadow-info bg-info">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Testimonial</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $mysqli->query("select * from tbl_happy_user")->num_rows;?>
                                </div>
                            </div>
                        </div> 
						</a>
                    </div>
			
                </div>
                
                
                      
                    </div>
	<?php } ?>
                </div>
            </section>
        </div>
        
       
    </div>
</div>

<?php require 'include/footer.php';?>


</body>
<style>

@keyframes heartbeat
{
  0%
  {
    transform: scale( .75 );
  }
  20%
  {
    transform: scale( 1 );
  }
  40%
  {
    transform: scale( .75 );
  }
  60%
  {
    transform: scale( 1 );
  }
  80%
  {
    transform: scale( .75 );
  }
  100%
  {
    transform: scale( .75 );
  }
}

.heart
{
  animation: heartbeat 1s infinite;
}
</style>

</html>