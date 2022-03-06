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
                    <h1>Store List</h1>
					</div>
					<div class="col-md-3 col-lg-3 col-xs-12">
					<a href="add_store.php" class="btn btn-primary" > Add New Store </a>
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
                                                <th>Store Image</th>
                                    <th>Store Name</th>
                                   <th>Store Mobile</th>
								    <th>Store Email</th>
									 <th>Store Password</th>
									
									 <th>Store Pincode</th>
									  <th>Store Address</th>
									   <th>Store Status</th>
									  <th>Store Star</th>
									    
										
                                    <th>Change Status</th>
									<th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $mysqli->query("SELECT * FROM `vendor`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                
                                    <td><img src="<?php echo $row['v_img'];?>" width="100" height="100"/></td>
                                    <td><?php echo $row['name'];?></td>
                                   <td><?php echo $row['mobile'];?></td>
								   <td><?php echo $row['email'];?></td>
								   <td><?php echo $row['password'];?></td>
								    
								   <td>
								   <?php $ad = $mysqli->query("select * from tbl_pincode where id IN(".$row['aid'].")"); 
								     $city = array();
								     while($r = $ad->fetch_assoc())
								     {
								         $city[] = $r['pincode'];
								     }
								     echo implode(',',$city);
								     ?>
								   </td>
 <td><?php echo $row['address'];?></td> 								  
								  <td><?php if($row['status'] == 1){echo 'Active';}else {echo 'Deactive';}?></td> 
								     <td><?php echo $row['star'];?></td>
                                    <td>
									<?php if($row['status'] == 0) {?>
									<a href="?status=1&rid=<?php echo $row['id'];?>">	<button class="btn btn-success"   data-original-title="" title="">
                                           Make Active
                                        </button></a>
									<?php } else { ?>
								<a	href="?status=0&rid=<?php echo $row['id'];?>">	<button class="btn btn-danger"   data-original-title="" title="">
                                            Make Deactive
                                        </button>
										</a>
									<?php } ?>
										</td>
												
                                                <td><a href="add_store.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
												
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
$table="vendor";
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
    title: 'Store Section!!',
    message: 'Store  Status Update Successfully!!',
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