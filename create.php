<?php 
session_start();
if (!isset($_SESSION['USER_ID'])){
header("Location:index.html");
exit();
}

include_once("users.php");
$obj=new users();

	$numberAllow=$_REQUEST['numAllow'];
	$date=$_REQUEST['date'];
    $location=$_REQUEST['location'];
    $userId=$_SESSION['USER_ID'];
    $time=$_REQUEST['time'];
    $amount=$_REQUEST['amount'];
    $username=$_SESSION['USERNAME'];
    $destination=$_REQUEST['destination'];

    $row = $obj->createPool($numberAllow,$date,$location,$destination,$userId,$time,$amount);
   
     if ($row){
    $data=array("result"=>"1");
		    echo json_encode($data);
			return;	
		}else {
			$data=array("result"=>"0");
		    echo json_encode($data);
			return;
		}
?>