<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        <?php 
		if(isset($_POST['usetting']))
		{
			$dname = $_POST['dname'];
			$dsname = $_POST['dsname'];
			$minorder = $_POST['minorder'];
			$itemlimit = $_POST['itemlimit'];
			$sgen = $_POST['sgen'];
			$okey = $_POST['okey'];
			$ohash = $_POST['ohash'];
			$r_key = $_POST['r_key'];
			$r_hash = $_POST['r_hash'];
			$s_key = $_POST['s_key'];
			$s_hash = $_POST['s_hash'];
			$signupcredit = $_POST['signupcredit'];
			$refercredit = $_POST['refercredit'];
			$afprice = $_POST['afprice'];
			$ukms = $_POST['ukms'];
			$utprice = $_POST['utprice'];
			$currency = $mysqli -> real_escape_string($_POST['currency']);
			$policy = $mysqli -> real_escape_string($_POST['policy']);
			$about = $mysqli -> real_escape_string($_POST['about']);
			$contact = $mysqli -> real_escape_string($_POST['contact']);
			$terms = $mysqli -> real_escape_string($_POST['terms']);
			$timezone = $mysqli -> real_escape_string($_POST['timezone']);
			$p_limit = $_POST['p_limit'];
			$id = 1;
			if($_FILES["llogo"]["name"] == '' and $_FILES["pdbanner"]["name"] == '')
			{
				$table="setting";
  $field = array('signupcredit'=>$signupcredit,'refercredit'=>$refercredit,'d_title'=>$dname,'d_s_title'=>$dsname,'one_key'=>$okey,'one_hash'=>$ohash,'r_key'=>$r_key,'r_hash'=>$r_hash,'s_key'=>$s_key,'s_hash'=>$s_hash,'currency'=>$currency,'policy'=>$policy,'about'=>$about,'contact'=>$contact,'terms'=>$terms,'timezone'=>$timezone,'p_limit'=>$p_limit,'utprice'=>$utprice,'ukms'=>$ukms,'afprice'=>$afprice,'minorder'=>$minorder,'itemlimit'=>$itemlimit,'sgen'=>$sgen);
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Setting Section!!',
    message: 'Setting Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}

				
?>
<script>
setTimeout(function(){ window.location.href="setting.php";}, 3000);
</script>
<?php 
			}
			else if($_FILES["llogo"]["name"] == '' and $_FILES["pdbanner"]["name"] != '')
			{
				
				$target_dir = "assets/img/";
$target_file = $target_dir . basename($_FILES["pdbanner"]["name"]);
			
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
				move_uploaded_file($_FILES["pdbanner"]["tmp_name"], $target_file);
				$table="setting";
  $field = array('signupcredit'=>$signupcredit,'refercredit'=>$refercredit,'d_title'=>$dname,'d_s_title'=>$dsname,'one_key'=>$okey,'one_hash'=>$ohash,'r_key'=>$r_key,'r_hash'=>$r_hash,'s_key'=>$s_key,'s_hash'=>$s_hash,'currency'=>$currency,'pdbanner'=>$target_file,'policy'=>$policy,'about'=>$about,'contact'=>$contact,'terms'=>$terms,'timezone'=>$timezone,'p_limit'=>$p_limit,'utprice'=>$utprice,'ukms'=>$ukms,'afprice'=>$afprice,'minorder'=>$minorder,'itemlimit'=>$itemlimit,'sgen'=>$sgen);
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Setting Section!!',
    message: 'Setting Update Successfully!!',
    position: 'topRight'
  });
  </script>
<?php 
}


?>
<script>
setTimeout(function(){ window.location.href="setting.php";}, 3000);
</script>
<?php
			
			}
			else if($_FILES["llogo"]["name"] != '' and $_FILES["pdbanner"]["name"] == '')
			{
				$target_dir = "assets/img/";
$target_file = $target_dir . basename($_FILES["llogo"]["name"]);
			
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
				move_uploaded_file($_FILES["llogo"]["tmp_name"], $target_file);
				$table="setting";
  $field = array('signupcredit'=>$signupcredit,'refercredit'=>$refercredit,'d_title'=>$dname,'d_s_title'=>$dsname,'one_key'=>$okey,'one_hash'=>$ohash,'r_key'=>$r_key,'r_hash'=>$r_hash,'s_key'=>$s_key,'s_hash'=>$s_hash,'currency'=>$currency,'logo'=>$target_file,'policy'=>$policy,'about'=>$about,'contact'=>$contact,'terms'=>$terms,'timezone'=>$timezone,'p_limit'=>$p_limit,'utprice'=>$utprice,'ukms'=>$ukms,'afprice'=>$afprice,'minorder'=>$minorder,'itemlimit'=>$itemlimit,'sgen'=>$sgen);
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Setting Section!!',
    message: 'Setting Update Successfully!!',
    position: 'topRight'
  });
  </script>
