<?php
session_start();
if (!isset($_SESSION['USER_ID'])){
header("Location:index.html");
exit();
}

include_once("users.php");
	$first=new users();
	$obj=new users();
    $main=new users();
    $final=new users();
    $number=new users();

    $poolId=$_REQUEST['poolId'];
    $userId = $_SESSION['USER_ID'];
    $owner = $_REQUEST['owner'];

    $begin = $first->getNumber($poolId);
    $phone = $number->getPhone($userId);
    $phoneNumber=$number->fetch();
    $result=$first->fetch();
    $numAllow = $result['NUMBER_ALLOWED'];
    $numExist = $result['NUMBER_JOINED'];
    $owner = $result['OWNER'];
    if(!$begin){
    	$data=array("result"=>"0");
		    echo json_encode($data);
			return;
    }

    $diff=strcmp($numAllow,$numExist);
     if ($diff==0){
     	$data=array("result"=>"3");
		     echo json_encode($data);
			 return;	
     }
   	
   	if ($owner == $userId){
   		$data=array("result"=>"4");
		     echo json_encode($data);
			 return;
   	}

   	$fCheck=$final->finalCheck($poolId);
   	$figure=$final->fetch();
   	
   	while ($figure){
   		$testUser=$figure['USER_ID'];
    	if ($testUser==$userId){
  	       $data=array("result"=>"2");
  	       echo json_encode($data);
			return;
  	       }
		   $figure = $final->fetch();
  	   }

    $row=$obj->joinPool($poolId);
    $secondRow=$main->userPoolId($poolId,$userId,$owner);
    $number = $phoneNumber['PHONE_NUMBER'];
    $sender="CarPool";
    $message="You have successfully joined the pool. Please keep to the time and once in the pool you can not leave. Thank you. Localhost";
    $message=preg_replace('/\s+/', '%20', $message);
    if ($row && $secondRow){
     		$url="http://52.89.116.249:13013/cgi-bin/sendsms?username=mobileapp&password=foobar&to=$number&from=$sender&text=$message";

	 $ch = curl_init($url);   
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$result = curl_exec($ch);
     curl_close($ch);
    	$data=array("result"=>"1");
		    echo json_encode($data);
			return;			
	}else {
			$data=array("result"=>"0");
		    echo json_encode($data);
			return;
		}
?>