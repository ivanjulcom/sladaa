<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['aid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	 $aid = strip_tags(mysqli_real_escape_string($mysqli,$data['aid']));
	  $sdata = $mysqli->query("select * from rider where aid='".$aid."'");
	  $op = array();
	  while($row = $sdata->fetch_assoc())
	{
		$op[]=$row;
	}
	$returnArr = array("RiderData"=>$op,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Rider Get Successfully!!");
}
echo json_encode($returnArr);
   