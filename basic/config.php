<?php
	header("Content-type: text/html; charset=utf-8");
	date_default_timezone_set('Asia/Shanghai');
	function zeroPath($path) {
		return dirname(__FILE__).'/'.$path;
	}

	function getUuid(){
	    if (function_exists('com_create_guid')){
	        return com_create_guid();
	    }else{
	        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
	        $charid = strtoupper(md5(uniqid(rand(), true)));
	        $hyphen = chr(45);// "-"
	        $uuid = substr($charid, 0, 8).$hyphen
	                .substr($charid, 8, 4).$hyphen
	                .substr($charid,12, 4).$hyphen
	                .substr($charid,16, 4).$hyphen
	                .substr($charid,20,12);
	        return $uuid;
	    }
	}

	function getIp(){ 
    	$onlineip=''; 
    	if(getenv('HTTP_CLIENT_IP')&&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')){ 
        	$onlineip=getenv('HTTP_CLIENT_IP'); 
    	} elseif(getenv('HTTP_X_FORWARDED_FOR')&&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')){ 
        	$onlineip=getenv('HTTP_X_FORWARDED_FOR'); 
    	} elseif(getenv('REMOTE_ADDR')&&strcasecmp(getenv('REMOTE_ADDR'),'unknown')){ 
        	$onlineip=getenv('REMOTE_ADDR'); 
    	} elseif(isset($_SERVER['REMOTE_ADDR'])&&$_SERVER['REMOTE_ADDR']&&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')){ 
        	$onlineip=$_SERVER['REMOTE_ADDR']; 
    	} 
    	return $onlineip; 
	} 		
?>
