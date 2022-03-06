 <?php 
require 'include/navbar.php';
require 'include/sidebar.php';
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>
        <!-- Start main left sidebar menu -->
        <?php 
		if(isset($_POST['icat']))
		{
			

if($_FILES['csv']['error'] == 0){
    $name = $_FILES['csv']['name'];
    $ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
    $type = $_FILES['csv']['type'];
    $tmpName = $_FILES['csv']['tmp_name'];

    // check the file is a csv
    if($ext === 'csv'){
        if(($handle = fopen($tmpName, 'r')) !== FALSE) {
            // necessary if a large csv file
            set_time_limit(0);

            $row = 0;
fgets($handle);
            while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                // number of fields in the csv
                $col_count = count($data);
				
date_default_timezone_set('Asia/Kolkata');
        $timestamp = date("Y-m-d");
                // get the values from the csv
				$counts = $mysqli->query("select * from tbl_product where mtitle='".$data[1]."'")->num_rows;
				if($counts != 0 ) 
				{
					
				}
				else 
				{
					

$store_id = $sdata['id'];
$rdate = date("Y-m-d H:i:s");
  $table="tbl_product";
  $field_values=array("m_img","mtitle","mstatus","mcat","pincode","mdesc","rdate","sid");
  $data_values=array("$data[0]","$data[1]","$data[2]","$data[3]","$data[4]","$data[5]","$rdate","$store_id");
  
$h = new Common();
	   $product = $h->Insertdata_id($field_values,$data_values,$table);
	
$mtype = explode(',',$data[6]);
$mprice = explode(',',$data[7]);
$mdiscount = explode(',',$data[8]);
$mstock =  explode(',',$data[9]);
for($i=0;$i<count($mtype);$i++)
{
	echo $mprice[$i];
  $table="tbl_product_attribute";
  $field_values=array("pid","price","title","discount","ostock","sid");
  $data_values=array("$product","$mprice[$i]","$mtype[$i]","$mdiscount[$i]","$mstock[$i]","$store_id");
  $check = $h->InsertData($field_values,$data_values,$table);
}
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Import Product Section!!',
    message: 'Import Product  Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}

				}
			}
		}
	}
}
?>
<script>
setTimeout(function(){ window.location.href="product_import.php";}, 3000);
</script>
<?php 
		
		
		}
		?>
		
		
		

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
				
				
				
                    <h1>Upload Csv Product</h1>
				
                </div>
				
				<div class="card">
				
				
				
                                <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="form-body">
								

								

								
								<div class="form-group">
									<label for="cname">select A Csv</label>
									<input type="file" name="csv"  class="form-control"   required>
								</div>
								
                                		

								
								
							</div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Upload Csv</button>
										<a href="importproduct.csv" target="_blank" class="btn btn-raised btn-raised btn-info" id="download" >Demo Csv</a>
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


</html>