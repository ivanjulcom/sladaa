<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
<?php 
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="tbl_coupon";
$where = "where id=".$id."";
$h = new Common();
	$check = $h->Deletedata($where,$table);

if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Coupon Section!!',
    message: 'Coupon Code Delete Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="list_coupon.php";}, 3000);
</script>
<?php 
}
?>
        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <div class="col-md-9 col-lg-9 col-xs-12">
                    <h1>Coupon List</h1>
					</div>
					<div class="col-md-3 col-lg-3 col-xs-12">
					<a href="add_coupon.php" class="btn btn-primary" > Add New Coupon </a>
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
												 <th>Code</th>
                                                
                                                <th>Image</th>
                                                 <th>Expired Date</th>
                                                <th>Min Amount</th>
												<th>Discount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											$store_id = $sdata['id'];
											 $stmt = $mysqli->query("SELECT * FROM `tbl_coupon` where sid=".$store_id."");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
												<td> <?php echo $row['c_title']; ?></td>
                                                
                                                <td class="align-middle">
                                                   <img src="<?php echo $row['c_img']; ?>" width="60" height="60"/>
                                                </td>
                                                
                                               <td> <?php 
											   $date=date_create($row['cdate']);
echo date_format($date,"d-m-Y");
											   ?></td>
											   <td> <?php echo $row['min_amt']; ?></td>
											   <td> <?php echo $row['c_value']; ?></td>
												<?php if($row['status'] == 1) { ?>
                                                <td><div class="badge badge-success">Publish</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">Unpublish</div></td>
												<?php } ?>
                                                <td><a href="add_coupon.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
												<a href="?did=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
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

<?php require 'include/footer.php';?>
</body>


</html>