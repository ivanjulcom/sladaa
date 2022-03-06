<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
<?php 
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="tbl_product_attribute";
$where = "where id=".$id."";
$h = new Common();
	$check = $h->Deletedata($where,$table);

if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Attributes Section!!',
    message: 'Product Attributes Delete Successfully!!',
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
                    <div class="col-md-9 col-lg-9 col-xs-12">
                    <h1>Product Attributes List</h1>
					</div>
					<div class="col-md-3 col-lg-3 col-xs-12">
					<a href="add_product_attributes.php" class="btn btn-primary" > Add New Product Attributes </a>
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
												 
                                                
                                                <th>Product Title</th>
                                                
                                                <th>Product Type</th>
												<th>Product Price</th>
												<th>Product Discount</th>
												
												
                                                <th>Stock Status</th>
												
												
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											$store_id = $sdata['id'];
											 $stmt = $mysqli->query("SELECT * FROM `tbl_product_attribute` where sid=".$store_id."");
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
												   $jp = $mysqli->query("select * from tbl_product where id=".$row['pid']."")->fetch_assoc();
												   echo $jp['mtitle'];
												   ?>
                                                </td>
                                                
                                               <td><?php echo $row['title'];?></td>
											   <td><?php echo $row['price'];?></td>
											   <td><?php echo $row['discount'];?></td>
												
											 
											  
												<?php if($row['ostock'] == 0) { ?>
                                                <td><div class="badge badge-success">In Stock</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">Out Of Stock</div></td>
												<?php } ?>
												
                                                <td><a href="add_product_attributes.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
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