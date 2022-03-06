<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        <?php 
		if(isset($_POST['icat']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['question']);
			$dcharge = mysqli_real_escape_string($mysqli,$_POST['answer']);
			$okey = $_POST['status'];
			
		
				


  $table="tbl_faq";
  $field_values=array("question","answer","status");
  $data_values=array("$dname","$dcharge","$okey");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Faq Section!!',
    message: 'Faq Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="add_faq.php";}, 3000);
</script>
<?php 
		
		
		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['question']);
			$dcharge = mysqli_real_escape_string($mysqli,$_POST['answer']);
			$okey = $_POST['status'];
			
			
$table="tbl_faq";
  $field = array('question'=>$dname,'status'=>$okey,'answer'=>$dcharge);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Faq Section!!',
    message: 'Faq Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="list_faq.php";}, 3000);
</script>
<?php 
		}
		?>
		

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
				<?php 
				if(isset($_GET['id']))
				{
					?>
					<h1>Edit Faq</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add Faq</h1>
				<?php } ?>
                </div>
				
				<div class="card">
				
				
				<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from tbl_faq where id=".$_GET['id']."")->fetch_assoc();
					?>
					<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Question</label>
                                            <input type="text"  value="<?php echo $data['question'];?>" class="form-control" placeholder="Enter Question" name="question" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Answer</label>
                                            <input type="text" class="form-control" value="<?php echo $data['answer'];?>"  placeholder="Enter Answer" name="answer" required="">
                                        </div>
										  <div class="form-group">
                                            <label>Faq Status</label>
                                            <select name="status" class="form-control">
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update Faq</button>
                                    </div>
                                </form>
					<?php 
				}
				else 
				{
					?>
                                <form method="post">
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Question</label>
                                            <input type="text"   class="form-control" placeholder="Enter Question" name="question" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Answer</label>
                                            <input type="text" class="form-control" placeholder="Enter Answer" name="answer" required="">
                                        </div>
										 <div class="form-group">
                                            <label>Faq Status</label>
                                            <select name="status" class="form-control">
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add Faq</button>
                                    </div>
                                </form>
				<?php } ?>
                            </div>
            </div>
					
                
            </section>
        </div>
        
       
    </div>
</div>

<?php require 'include/footer.php';?>
</body>


</html>