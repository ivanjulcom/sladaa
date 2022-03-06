<?php 

require 'include/dbconfig.php';

$pid = $_POST['pid'];
$c = $mysqli->query("select * from tbl_order where id=".$pid."")->fetch_assoc();
$udata = $mysqli->query("select * from tbl_user where id=".$c['uid']."")->fetch_assoc();
$pdata = $mysqli->query("select * from tbl_payment_list where id=".$c['p_method_id']."")->fetch_assoc();
?>

<div style="margin-left: auto;">
<input type='button' id='btn' class="btn btn-primary text-right cmd" value='Print Order As Image' onclick='downloadimage();'  style="float:right;">
</div>

<div id="divprint">
 
  <div class="card-body bg-white mb-2">
   
                <div class="row d-flex">
                  <div class="col-md-3">
                    <!-- Heading -->
                    <h6 class="text-muted mb-1">Order No:</h6>
                    <!-- Text -->
                    <p class="mb-lg-0 font-size-sm font-weight-bold"><?php echo $pid;?></p>
                  </div>
                  <?php 
$date=date_create($c['odate']);
$order_date =  date_format($date,"d-m-Y");
?>
                  <div class="col-md-3">
                    <!-- Heading -->
                    <h6 class="text-muted mb-1">Shipped date:</h6>
                    <!-- Text -->
                    <p class="mb-lg-0 font-size-sm font-weight-bold">
                      <span><?php echo $order_date;?></span>
                    </p>
                  </div>
                  
                  <div class="col-md-3">
                    <!-- Heading -->
                    <h6 class="text-muted mb-1">Mobile Number:</h6>
                    <!-- Text -->
                    <p class="mb-0 font-size-sm font-weight-bold"> <?php echo $udata['mobile'];?></p>
                  </div>
                  
                  <div class="col-md-3">
                    <!-- Heading -->
                    <h6 class="text-muted mb-1">Customer Name:</h6>
                    <!-- Text -->
                    <p class="mb-0 font-size-sm font-weight-bold"><?php echo $udata['fname'].' '.$udata['lname'];?></p>
                  </div>
                  
                </div>
              </div>
              <div class="card style-2 mb-2">
                <div class="card-header d-flex">
                  <h4 class="mb-0">Order Item </h4>
                  
                </div>
                <div class="card-body">
                  <ul class="order-details item-groups">
                  
                    <!-- Single Items -->
                    <?php 

$get_data = $mysqli->query("select * from tbl_order_product where oid=".$pid."");
$op = 0;
while($row = $get_data->fetch_assoc())
{
  $op = $op + 1;
$discount = $row['pprice'] * $row['pdiscount']*$row['pquantity'] /100;
  ?>
                    <li>
                      <div class="row align-items-center">
                        <div class="col-4 col-md-3 col-xl-2">
                          <a href="#"><img src="<?php echo $row['pimg'];?>" width="100px"/></a>
                        </div>
                        
                        <div class="col">
                          <!-- Title -->
                          <p class="mb-2 font-size-sm font-weight-bold">
                            <a class="text-body" href=""><?php echo $op;?>) <?php echo $row['ptitle'].' ( '.$row['ptype'].' )';?></a> <br>
                            <span class="theme-cl"> <?php echo $row['pdiscount'].' %';?></span>
                          </p>

                          <!-- Text -->
                          <div class="font-size-sm text-muted">
                           
                            Qty: <?php echo $row['pquantity'];?> x <?php echo $row['pprice'].' '.$set['currency'];?> <br>
                            Price: <?php echo ($row['pprice'] * $row['pquantity']) - $discount.' '.$set['currency'];?>

                          </div>

                        </div>
                      </div>
                    </li>
                    <?php       
} ?>
                  </ul>
                </div>
              </div>
              <div class="card style-2 mb-2">
                <div class="card-header">
                  <h4 class="mb-0">Total Order</h4>
                </div>
                <div class="card-body">
                  <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                    <li class="list-group-item d-flex">
                      <span>Subtotal</span>
                      <span class="ml-auto float-right"><?php echo $c['subtotal'].' '.$set['currency'];?></span>
                    </li>
                  <?php 
  if($c['cou_amt'] != 0)
  {
  ?>
                    <li class="list-group-item d-flex">
                      <span>Coupon Code</span>
                      <span class="ml-auto float-right"><?php echo $c['cou_amt'].' '.$set['currency'];?></span>
                    </li>
                     <?php } ?>
					 
					 <?php 
  if($c['wall_amt'] != 0)
  {
  ?>
                    <li class="list-group-item d-flex">
                      <span>Wallet</span>
                      <span class="ml-auto float-right"><?php echo $c['wall_amt'].' '.$set['currency'];?></span>
                    </li>
                     <?php } ?>
					 
                    <li class="list-group-item d-flex">
                      <span>Delivery Charge</span>
                      <span class="ml-auto float-right"><?php echo $c['d_charge'].' '.$set['currency'];?></span>
                    </li>
                    
                    <li class="list-group-item d-flex font-size-lg font-weight-bold">
                      <span>Net Amount</span>
                      <span class="ml-auto float-right"><?php echo $c['o_total'].' '.$set['currency'];?></span>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card style-2">
                <div class="card-header">
                  <h4 class="mb-0">Shipping &amp; Billing  Details</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                                       
                    <div class="col-12 col-md-6" style="margin-bottom: 10px;">
                      <!-- Heading -->
                      <p class="mb-2 font-weight-bold">
                        Shipping Address:
                      </p>

                      <p class="mb-7 mb-md-0">
                       <?php echo $c['address'];?>
                      </p>
                    </div>
                    
                    <div class="col-12 col-md-6">
<?php 
if($c['p_method_id'] == 2)
{
}
else
{
  ?>
                      <!-- Heading -->
                      <p class="mb-2 font-weight-bold">
                       >Transaction Id:
                      </p>

                      <p class="mb-2 text-gray-500">
                        <?php echo $c['trans_id'];?>
                      </p>
<?php 
}
?>
                      <!-- Heading -->
                      <p class="mb-2 font-weight-bold">
                        Order Status:
                      </p>

                      <p class="mb-0">
                        <?php echo $c['o_status'];?>
                      </p>

                    </div>
					<br><br>
					<div class="col-12 col-md-12">
                      <!-- Heading -->
                      <p class="mb-2 font-weight-bold">
                        Additional Notes:
                      </p>

                      <p class="mb-7 mb-md-0">
                       <?php echo $c['a_note'];?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              
</div>