<?php 
}


?>
<script>
setTimeout(function(){ window.location.href="setting.php";}, 3000);
</script>
<?php
			
			

		}
		else 
		{
		$target_dir = "assets/img/";
$target_file = $target_dir . basename($_FILES["llogo"]["name"]);
			
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
				move_uploaded_file($_FILES["llogo"]["tmp_name"], $target_file);
				
				$target_files = $target_dir . basename($_FILES["pdbanner"]["name"]);
			
			$imageFileType = strtolower(pathinfo($target_files,PATHINFO_EXTENSION));
   
				move_uploaded_file($_FILES["pdbanner"]["tmp_name"], $target_files);
				
				$table="setting";
  $field = array('signupcredit'=>$signupcredit,'refercredit'=>$refercredit,'d_title'=>$dname,'d_s_title'=>$dsname,'one_key'=>$okey,'one_hash'=>$ohash,'r_key'=>$r_key,'r_hash'=>$r_hash,'s_key'=>$s_key,'s_hash'=>$s_hash,'currency'=>$currency,'logo'=>$target_file,'pdbanner'=>$target_files,'policy'=>$policy,'about'=>$about,'contact'=>$contact,'terms'=>$terms,'timezone'=>$timezone,'p_limit'=>$p_limit,'utprice'=>$utprice,'ukms'=>$ukms,'afprice'=>$afprice,'minorder'=>$minorder,'itemlimit'=>$itemlimit,'sgen'=>$sgen);
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Setting Section!!',
    message: 'Setting Update Successfully!!',
    position: 'topRight'
  });
  </script>
<?php 
}


?>
<script>
setTimeout(function(){ window.location.href="setting.php";}, 3000);
</script>
<?php	
		}
		}
		?>

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Setting</h1>
                </div>
				<div class="card">
				
                                <form method="post" enctype="multipart/form-data" onsubmit="return postForm()">
                                    
									
                                    <div class="card-body">
									<div class="row">
									<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>DashBoard Name</label>
                                            <input type="text" class="form-control" name="dname" required="" value="<?php echo $set['d_title']; ?>">
                                        </div>
										</div>
										<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>DashBoard Short Name</label>
                                            <input type="text" class="form-control" name="dsname" value="<?php echo $set['d_s_title']; ?>" required="">
                                        </div>
										</div>
										<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>User App Onesignal App Id</label>
                                            <input type="text" class="form-control" name="okey" required value="<?php echo $set['one_key']; ?>">
                                        </div>
										</div>
										<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group ">
                                            <label>User Boy App Onesignal Rest Api Key</label>
                                            <input type="text" class="form-control" name="ohash" required value="<?php echo $set['one_hash']; ?>">
                                        </div>
										</div>
										<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Delivery Boy App Onesignal App Id</label>
                                            <input type="text" class="form-control" name="r_key" required value="<?php echo $set['r_key']; ?>">
                                        </div>
										</div>
										<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group ">
                                            <label>Delivery Boy Onesignal Rest Api Key</label>
                                            <input type="text" class="form-control" name="r_hash" required value="<?php echo $set['r_hash']; ?>">
                                        </div>
										</div>
										<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Store App Onesignal App Id</label>
                                            <input type="text" class="form-control" name="s_key" required value="<?php echo $set['s_key']; ?>">
                                        </div>
										</div>
										<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group ">
                                            <label>Store App Onesignal Rest Api Key</label>
                                            <input type="text" class="form-control" name="s_hash" required value="<?php echo $set['s_hash']; ?>">
                                        </div>
										</div>
										<div class="col-md-3 col-xs-12 col-sm-12 col-lg-3">
										<div class="form-group ">
                                            <label>Set Currency</label>
                                            <input type="text" class="form-control" name="currency" required value="<?php echo $set['currency']; ?>">
                                        </div>
										</div>
										<div class="col-md-3 col-xs-12 col-sm-12 col-lg-3">
										<div class="form-group">
                                            <label>Website Logo/Favicon</label>
                                            <input type="file" class="form-control" name="llogo">
											<br>
											<img src="<?php echo $set['logo']; ?>" width="60" height="60"/>
                                        </div>
										</div>
										<div class="col-md-3 col-xs-12 col-sm-12 col-lg-3">
										<?php 
								$tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
								$limit =  count($tzlist);
								?>
								<div class="form-group">
									<label for="cname">Select Timezone</label>
									<select name="timezone" class="form-control" required>
									<option value="">Select Timezone</option>
									<?php 
									for($k=0;$k<$limit;$k++)
									{
									?>
									<option <?php echo $tzlist[$k];?> <?php if($tzlist[$k] == $set['timezone']) {echo 'selected';}?>><?php echo $tzlist[$k];?></option>
									<?php } ?>
									</select>
								</div>
								</div>
								<div class="col-md-3 col-xs-12 col-sm-12 col-lg-3">
										<div class="form-group ">
                                            <label>Set Payout Limit</label>
                                            <input type="text" class="form-control" name="p_limit" required value="<?php echo $set['p_limit']; ?>">
                                        </div>
										</div>
								
								<div class="col-md-3 col-xs-12 col-sm-12 col-lg-3">
										<div class="form-group ">
                                            <label>Upto Kms</label>
                                            <input type="text" class="form-control" name="ukms" onkeypress='validate(event)' required value="<?php echo $set['ukms']; ?>">
                                        </div>
										</div>
										<div class="col-md-3 col-xs-12 col-sm-12 col-lg-3">
										<div class="form-group ">
                                            <label>Up To Km Price</label>
                                            <input type="text" class="form-control" name="utprice" onkeypress='validate(event)' required value="<?php echo $set['utprice']; ?>">
                                        </div>
										</div>
										<div class="col-md-3 col-xs-12 col-sm-12 col-lg-3">
										<div class="form-group ">
                                            <label>After KmPrice</label>
                                            <input type="text" class="form-control" name="afprice" onkeypress='validate(event)' required value="<?php echo $set['afprice']; ?>">
                                        </div>
										</div>
										
										<div class="col-md-3 col-xs-12 col-sm-12 col-lg-3">
										<div class="form-group">
                                            <label>Package Delivery Banner</label>
                                            <input type="file" class="form-control" name="pdbanner">
											<br>
											<img src="<?php echo $set['pdbanner']; ?>" width="100%"/>
                                        </div>
										</div>
										
										<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
										<div class="form-group ">
                                            <label>Minimum Order</label>
                                            <input type="text" class="form-control" name="minorder" onkeypress='validate(event)' required value="<?php echo $set['minorder']; ?>">
                                        </div>
										</div>
										
										<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
										<div class="form-group ">
                                            <label>Max Item Quantity Order</label>
                                            <input type="text" class="form-control" name="itemlimit" onkeypress='validate(event)' required value="<?php echo $set['itemlimit']; ?>">
                                        </div>
										</div>
										
										<div class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
										<div class="form-group ">
                                            <label>Show Genie OR Not?</label>
