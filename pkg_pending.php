<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
$getkey = $mysqli->query("select * from setting")->fetch_assoc();
define('ONE_KEY',$getkey['one_key']);
define('ONE_HASH',$getkey['one_hash']);
define('r_key',$getkey['r_key']);
define('r_hash',$getkey['r_hash']);

function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

?>
        <!-- Start main left sidebar menu -->
        



		 
		
		
        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
				<?php 
				if(isset($_GET['oid']))
				{
					?>
					<h1>Assign Rider</h1>
					<?php 
				}
				elseif(isset($_GET['dsid']))
				{
					?>
					<h1>ACCEPT OR REJECT ORDER</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Pending Package Order List</h1>
                <?php } ?>
				</div>
				<div class="card">
				
                               <div class="card-body">
							   <?php
							   if(isset($_GET['oid']))
				{
							   ?>
							   <form class="form" method="post" enctype="multipart/form-data">
							<div class="form-body">
								

							<?php 
							$odata = $mysqli->query("select * from pkg_order where id=".$_GET['oid']."")->fetch_assoc();
							?>

								<div class="form-group">
									<label for="cname">Select Delivery Boy</label>
									<select name="srider" class="form-control">
									<option value="">select a Delivery Boy</option>
									<?php 
									$rid = $mysqli->query("select * from rider where a_status=1 and status=1");
									while($ro = $rid->fetch_assoc())
									{
									?>
									<option value="<?php echo $ro['id'];?>"><?php echo $ro['name'];?></option>
									<?php } ?>
									</select>
								</div>
                                
								
								
								<div class="card-footer text-left">
                                        <button name="assign_rider" class="btn btn-primary">Assign Rider</button>
                                    </div>
								</div>
								</form>
								
								<?php 
					if(isset($_POST['assign_rider']))
					{
						
						$rid = $_POST['srider'];
						
						$id = $_GET['oid'];
						$check = $mysqli->query("select * from pkg_order where id=".$id."")->fetch_assoc();
						if($check['order_status'] != 4)
						{
							
						$table="pkg_order";
  $field = array('rid'=>$rid,'order_status'=>3);
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
	  
	  $timestamp = date("Y-m-d H:i:s");
						


 $table="tbl_rnoti";
  $field_values=array("rid","msg","date");
  $data_values=array("$rid",'You have an Package order assigned to you.',"$timestamp");
  
$hs = new Common();
	   $hs->InsertData($field_values,$data_values,$table);
	  
											$content = array(
"en" => 'You have an Package order assigned to you.'//mesaj burasi
);
$fields = array(
'app_id' => r_key,
'included_segments' =>  array("Active Users"),
'filters' => array(array('field' => 'tag', 'key' => 'rider_id', 'relation' => '=', 'value' => $rid)),
'contents' => $content
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.r_hash));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);

if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Delivery Boy Section!!',
    message: 'Delivery Boy Assigned Successfully!!',
    position: 'topRight'
  });
  setTimeout(function(){ window.location.href="pkg_pending.php";}, 3000);
  </script>
  
