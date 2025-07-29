<?php
require ("Ping.php");

$ping = Net_Ping::factory();

// ping host and display response
if(!PEAR::isError($ping))
	{
		
			
	$response = $ping->ping("google.com");
			
		
			
		//	 $response = $ping->ping($ip);
	
	  
	   echo "&data=".$response->getAvg().'&address='.$ip.$response->getRawData(); 
   
   
}	