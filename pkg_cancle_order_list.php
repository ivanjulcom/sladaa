<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Cancelled Order List</h1>
                </div>
				<div class="card">
				
                               <div class="card-body">
                                    <div class="table-responsive">
									<?php 
									if($_SESSION['ltype'] == 'D_boy')
									{
										?>
										<table class="table table-striped v_center" id="table-1">
                                            <thead>
                                                <tr>
                                                 <th>#</th>
												 <th>Order Id</th>
                                                 <th>Order Date </th>
                                                 <th>Current Status</th>
                                                <th>PickUp Address</th>
												 <th>PickUp Mobile</th>
												 <th>Drop Address</th>
												 <th>Drop Mobile</th>
                                                 
												 <th>Description</th>
												 <th>Photos</th>
												 <th>Delivery Charge</th>
												 <th>Distance</th>
												 <th>Category</th>
												 <th>Payment Method</th>
												 <th>Transaction Id </th>
												 
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											$rid = $ddata['id'];
											 $stmt = $mysqli->query("SELECT * FROM `pkg_order` where o_status ='Cancelled'  and rid=".$rid." order by id desc");

while($row = $stmt->fetch_assoc())
{
	
											?>
                                                <tr>
                                               <td class="beepred"></td>
												<td > <?php echo $row['id']; ?></td>
                                                
                                                
                                                
                                               <td> <?php 
											   $date=date_create($row['odate']);
echo date_format($date,"d-m-Y");
											   ?></td>
											   <td> <?php echo $row['o_status']; ?></td>
											   
												<td style="min-width: 200px;"><?php echo $row['paddress'];?></td>
												 <td><?php echo $row['pmobile'];?></td>
												 <td style="min-width: 200px;"><?php echo $row['daddress'];?></td>
												 <td><?php echo $row['dmobile'];?></td>
												 <td><?php echo $row['description'];?></td>
												 <td style="display:flex;"><?php 
												 if($row['photos'] != '')
												 {
													 
													 
													 $im_list = explode(',',$row['photos']);
													 
									foreach($im_list as $ilist)
									{
										?>
										<img src="<?php echo $ilist;?>" width="60px" height="60px"/>
										<?php 
									}
												 }
												 else
												 {
													 
												 }
												 ?></td>
												 <td><?php echo $row['d_charge'];?></td>
												 <td><?php echo $row['distance'];?></td>
												 <td><?php echo $row['category'];?></td>
												 <td><?php 
												 $pdata = $mysqli->query("select * from tbl_payment_list where id=".$row['p_method_id']."")->fetch_assoc();
												 echo $pdata['title'];
												 ?></td>
												 <td><?php echo $row['trans_id'];?></td>
                                                
                                                </tr>
<?php } ?>                                           
                                            </tbody>
                                        </table>
										<?php 
									}
									else 
									{
										?>
                                        <table class="table table-striped v_center" id="table-1">
                                            <thead>
                                                <tr>
                                                 <th>#</th>
												 <th>Order Id</th>
                                                 <th>Order Date </th>
                                                 <th>Current Status</th>
                                                 <th>PickUp Address</th>
												 <th>PickUp Mobile</th>
												 <th>Drop Address</th>
												 <th>Drop Mobile</th>
                                                 
												 <th>Description</th>
												 <th>Photos</th>
												 <th>Delivery Charge</th>
												 <th>Distance</th>
												 <th>Category</th>
												 <th>Payment Method</th>
												 <th>Transaction Id </th>
												 
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											
											 $stmt = $mysqli->query("SELECT * FROM `pkg_order` where o_status ='Cancelled'   order by id desc");

while($row = $stmt->fetch_assoc())
{
	
											?>
                                                <tr>
                                               <td class="beepred"></td>
												<td > <?php echo $row['id']; ?></td>
                                                
                                                
                                                
                                               <td> <?php 
											   $date=date_create($row['odate']);
echo date_format($date,"d-m-Y");
											   ?></td>
											   <td> <?php echo $row['o_status']; ?></td>
											   
												 <td style="min-width: 200px;"><?php echo $row['paddress'];?></td>
												 <td><?php echo $row['pmobile'];?></td>
												 <td style="min-width: 200px;"><?php echo $row['daddress'];?></td>
												 <td><?php echo $row['dmobile'];?></td>
												 <td><?php echo $row['description'];?></td>
												 <td style="display:flex;"><?php 
												 if($row['photos'] != '')
												 {
													 
													 
													 $im_list = explode(',',$row['photos']);
													 
									foreach($im_list as $ilist)
									{
										?>
										<img src="<?php echo $ilist;?>" width="60px" height="60px"/>
										<?php 
									}
												 }
												 else
												 {
													 
												 }
												 ?></td>
												 <td><?php echo $row['d_charge'];?></td>
												 <td><?php echo $row['distance'];?></td>
												 <td><?php echo $row['category'];?></td>
												 <td><?php 
												 $pdata = $mysqli->query("select * from tbl_payment_list where id=".$row['p_method_id']."")->fetch_assoc();
												 echo $pdata['title'];
												 ?></td>
												 <td><?php echo $row['trans_id'];?></td>
                                                
                                                </tr>
<?php } ?>                                           
                                            </tbody>
                                        </table>
									<?php } ?>
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