<?php 
}

						}
						else 
						{
							?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Delivery Boy Section!!',
    message: 'Assign Delivery Boy Already Accepted Order So Can not Change Delivery Boy!!',
    position: 'topRight'
  });
  setTimeout(function(){ window.location.href="pkg_pending.php";}, 3000);
  </script>
							<?php 
						}
					}
					?>
								
							   <?php }
							   else if(isset($_GET['dsid']))
				{
							   ?>
							  <form class="form" method="post" enctype="multipart/form-data">
							<div class="form-body">
								


								<div class="form-group">
									<label for="cname">Select Status</label>
									<select name="status" class="form-control" required>
									<option value="">select a Status</option>
									<option value="1">Accept</option>
									<option value="2">Reject</option>
									</select>
								</div>
                                
								<div class="form-group">
									<label for="cname">Comment</label>
									<textarea  class="form-control" name="comment"  required></textarea>
								</div>
								
								<div class="card-footer text-left">
                                        <button name="make_decision" class="btn btn-primary">Submit Decision</button>
                                    </div>
								</div>
								</form>
								<?php 
								if(isset($_POST['make_decision']))
								{
									$status = $_POST['status'];
									$comment = $_POST['comment'];
									if($status == 1)
									{
									 
									 $table="pkg_order";
  $field = array('a_status'=>$status,'comment_reject'=>$comment,'order_status'=>1);
  $where = "where id=".$_GET['dsid']."";
  
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
	  $checks = $mysqli->query("select * from pkg_order where id=".$_GET['dsid']."")->fetch_assoc(); 
	  $uid = $checks['uid'];
			$udata = $mysqli->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['fname'].' '.$udata['lname'];

	  $oid = $_GET['dsid'];
	  $timestamp = date("Y-m-d H:i:s");

$title_main = "Order Confirmed!!";
$description = $name.', Your Package Order #'.$oid.' Has Been Confirmed.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Common();
	   $h->Insertdata($field_values,$data_values,$table);
	   
	   
$content = array(
       "en" => $name.', Your Package Order #'.$_GET['dsid'].' Has Been Confirmed.'
   );
$heading = array(
   "en" => "Order Confirmed!!"
);

$fields = array(
'app_id' => ONE_KEY,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$_GET['dsid']),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/order_process_img/confirmed.png'
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.ONE_HASH));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);

if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Decision Section!!',
    message: 'Approve Decision Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}

									}
									else 
									{
										 
										 $table="pkg_order";
  $field = array('a_status'=>$status,'comment_reject'=>$comment,'order_status'=>2,'o_status'=>'Cancelled');
  $where = "where id=".$_GET['dsid']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Decision Section!!',
    message: 'Reject Decision Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}

									}
									?>
									<script>
