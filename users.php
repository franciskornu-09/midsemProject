<?php

include_once("wrapper.php");

class users extends wrapper{
	function users(){}
    
    function loginUser($username,$password){
    	$strQuery="select USERNAME,PASSWORD,USER_ID from users where USERNAME='$username' and PASSWORD='$password'";
    	return $this->query($strQuery);
    }

    function profile($id){
        $strQuery="select * from users where USER_ID=$id";
        return $this->query($strQuery);
    }

    function checkUser($username){
        $strQuery="select USERNAME from users where USERNAME='$username'";
        return $this->query($strQuery);
    }

    function display(){
    	$strQuery="select users.USERNAME,pool.NUMBER_ALLOWED,pool.POOL_ID,START,DESTINATION from users,pool where users.USER_ID=pool.OWNER";
    	return $this->query($strQuery);
    }
    
    function newUser($firstname,$lastname,$username,$phone,$password,$email){
        $strQuery="insert into users set FIRSTNAME='$firstname',LASTNAME='$lastname',USERNAME='$username',PHONE_NUMBER=$phone,PASSWORD='$password',EMAIL='$email'";
        return $this->query($strQuery);
    }
    function displayOne($id){
        $strQuery="select pool.POOL_ID,pool.NUMBER_ALLOWED,pool.DATE,pool.NUMBER_JOINED,pool.START,pool.DESTINATION,pool.TIME,pool.AMOUNT,pool.OWNER,users.USERNAME from pool left join users on users.USER_ID = pool.OWNER where POOL_ID=$id";
        return $this->query($strQuery);
    }

    function getNumber($id){
        $strQuery="select NUMBER_JOINED,NUMBER_ALLOWED,OWNER from pool where POOL_ID=$id";
        return $this->query($strQuery);
    }
    
    function finalCheck($poolId){
        $strQuery="select USER_ID from poollink where POOL_ID=$poolId";
        return $this->query($strQuery);
    }

    function newsFeed(){
        $strQuery="select NEWS_ID,IMAGE_NAME from news";
        return $this->query($strQuery);
    }

    function getPhone($number){
        $strQuery="select PHONE_NUMBER from users where USER_ID=$number";
        return $this->query($strQuery);
    }
    function joinPool($poolId){
    	$strQuery="update pool set NUMBER_JOINED = NUMBER_JOINED+1 where POOL_ID = $poolId";
    	return $this->query($strQuery);
    }

    function userPoolId($poolId,$userId,$owner){
    	$strQuery="insert into poollink set POOL_ID=$poolId, USER_ID = $userId, OWNER=$owner";
    	return $this->query($strQuery);
    }

    function createPool($numberAllow,$date,$location,$destination,$userId,$time,$amount){
    	$strQuery="insert into pool set NUMBER_ALLOWED=$numberAllow,DATE='$date',START='$location',DESTINATION='$destination',OWNER=$userId,TIME='$time',AMOUNT=$amount";
    	return $this->query($strQuery);
    }

    function checkPools($poolId){
        $strQuery="select users.USERNAME,users.PHONE_NUMBER,poollink.POOL_ID, poollink.USER_ID from users,poollink where users.USER_ID=poollink.USER_ID and poollink.POOL_ID=$poolId";
        return $this->query($strQuery);
    }

    function poolId($userId){
        $strQuery="select POOL_ID from pool where OWNER=$userId";
        return $this->query($strQuery);
    }
}

?>