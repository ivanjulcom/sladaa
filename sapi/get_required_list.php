 <?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
header('Content-type: text/json');

$data = json_decode(file_get_contents('php://input'), true);
 
$sid = $data['sid'];
if($sid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$cp = array();
	
	$p =array();
	$sdata = $mysqli->query("select * from vendor where id='".$sid."'")->fetch_assoc();
$cat = $mysqli->query("select * from category where cat_status = 1 and id IN(".$sdata['scat'].")");
while($rows = $cat->fetch_assoc())
{
    $p['id'] = $rows['id'];
		$p['catname'] = $rows['cat_name'];
		
		
		$cp[] = $p;
}
$pincode = array();
$ps = array();
$web = $mysqli->query("select * from tbl_pincode where status=1 and id IN(".$sdata['aid'].")");
while($hj = $web->fetch_assoc())
{
    $ps['id'] = $hj['id'];
		$ps['pincode'] = $hj['pincode'];
		
		
		$pincode[] = $ps;
}

$kp = array('Catlist'=>$cp,'Pincodelist'=>$pincode);
	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Required Data Get Successfully!","ResultData"=>$kp);
}
echo json_encode($returnArr);