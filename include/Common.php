<?php 
require 'dbconfig.php';
$GLOBALS['mysqli'] = $mysqli;
class Common {
 

	function Login($username,$password,$tblname) {
		if($tblname == 'admin')
		{
		$q = "select * from ".$tblname." where username='".$username."' and password='".$password."'";
	return $GLOBALS['mysqli']->query($q)->num_rows;
		}
		else if($tblname == 'vendor')
		{
			$q = "select * from ".$tblname." where email='".$username."' and password='".$password."'";
	return $GLOBALS['mysqli']->query($q)->num_rows;
		}
		else 
		{
			$q = "select * from ".$tblname." where email='".$username."' and password='".$password."' and status=1";
	return $GLOBALS['mysqli']->query($q)->num_rows;
		}
	}
	
	function Insertdata($field,$data,$table){

    //$field_values= implode(',',$field);
    //$data_values=implode("','",$data);
    $columns = implode(", ",$field);
    $values  = "'" . implode("','",$data) . "'";
    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    return $GLOBALS['mysqli']->query($sql); ;
    
  }
  
  function Insertdata_id($field,$data,$table){

    //$field_values= implode(',',$field);
    //$data_values=implode("','",$data);
    $columns = implode(", ",$field);
    $values  = "'" . implode("','",$data) . "'";
    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    return $GLOBALS['mysqli']->query($sql); ;

   
  }
  
  function InsertData_Api($field,$data,$table){

    //$field_values= implode(',',$field);
    //$data_values=implode("','",$data);
    $columns = implode(", ",$field);
    $values  = "'" . implode("','",$data) . "'";
    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    return $GLOBALS['mysqli']->query($sql); ;

   
  }
  
  function InsertData_Api_Id($field,$data,$table){

    //$field_values= implode(',',$field);
    //$data_values=implode("','",$data);
    $columns = implode(", ",$field);
    $values  = "'" . implode("','",$data) . "'";
    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    if ($GLOBALS['mysqli']->query($sql)===TRUE) {
      return $GLOBALS['mysqli']->insert_id;;
    }
    

  
  }
  
  function UpdateData($field,$table,$where){
$valueSets = array();
foreach($field as $key => $value) {
   $valueSets[] = $key . " = '" . $value . "'";
}

/*$conditionSets = array();
foreach($where as $key => $value) {
   $conditionSets[] = $key . " = '" . $value . "'";
}*/

$sql = "UPDATE $table SET ". join(",",$valueSets) . $where;
return $GLOBALS['mysqli']->query($sql);
   
  }
  
   function UpdateData_Api($field,$table,$where){
$valueSets = array();
foreach($field as $key => $value) {
   $valueSets[] = $key . " = '" . $value . "'";
}

/*$conditionSets = array();
foreach($where as $key => $value) {
   $conditionSets[] = $key . " = '" . $value . "'";
}*/

$sql = "UPDATE $table SET ". join(",",$valueSets) . $where;
return $GLOBALS['mysqli']->query($sql);
    
  }
  
  
  
  function Deletedata($where,$table){
$sql = "DELETE FROM ".$table." ".$where;

return $GLOBALS['mysqli']->query($sql);
   
  }
 
 
}
?>