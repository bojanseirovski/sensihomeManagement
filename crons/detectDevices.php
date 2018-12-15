<?php

include 'funct.php';

$dsn = array(
    'connectionString' => 'mysql:host=localhost;dbname=smarthome',
    'emulatePrepare' => true,
    'username' => 'root',
    'password' => '******',
    'charset' => 'utf8',
);
try {
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
    //  get all device types
    $allDeviTypesQry = 'SELECT type FROM  device_type;';
    $allDeviTypes = runQuery($con, $allDeviTypesQry, null, true);

// load all devices from database
    $allDevicesQryS = 'SELECT * FROM sensor;';
    $allDevicesS = runQuery($con, $allDevicesQryS, null, true);

    $allDevicesQryA = 'SELECT * FROM  actuator;';
    $allDevicesA = runQuery($con, $allDevicesQryA, null, true);
    
    $allDevices = array_merge($allDevicesS,$allDevicesA);
    
    $allIds = array();
    foreach ($allDevices as $oneDev) {
        $allIds[] = $oneDev['serial'];
    }
    var_export($allIds);
    for ($i = 1; $i < 255; $i++) {
        try {
            $currentIp = $ipSegments[0] . '.' . $ipSegments[1] . '.' . $ipSegments[2] . '.' . $i;
            $currentIpNum = $ipSegments[0] . $ipSegments[1] . $ipSegments[2] . $i;

            $url = 'http://' . $ipSegments[0] . '.' . $ipSegments[1] . '.' . $ipSegments[2] . '.' . $i . '/register/WEB/ip/' . $currentIpNum;
            $r = getSimpleRequest($url);
            $randomDevName = $ipSegments[0] . '-' . $ipSegments[1] . '-' . $ipSegments[2] . '-' . $i;
            $isThisDeviceIp = ($currentIp == $ip);
            $theId = (string)$r['id'];
            if (
                isset($r['status']) 
                && ($r['status'] == "OK") 
                && isset($r['id']) 
                && ($r['id']> 6) 
                && !in_array($theId, $allIds) 
                && !$isThisDeviceIp) {
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
                
                $thisDevType = isset($r['type_name'])?$r['type_name']:$r['value_fields'];
                if(!in_array($thisDevType, $allDeviTypes) || count($allDeviTypes)<1){
                    $queryDt = 'INSERT INTO device_type (type,  description)'.
                        ' VALUES(:type, :desc);';
                    $argsDt = [
                        ':type'=>$thisDevType,
                        ':desc'=>$thisDevType,
                    ];
                    runQuery($con, $queryDt, $argsDt);
                }
            }
        } 
        catch (Exception $e) {
            error_log($e->getMessage());
            error_log($e->getTraceAsString());
        }
    }
} 
catch (Exception $e) {
    error_log($e->getMessage());
    error_log($e->getTraceAsString());
}
