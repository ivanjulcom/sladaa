<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
<?php 
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="tbl_product";
$where = "where id=".$id."";
$h = new Common();
	$check = $h->Deletedata($where,$table);
	
	$tables="tbl_product_attribute";
$wheres = "where pid=".$id."";
$hs = new Common();
	$checks = $hs->Deletedata($wheres,$tables);
	

if($check == 1 and $checks == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Product Section!!',
    message: 'Product Delete Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="list_product.php";}, 3000);
</script>
<?php 
}
?>
        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <div class="col-md-9 col-lg-9 col-xs-12">
                    <h1>Product List</h1>
					</div>
					<div class="col-md-3 col-lg-3 col-xs-12">
					<a href="add_product.php" class="btn btn-primary" > Add New Product </a>
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
												 
                                                
                                                <th>Image</th>
                                                
                                                
												<th>Category</th>
                                                <th>Status</th>
												<th>Total Attributes</th>
												
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											$store_id = $sdata['id'];
											 $stmt = $mysqli->query("SELECT * FROM `tbl_product` where sid=".$store_id."");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
												
                                                
                                                <td class="align-middle">
                                                   <?php 
									$im_list = explode(',',$row['m_img']);
									foreach($im_list as $ilist)
									{
										?>
										<img src="<?php echo $ilist;?>" width="60px" height="60px"/>
										<?php 
									}
									?>
                                                </td>
                                                
                                               
												
											  
											  
											  <td>
											  <?php 
											  $bdata = $mysqli->query("select * from category where id=".$row['mcat']."")->fetch_assoc();
											  echo $bdata['cat_name'];
											  ?>
											  </td>
											  
												<?php if($row['mstatus'] == 1) { ?>
                                                <td><div class="badge badge-success">Publish</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">Unpublish</div></td>
												<?php } ?>
												
												<td>
											  <?php 
											 echo $mysqli->query("select * from tbl_product_attribute where pid=".$row['id']."")->num_rows;
											  
											  ?>
											  </td>
											  
                                                <td><a href="add_product.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
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