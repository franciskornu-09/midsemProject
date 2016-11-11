<?php
if(!isset($_REQUEST['cmd'])){
		echo "cmd is not provided";
		exit();
	}
	$data ="";
	$userN="";

$cmd=$_REQUEST['cmd'];
	switch($cmd){
		case 1:
			login();
			break;
		case 2:
			display();
			break;
		case 5:
			displayNews();
			break;
		case 6:
			createUser();
			break;
		case 8:
			displaySpec();
			break;
		default:
			echo "wrong cmd";	//change to json message
			break;
	}

	function displaySpec(){
	include_once("users.php");
    $obj=new users();

    $poolId=$_REQUEST['poolid'];
    $row=$obj->displayOne($poolId);
    if (!$row){
    	$data=array("result"=>"0");
		    echo json_encode($data);
			return;
    }
    $result=$obj->fetch();
    if ($result == false){
			echo '{"result":0}';	
			 return;
			 }else {
			echo '{"result":1, "details":[';

        while ($result) {
            echo json_encode($result);
            $result = $obj->fetch();

            if ($result) {
                echo ",";
            }
        }
        echo "]}";
			}
		}
	
	function createUser(){
	include_once("users.php");
    $obj=new users();
 
    $firstname=$_REQUEST['firstname'];
    $lastname=$_REQUEST['lastname'];
    $username=$_REQUEST['username'];
    $phone=$_REQUEST['phone'];
    $password=$_REQUEST['password'];
    $email=$_REQUEST['email'];

    $row=$obj->newUser($firstname,$lastname,$username,$phone,$password,$email);
    if (!$row){
    	$data=array("result"=>"0");
		    echo json_encode($data);
			return;
		}else{
			$data=array("result"=>"1");
		    echo json_encode($data);
			return;	
		}
	}

	function displayNews(){
	include_once("users.php");
    $obj=new users();

    $row = $obj->newsFeed();
    echo $row;
    if (!$row){
    	$data=array("result"=>"0");
		    echo json_encode($data);
			return;
    }else{
		$result=$obj->fetch();
		
    	if ($result == false){
			echo '{"result":0}';	
			 return;
			 }else {
			echo '{"result":1, "news":[';

        while ($result) {
            echo json_encode($result);
            $result = $obj->fetch();

            if ($result) {
                echo ",";
            }
        }
        echo "]}";
			}
		}
	}

	function login(){ 
    include_once("users.php");
    $obj=new users();
        $username=$_REQUEST['username'];
		$password=$_REQUEST['password'];
		
		$row=$obj->loginUser($username,$password);
		
		$result = $obj->fetch();
		$name=$result['USERNAME'];
		$id = $result['USER_ID'];
		$newName = trim($username, '"');
		$value = strcmp($newName,$name);
		session_start();
	 	$_SESSION['USER_ID']=$id;
	 	$_SESSION['USERNAME']=$name;
		 if ($value==0){
		 	$result=$obj->fetch();
			echo '{"USER_ID":"'.$id.'"}';
		 } else {
		 	$data=array("result"=>"0");
		    echo json_encode($data);
			return;
		 }
	}

	function display(){
	include_once("users.php");
 	$obj=new users();

 	$row=$obj->display();

 	if(!$row){
 		$data=array("result"=>"0");
		    echo json_encode($data);
			return;
 	}
 	else{
 	$result=$obj->fetch();

 	//if ($result == false){
			//echo '{"result":0}';	
			// return;
			// }else {
			echo '{"result":1, "apools":[';

        while ($result) {
            echo json_encode($result);
            $result = $obj->fetch();

            if ($result) {
                echo ",";
            }
        }
        echo "]}";
			}
	}
?>