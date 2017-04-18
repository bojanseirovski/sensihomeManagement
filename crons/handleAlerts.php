<?php

include 'funct.php';
require 'class.simple_mail.php';

$dsn = [
    'connectionString' => 'mysql:host=localhost;dbname=smarthome',
    'emulatePrepare' => true,
    'username' => 'root',
    'password' => 'rim%@!641',
    'charset' => 'utf8',
];
$mailCreds = [
    'host'=>'',
    'user'=>'',
    'password'=>'',
    'secure'=>'',
    'port'=>'',
    'smtpauth'=>true,
];
$con = new \PDO($dsn['connectionString'], $dsn['username'], $dsn['password']);

/**
 * Use PDO to read the DB and curl to talk to
 * the devices
 * alert table
 * 
 */
$sData = runQuery($con, 'SELECT * FROM alert;', null, true);

$countActivatedDevs = 0;
$notifyBody = [];
foreach ($sData as $oneModule) {
    $notifyAdmin = isset($oneModule['notify']);
    $oneSensorData = runQuery($con, 'SELECT id, serial,com_id FROM sensor WHERE id=:tby;', [':tby' => $oneModule['triggered_by']], true);
    if (!isset($oneSensorData[0])) {
	continue;
    }
    $requestEndPoint = 'http://' . $oneSensorData[0]['com_id'] . '/id/' . $oneSensorData[0]['serial'] . '/reqtype/json';

    $measure = getSimpleRequest($requestEndPoint);

    if (isset($measure) && isset($measure['status']) && ($measure['status'] == 'OK')) {
	if (isset($oneModule['value']) && ($oneModule['trigger_value'] >= $measure['value'])) {
	    try {
		// load actuator values
		$requestEndPoint = 'http://' . $oneModule['actuator_id'] . '/id/' . $oneModule['serial'] . '/reqtype/json/pin/ON';
		$fireAlert = getSimpleRequest($requestEndPoint);

		if ($fireAlert['status'] != 'OK') {
		    error_log('Actuator ID ' . $oneModule['actuator_id'] . " wasn't set.");
		}
		else{
		    if($notifyAdmin){
			$countActivatedDevs++;
			$notifyBody[] = $oneModule['action'].', actuator ' . $oneModule['actuator_id'] . " was set on ".date('d M Y h:i:s')." triggered by sensor ".$oneModule['triggered_by'];
		    }
		}
		/**
		 * Log alert execution here
		 */
		//insert alert
		$alertLogQry = "INSERT INTO alert_log(sid, aid, alid, alname, svalue, astate)"
			. " VALUES(:sid, :aid, :alid, :alname, :svalue, :astate);";
		$alertLogData = [
		    ":sid"=>$oneModule['triggered_by'],
		    ":aid"=>$oneModule['actuator_id'],
		    ":alid"=>$oneModule['id'],
		    ":alname"=>$oneModule['action'],
		    ":svalue"=>$oneModule['trigger_value'],
		    ":astate"=>$oneModule['actuator_state'],
		];
		runQuery($con, $alertLogQry, $alertLogData);
	    }
	    catch (Exception $e) {
		error_log($e->getMessage());
	    }
	}
    }
}

/**
 * send email per alert
 */
