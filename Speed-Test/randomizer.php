<?php
require ("Ping.php");
//echo "working";

	//get client IP
	$ip = (getenv(HTTP_X_FORWARDED_FOR))
    ?  getenv(HTTP_X_FORWARDED_FOR)
	:  getenv(REMOTE_ADDR);
	
	
$path = "temp";
$type = $_POST['req'];
$where = $_POST['where'];
//chmod($path, 0777);

if ($type == "makenewfile") {
	
			//-------------------make sure there are no files in there .....-------\\
			
			//using the opendir function
		$dir_handle = @opendir($path) or die("Unable to open $path");
		//running the while loop
		while ($file = readdir($dir_handle)) 
		{
		  // if its not a directory then delete it
		  if (!is_dir($file)) {
		  	
		  
		  unlink($path.'/'.$file);
		  }
		}
		//closing the directory
		closedir($dir_handle);
	//----------------------------- end of delete files function-------------------\\
	
	
	$file = 'random2000x2000.jpg';
	$random_digit=rand(0000,9999);
	$d = date("d");
	
	//echo $random_digit.$d;
	
	$newfile = $random_digit.$d.'.jpg';
	
	if (!copy($file, $path.'/'.$newfile)) {
	    echo "&Status=error";
	}else {
		echo"&Status=$newfile";
	}
}elseif ($type == "del") {
	
	
	$file2del = $_POST['rName'];
	if(!unlink($path.'/'.$file2del)) {
		
		echo "&Status=failed";
		
	}else{
		
		echo "&Status=success";
	}
	
	
}elseif ($type == "ping") {
	
	
// create object
$ping = Net_Ping::factory();

// ping host and display response
if(!PEAR::isError($ping))
	{
		//if ($where == "local") {
			
		//	$response = $ping->ping("google.com");
			
		//}else{
			
			 $response = $ping->ping($ip);
		//}
	  
	   echo "&data=".$response->getAvg().'&address='.$ip; 
   
    	
  
   
	}	
	
	
}elseif ($type == "upload") {
	
	//for ($i=1; $i<=8; $i++)
		//{
		 // $data .= $_POST['test'.$i];
		 
		//}
		
		$request = isset($_REQUEST)?$_REQUEST:$HTTP_POST_VARS;	
		foreach ($request as $key => $value) {
   			
			$size += (strlen($key) + strlen($value) + 3);
	}

	if(!empty($request)) {
		
		printf("&Status=success&size=%d",$size);
		
	}

	
}


?>
