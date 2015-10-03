<?php
$server ="localhost";
$username ="root";
///$password ="raspberry";
$password ="";
date_default_timezone_set('UTC');
$dbhandle= mysql_connect($server,$username,$password) or die(mysql_error());
$selected = mysql_select_db("T_TEL",$dbhandle) or die (mysql_error());


$getSQLdata =  mysql_query("SELECT * FROM `institution_info`") or die(mysql_error());
global $inst_id;
global $inst_name;
$inst_id = array();
$inst_name = array();
while($rowData = mysql_fetch_array($getSQLdata)){
	array_push($inst_id,$rowData['INST_ID']);
	array_push($inst_name,$rowData['INST_NAME']);
}
   

global $couchUrl;
$couchUrl = 'http://pi:raspberry@166.62.84.233:5984';

////error_reporting(E_ERROR);

include "../lib/couch.php";
include "../lib/couchClient.php";
include "../lib/couchDocument.php";

?>