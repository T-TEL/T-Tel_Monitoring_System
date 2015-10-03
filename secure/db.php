<?php
/*$server ="localhost";
$username ="mtcafric_dbadmin";
$password ="mtc@fric@";
date_default_timezone_set('UTC');
$dbhandle= mysql_connect($server,$username,$password) or die(mysql_error());
$selected = mysql_select_db("mtcafric_mtc_africa",$dbhandle) or die (mysql_error());*/

error_reporting(E_ALL ^ E_NOTICE);
global $euroRate;
$euroRate = 1;
$server ="localhost";
$username ="root";
$password ="";
date_default_timezone_set('UTC');
$dbhandle= mysql_connect($server,$username,$password) or die(mysql_error());
$selected = mysql_select_db("mtc_africa",$dbhandle) or die (mysql_error());

function saveActionLog($user,$action){
	mysql_query("INSERT INTO `actionLog` (`ColNum`, `UserName`, `Action`, `DateOfAction`) VALUES (NULL, '".$_GET['system_user']."', '".$action."', CURRENT_TIMESTAMP)") or die(mysql_error());
	
	 
	
}
$dataRate = mysql_query("SELECT Euro_Rate FROM `rate` where LastUpdated = (Select Max(LastUpdated) from `rate`)") or die(mysql_error());
while($dataRow = mysql_fetch_array($dataRate)){
	$euroRate = $dataRow['Euro_Rate'];
}
//echo $euroRate;
?>