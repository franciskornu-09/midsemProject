<?php
session_start();
if (!isset($_SESSION['USER_ID'])){
header("Location:index.html");
exit();
}

include_once("users.php");
    $obj=new users();

    $userId=$_SESSION['USER_ID'];

    $row=$obj->profile($userId);
    
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
			echo '{"result":1, "profile":[';

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