<?php

include 'funct.php';

$dsn = array(
    'connectionString' => 'mysql:host=localhost;dbname=smarthome',
    'emulatePrepare' => true,
    'username' => 'root',
    'password' => 'rim%@!641',
    'charset' => 'utf8',
);

$con = new \PDO($dsn['connectionString'], $dsn['username'], $dsn['password']);

/**
 * get current IP
 * 
 * start scanning from 1 to 254 for the current subnetwork
 * 
 */
$host = gethostname();

$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
socket_connect($sock, "8.8.8.8", 53);
socket_getsockname($sock, $name); // $name passed by reference
socket_close($sock);

$ip = $name;

$ipSegments = explode('.', $ip);
$ipSegments[3] = '1';

echo $ip . ' - ' . $host;

// load all devices from database
$systemInfoQry = 'SELECT * FROM system ORDER BY prim_key DESC LIMIT 1;';
$systemInfo = runQuery($con, $systemInfoQry, null, true)[0];
// load all devices from database
$allDevicesQry = 'SELECT * FROM sensor, actuator';
$allDevices = runQuery($con, $allDevicesQry, null, true);
$allIds = array();
foreach ($allDevices as $oneDev) {
    $allIds[] = $oneDev['serial'];
}

for ($i = 1; $i < 255; $i++) {
    try {
	$currentIp = $ipSegments[0] . '.' . $ipSegments[1] . '.' . $ipSegments[2] . '.' . $i;
	$currentIpNum = $ipSegments[0] . $ipSegments[1] . $ipSegments[2] . $i;

	$url = 'http://' . $ipSegments[0] . '.' . $ipSegments[1] . '.' . $ipSegments[2] . '.' . $i . '/register/WEB/ip/' . $currentIpNum;
	$r = getSimpleRequest($url);
	$randomDevName = $ipSegments[0] . '-' . $ipSegments[1] . '-' . $ipSegments[2] . '-' . $i;
	$isThisDeviceIp = ($currentIp == $ip);

	if (isset($r['status']) && ($r['status'] == "OK") && isset($r['id']) && (strlen($r['id']) > 6) && !in_array($r['id'], $allIds) && !$isThisDeviceIp) {
	    //	save data
	    /**
	     * 3 types : A - actuator, S - sensor, H - hybrid
	     *
	     * default to sensor
	     */
	    $args = [
		':type' => $r['type_name'],
		':unit' => '',
		':name' => $randomDevName,
		':com_id' => $currentIp,
		':sysid' => $systemInfo['prim_key'],
		':valf' => $r['value_fields'],
		':snum' => $r['id'],
	    ];

	    $query = 'INSERT INTO sensor (type, unit, name, com_id, system_id, value_fields, serial)' .
		    ' VALUES(:type, :unit, :name, :com_id, :sysid, :valf, :snum);';
	    if ($r['dev_type'] == 'S') {
		$query = 'INSERT INTO sensor (type, unit, name, com_id, system_id, value_fields, serial)' .
			' VALUES(:type, :unit, :name, :com_id, :sysid, :valf, :snum);';
		$args = [];
		runQuery($con, $query, $args);
	    }

	    if ($r['dev_type'] == 'A') {
		$query = 'INSERT INTO actuator (type, state, name, com_id, system_id, value_fields, serial)' .
			' VALUES(:type, :state, :name, :com_id, :sysid, :valf, :snum);';
		unset($args[':unit']);
		$args[':state'] = 'off';
		runQuery($con, $query, $args);
	    }

	    if ($r['dev_type'] == 'H') {
		$query = 'INSERT INTO sensor (type, unit, name, com_id, system_id, value_fields, serial)' .
			' VALUES(:type, :unit, :name, :com_id, :sysid, :valf, :snum);';

		runQuery($con, $query, $args);


		$query2 = 'INSERT INTO actuator (type,  state, name, com_id, system_id, value_fields, serial)' .
			' VALUES(:type, :state, :name, :com_id, :sysid, :valf, :snum)';
		unset($args[':unit']);
		$args[':state'] = 'off';

		runQuery($con, $query2, $args);
	    }
	}
    }
    catch (Exception $e) {
	error_log($e->getMessage());
	error_log($e->getMessage());
    }
}
