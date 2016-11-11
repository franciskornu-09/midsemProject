<?php
session_start();
if (!isset($_SESSION['USER_ID'])){
header("Location:index.html");
exit();
}

include_once("users.php");
	$obj=new users();
	$num = new users();
	$id=$_SESSION['USER_ID'];
	$newRow=$num->poolId($id);
	if (!$newRow){
    	$data=array("result"=>"0");
		    echo json_encode($data);
			return;
    }
    $pID=$num->fetch();
    $poolId=$pID['POOL_ID'];
    
	$row=$obj->checkPools($poolId);
	 if (!$row){
    	$data=array("result"=>"0");
		    echo json_encode($data);
			return;
    }
    $result=$obj->fetch();
	
	if ($result == false){
			$data=array("result"=>"1");
		    echo json_encode($data);
			return;
			}else {
			echo '{"result":1, "checkPools":[';

        while ($result) {
            echo json_encode($result);
            $result = $obj->fetch();

            if ($result) {
                echo ",";
            }
        }
        echo "]}";	
			}
?>
