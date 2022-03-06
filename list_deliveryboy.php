 <?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <div class="col-md-9 col-lg-9 col-xs-12">
                    <h1>Delivery Boy List</h1>
					</div>
					<div class="col-md-3 col-lg-3 col-xs-12">
					<a href="add_deliveryboy.php" class="btn btn-primary" > Add New Delivery Boy </a>
					</div>
                </div>
				<div class="card">
				
                               <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped v_center" id="table-1">
                                            <thead>
                                                <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Delivery Boy Name</th>
                                   <th>Delivery Boy Mobile</th>
								    <th>Delivery Boy Email</th>
									
									 <th>Delivery Boy Pincode</th>
									  <th>Delivery Boy Address</th>
									   <th>Delivery Boy Status</th>
									   <th>Delivery Boy App Status(On/Off)</th>
									    <th>Delivery Boy Total Reject</th>
										<th>Delivery Boy Total Accept</th>
										<th>Delivery Boy Total Complete</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $mysqli->query("SELECT * FROM `rider`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td><?php echo $row['name'];?></td>
                                   <td><?php echo $row['mobile'];?></td>
								   <td><?php echo $row['email'];?></td>

								   <td><?php $ad = $mysqli->query("select * from tbl_pincode where id=".$row['aid']."")->fetch_assoc(); echo $ad['pincode'];?></td>

 <td><?php echo $row['address'];?></td> 


 
 
								  <td><?php if($row['status'] == 1){echo 'Active';}else {echo 'Deactive';}?></td> 
								    <td><?php if($row['a_status'] == 1) {echo 'On';}else {echo 'Off';}?></td> 
								   <td><?php echo $row['reject'];?></td>
								   <td><?php echo $row['accept'];?></td>
								   <td><?php echo $row['complete'];?></td>
                                    <td>
									<?php if($row['status'] == 0) {?>
									<a href="?status=1&rid=<?php echo $row['id'];?>">	<button class="btn btn-success"   data-original-title="" title="">
                                           Make Active
                                        </button></a>
									<?php } else { ?>
								<a	href="?status=0&rid=<?php echo $row['id'];?>">	<button class="btn btn-danger"  href="?status=0&rid=<?php echo $rkl['id'];?>" data-original-title="" title="">
                                            Make Deactive
                                        </button>
										</a>
									<?php } ?>
										</td>
                                                </tr>
<?php } ?>                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
            </div>
					
                
            </section>
        </div>
        
       
    </div>
</div>

<?php 
if(isset($_GET['status']))
{
$status = $_GET['status'];
$id = $_GET['rid'];
$table="rider";
  $field = array('status'=>$status);
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Delivery Boy Section!!',
    message: 'Delivery Boy status Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
}
?>

<?php require 'include/footer.php';?>
</body>


</html>