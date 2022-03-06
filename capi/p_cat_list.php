<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '' or $data['store_id'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $store_id = strip_tags(mysqli_real_escape_string($mysqli,$data['store_id']));
    
  $sdata = $mysqli->query("select * from vendor where id='".$store_id."' and status=1 and vstatus=1")->fetch_assoc();
$check = $mysqli->query("select * from category where cat_status=1 and id IN(".$sdata['scat'].") ");
$op = array();
$p = array();
while($row = $check->fetch_assoc())
{
$p['id'] = $row['id'];
		$p['catname'] = $row['cat_name'];
		$p['catimg'] = 'sladaa/'.$row['cat_img'];
		$p['count'] = $mysqli->query("select * from tbl_product where mcat=".$row['id']." and mstatus=1 and sid=".$store_id."")->num_rows;
		$op[] = $p;
}
$returnArr = array("CategoryData"=>$op,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Category Get Successfully!!");
}
echo json_encode($returnArr);