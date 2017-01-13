<?php
include	'funct.php';
$dsn	=	require	dirname(__FILE__)	.	DIRECTORY_SEPARATOR. '..'.	DIRECTORY_SEPARATOR. 'smarthome'.	DIRECTORY_SEPARATOR. 'protected'.	DIRECTORY_SEPARATOR. 'config'.	DIRECTORY_SEPARATOR. 'database.php';

$con=new \PDO($dsn['connectionString'], $dsn['username'], $dsn['password']);

/**
 * get current IP
 * 
 * start scanning from 1 to 254 for the current subnetwork
 * 
 */
$host = gethostname();
$ip = gethostbyname($host);

$ipSegments = explode('.',	$ip);
$ipSegments[3]='1';

// load all devices from database
$allDevicesQry = 'SELECT * FROM sensor, actuator';
$allDevices = runQuery($con,	$allDevicesQry,	null,true);

$allIds = array();
foreach	($allDevices as $oneDev){
				$allIds[] = $oneDev['serial'];
}


//{id:thisId,
//dev_type="H" , 
//type_name="Sensor, temperature, humidity; Actuator, switch",
//status="OK",
//value_fields="pin1" 
//};

for($i=1;$i<255;$i++){
				$url = 'http://'.$ipSegments[0].'.'.$ipSegments[1].'.'.$ipSegments[2].'.'.$i.'/register/WEB';
				$r = getSimpleRequest($url);
				if(isset($r['status']) && ($r['status']=="OK") && isset($r['id']) && (strlen($r['id'])>6) && !in_array($r['id'],$allIds)){
//								save data
								/**
								 * 3 types : A - actuator, S - sensor, H - hybrid
								 */
								if($r['dev_type']=='S'){
												runQuery($con,	$query,	$args);
												runQuery($con,	$query,	$args);
								}
								if($r['dev_type']=='A'){
												runQuery($con,	$query,	$args);
												runQuery($con,	$query,	$args);
												
								}
								if($r['dev_type']=='H'){
												runQuery($con,	$query,	$args);
												runQuery($con,	$query,	$args);
												
								}
				}
}