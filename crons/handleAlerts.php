<?php

include 'funct.php';

$dsn = [
    'connectionString' => 'mysql:host=localhost;dbname=smarthome',
    'emulatePrepare' => true,
    'username' => 'root',
    'password' => 'rim%@!641',
    'charset' => 'utf8',
];
$mailCreds = [
    'host' => 'smtp.gmail.com',
    'user' => 'mail@gmail.com',
    'password' => '',
    'secure' => 'ssl',
    'port' => 465,
    'smtpauth' => true,
];
$con = new \PDO($dsn['connectionString'], $dsn['username'], $dsn['password']);

/**
 * Use PDO to read the DB and curl to talk to
 * the devices
 * alert table
 *
 */
$sData = runQuery($con, 'SELECT * FROM alert WHERE enabled=1;', null, true);

$countActivatedDevs = 0;
$notifyBody = [];
$today = strtotime(date('Y-m-d'));
foreach ($sData as $oneModule) {
    if(!isset($oneModule['is_daily']) || (strtotime($oneModule['scheduled_on'])!=$today)){
	continue;
    }
    $notifyAdmin = isset($oneModule['notify']);
    $oneSensoqQry ="SELECT * FROM sensor WHERE id=:tby LIMIT 1;";
    $oneSensoqParams = [':tby' => $oneModule['triggered_by']];
    $oneSensorData = runQuery($con, $oneSensoqQry, $oneSensoqParams, true )[0];
    //  get actuator
    $oneActQry ="SELECT * FROM actuator WHERE aid=:aid LIMIT 1;";
    $oneActParams = [':aid' => $oneModule['actuator_id']];
    $oneActData = runQuery($con, $oneActQry, $oneActParams, true )[0];

    if (!isset($oneSensorData)) {
        continue;
    }
    $requestEndPoint = 'http://' . $oneSensorData['com_id'] . '/id/' . $oneSensorData['serial'] . '/reqtype/json';

    $measure = getSimpleRequest($requestEndPoint);

    $valField = isset($measure['value_fields'])?$measure['value_fields']:null;
    $measuredValue = isset($measure[$valField])?$measure[$valField]:null;
    if (isset($measure) && isset($measure['status']) && ($measure['status'] == 'OK')) {

        if (isset($oneModule['trigger_value']) && ($measuredValue>$oneModule['trigger_value'])) {
            try {
                // load actuator values
                $requestEndPoint = 'http://' . $oneActData['com_id'] . '/id/' . $oneActData['serial'] . '/reqtype/json/pin/'.$oneModule['actuator_state'];
                $fireAlert = getSimpleRequest($requestEndPoint);
                if ($fireAlert['status'] != 'OK') {
                    error_log('Actuator ID ' . $oneModule['actuator_id'] . " wasn't set.");
                } 
                else {
                    if ($notifyAdmin) {
                        $countActivatedDevs++;
                        $theMessage = $oneModule['action'] . ', actuator ' . $oneActData['name'] . " was set on " .
                            date('d M Y h:i:s') . " triggered by sensor " . $oneSensorData['name'].
                            ", ".$valField.": ".$measuredValue." ".$oneSensorData['unit'];
                        $notifyBody[] = [
                            'sys' => $oneSensorData['system_id'],
                            'msg' => $theMessage
                        ];
                    }
                    /**
                     * Log alert execution here
                     */
                    //insert alert
                    $alertLogQry = "INSERT INTO alert_log(sid, aid, alid, alname, svalue, astate)"
                        . " VALUES(:sid, :aid, :alid, :alname, :svalue, :astate);";
                    $alertLogData = [
                        ":sid" => $oneModule['triggered_by'],
                        ":aid" => $oneModule['actuator_id'],
                        ":alid" => $oneModule['id'],
                        ":alname" => $oneModule['action'],
                        ":svalue" => $oneModule['trigger_value'],
                        ":astate" => $oneModule['actuator_state'],
                    ];
                    runQuery($con, $alertLogQry, $alertLogData);
                }
            } catch (Exception $e) {
               error_log($e->getMessage());
            }
        }
    }
}

/**
 * send email per alert
 */
$users = runQuery($con, 'SELECT user.id,user.username, user.name, user.notify, user_system.system_id FROM user JOIN user_system ON user.id=user_system.user_id;', null, true);
foreach ($users as $oneUser) {
    $userMailBody = '';
    if (isset($oneUser['notify'])) {
        $sysId = $oneUser['system_id'];
        $countUserData = 0;
        foreach ($notifyBody as $oneNotSec) {
            if ($oneNotSec['sys'] == $sysId) {
                $countUserData++;
                $userMailBody .='<div>' . $oneNotSec['msg'] . '</div>';
            }
        }
        if ($countUserData > 0) {
            $recepient = [
                'email' => $oneUser['username'],
                'name' => $oneUser['name'],
            ];
            //send mail 
            $stat = sendEmail($mailCreds, $recepient, $userMailBody, "SensiStash Notification");
        }
    }
}