setTimeout(function(){ window.location.href="pkg_pending.php";}, 3000);
</script>
									<?php 
								}
									?>
							   <?php } else { ?>
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
												 <th>Delivery Boy Name</th>
                                                 <th>Current Status</th>
												 <th>Order Flow</th>
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
											 $stmt = $mysqli->query("SELECT * FROM `pkg_order` where o_status!='Cancelled' and o_status!='Completed' and rid=".$rid." order by id desc");

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
											   <td><?php $rdata = $mysqli->query("select * from rider where id=".$row['rid']."")->fetch_assoc(); if($rdata['name'] == '') {echo '';}else {echo $rdata['name'];}?></td>
											   <td> <?php echo $row['o_status']; ?></td>
											   <td><?php 
											   if($row['order_status'] == 0)
											   {
												   ?>
												   <span class="badge badge-primary">Waiting For Decision</span>
												   <?php 
											   }
											   else if($row['order_status'] == 1)
											   {
												  ?>
												   <span class="badge badge-primary">Accepted Waiting For Assign</span>
												   <?php  
											   }
											   else if($row['order_status'] == 2)
											   {
												  ?>
												   <span class="badge badge-danger">Cancelled By You</span>
												   <?php  
											   }
											   else if($row['order_status'] == 3)
											   {
												  ?>
												   <span class="badge badge-primary">Waiting For Delivery Boy Decision</span>
												   <?php  
											   }
											   else if($row['order_status'] == 4)
											   {
												  ?>
												   <span class="badge badge-primary">Delivery Boy Accepted Order</span>
												   <?php  
											   }
											   else if($row['order_status'] == 5)
											   {
												  ?>
												   <span class="badge badge-primary">Delivery Boy Reject Order</span>
												   <?php  
											   }
											   else if($row['order_status'] == 6)
											   {
												  ?>
												   <span class="badge badge-primary">Delivery Boy PickUp Order</span>
												   <?php  
											   }
											   else if($row['order_status'] == 7)
											   {
												  ?>
												   <span class="badge badge-primary">Delivery Boy Completed Order</span>
												   <?php  
											   }
											   else if($row['order_status'] == 8)
											   {
												  ?>
												   <span class="badge badge-primary">Cancelled By Customer</span>
												   <?php  
											   }
											   else if($row['order_status'] == 9)
											   {
												  ?>
												   <span class="badge badge-primary">Delivery Boy Cancelled Order</span>
												   <?php  
											   }
											   else 
											   {
											   }
											   ?></td>
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
                                               
												 <th>Order Id</th>
                                                 <th>Order Date </th>
												 <th>Delivery Boy Name</th>
                                                 <th>Current Status</th>
												 <th>Order Flow</th>
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
												 <th>Order Assign?</th>
												 <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											
											 $stmt = $mysqli->query("SELECT * FROM `pkg_order` where o_status!='Cancelled' and o_status!='Completed'  order by id desc");

while($row = $stmt->fetch_assoc())
{
	
											?>
                                                <tr>
												
												
												
												<td> <?php echo $row['id']; ?> </td>
                                                
                                                
                                               <td> <?php 
											   $date=date_create($row['odate']);
echo date_format($date,"d-m-Y");
											   ?></td>
											   <td><?php $rdata = $mysqli->query("select * from rider where id=".$row['rid']."")->fetch_assoc(); if($rdata['name'] == '') {echo '';}else {echo $rdata['name'];}?></td>
											   <td> <?php echo $row['o_status']; ?></td>
											   <td><?php 
											   if($row['order_status'] == 0)
											   {
												   ?>
												   <span class="badge badge-primary">Waiting For Decision</span>
												   <?php 
											   }
											   else if($row['order_status'] == 1)
											   {
												  ?>
												   <span class="badge badge-primary">Accepted Waiting For Assign</span>
												   <?php  
											   }
											   else if($row['order_status'] == 2)
											   {
												  ?>
												   <span class="badge badge-danger">Cancelled By You</span>
												   <?php  
											   }
											   else if($row['order_status'] == 3)
											   {
												  ?>
												   <span class="badge badge-primary">Waiting For Delivery Boy Decision</span>
												   <?php  
											   }
											   else if($row['order_status'] == 4)
											   {
												  ?>
												   <span class="badge badge-primary">Delivery Boy Accepted Order</span>
												   <?php  
											   }
											   else if($row['order_status'] == 5)
											   {
												  ?>
												   <span class="badge badge-primary">Delivery Boy Reject Order</span>
												   <?php  
											   }
											   else if($row['order_status'] == 6)
											   {
												  ?>
												   <span class="badge badge-primary">Delivery Boy PickUp Order</span>
												   <?php  
											   }
											   else if($row['order_status'] == 7)
											   {
												  ?>
												   <span class="badge badge-primary">Delivery Boy Completed Order</span>
												   <?php  
											   }
											   else if($row['order_status'] == 8)
											   {
												  ?>
												   <span class="badge badge-primary">Cancelled By Customer</span>
												   <?php  
											   }
											   else if($row['order_status'] == 9)
											   {
												  ?>
												   <span class="badge badge-primary">Delivery Boy Cancelled Order</span>
												   <?php  
											   }
											   else 
											   {
											   }
											   ?></td>
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
										<img src="<?php echo $ilist;?>" width="100px" />
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
                                                <td>
												<a href="?oid=<?php echo $row['id']; ?>"   class="btn btn-info <?php if($row['order_status'] == 0 or $row['o_status'] == 'Cancelled' or $row['order_status'] == 2 or $row['order_status'] == 3 or $row['order_status'] == 4 or $row['order_status'] == 6 or $row['order_status'] == 7 or $row['order_status'] == 8){ echo 'disabled'; } ?>"><?php if($row['order_status'] == 5){?>Reassign Delivery Boy<?php } else { ?>Assign Delivery Boy<?php } ?></a>
												</td>
												<td>
												<?php if($row['a_status'] == 0){?>
												<a href="?dsid=<?php echo $row['id']; ?>"  class="btn btn-success">Make A Decision</a>
												
												<?php }else if($row['a_status'] == 1) {?>
												<span class="text text-success">Accepted</span>
												<?php } else { ?>
												<span class="text text-danger"> Rejected </span>
												<?php } ?>
												
												</td>
                                                </tr>
<?php } ?>                                           
                                            </tbody>
                                        </table>
									<?php } ?>
                                    </div>
									<?php } ?>
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