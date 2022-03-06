<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); 
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
                    <h1>Pincode List</h1>
					</div>
					<div class="col-md-3 col-lg-3 col-xs-12">
					<a href="add_pincode.php" class="btn btn-primary" > Add New Pincode </a>
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
                                                <th>Pincode</th>
                                                <th>Delivery Charge</th>
                                                
                                                
                                                <th>Status</th>
												<th>Is Default?</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $mysqli->query("SELECT * FROM `tbl_pincode`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td> <?php echo $row['pincode']; ?></td>
                                                 <td> <?php echo $row['d_charge']; ?></td>
                                                
                                               
												<?php if($row['status'] == 1) { ?>
                                                <td><div class="badge badge-success">Publish</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">Unpublish</div></td>
												<?php } ?>
												<?php if($row['is_primary'] == 1) { ?>
                                                <td><div class="badge badge-success">Yes</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">No</div></td>
												<?php } ?>
												
                                                <td><a href="add_pincode.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
												<a href="?defid=<?php echo $row['id']; ?>" class="btn btn-success">Make Primary</a>
												
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
if(isset($_GET['defid']))
{
	$id = $_GET['defid'];
	$t=1;
		


$tables="tbl_pincode";
  $fields = array('is_primary'=>'0');
  $wheres = "where `is_primary`=".$t."";
$hs = new Common();
	 $check = $hs->UpdateData($fields,$tables,$wheres);
	  
$table="tbl_pincode";
  $field = array('is_primary'=>$t);
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Pincode Section!!',
    message: 'Pincode Make Primary Successfully!!',
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
<?php require 'include/footer.php';?>
</body>


</html>