<select name="sgen" class="form-control">
											<option value="1" <?php if($set['sgen'] == 1){echo 'selected';}?>>Show</option>
											<option value="0" <?php if($set['sgen'] == 0){echo 'selected';}?> >Hide</option>
											</select>                                            
											</div>
										</div>
										
										
										
										
								
								<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
										<div class="form-group">
                                            <label>Privacy Policy</label>
                                            <textarea class="form-control" id="policy" name="policy"><?php echo $set['policy'];?></textarea>
											
                                        </div>
										</div>
										
										<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
										<div class="form-group">
                                            <label>About Us</label>
                                            <textarea class="form-control" id="about" name="about"><?php echo $set['about'];?></textarea>
											
                                        </div>
										</div>
										
										<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
										<div class="form-group">
                                            <label>Contact Us</label>
                                            <textarea class="form-control" id="contact" name="contact"><?php echo $set['contact'];?></textarea>
											
                                        </div>
										</div>
										
										<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
										<div class="form-group">
                                            <label>Terms & Conditions</label>
                                            <textarea class="form-control" id="terms" name="terms"><?php echo $set['terms'];?></textarea>
											
                                        </div>
										</div>
										
										<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Sign Up Credit</label>
                                            <input type="number" class="form-control" name="signupcredit" value="<?php echo $set['signupcredit']; ?>" required>
                                        </div>
										</div>
										<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                                        <div class="form-group ">
                                            <label>Refer Credit</label>
                                            <input type="number" class="form-control" name="refercredit" value="<?php echo $set['refercredit']; ?>" required>
                                        </div>
										</div>
										
										
                                    </div>
									</div>
                                    <div class="card-footer text-left">
                                        <button name="usetting" class="btn btn-primary">Update Setting</button>
                                    </div>
                                </form>
                            </div>
            </div>
					
                
            </section>
        </div>
        
       
    </div>
</div>

<?php require 'include/footer.php';?>
</body>

<script type="text/javascript">

function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]/;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

$(document).ready(function() {
	$('#policy').summernote({
		height: "500px",
		toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]
	});
	
	$('#about').summernote({
		height: "500px",
		toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]
	});
	
	$('#terms').summernote({
		height: "500px",
		toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]
	});
	
	$('#contact').summernote({
		height: "500px",
		toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]
	});
	
});
var postForm = function() {
	 $('textarea[name="policy"]').html($('#policy').code());
	  $('textarea[name="about"]').html($('#about').code());
	   $('textarea[name="contact"]').html($('#contact').code());
	    $('textarea[name="terms"]').html($('#terms').code());
}
</script>

</html>