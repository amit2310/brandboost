<?php

/* ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL); */
ob_start();

function db_connect() {
    // Define connection as a static variable, to avoid connecting more than once
    static $connection;
    // Try and connect to the database, if a connection has not been established yet
    if (!isset($connection)) {
        if ($_SERVER["REMOTE_ADDR"] == "127.0.0.1") {
            $connection = mysqli_connect('localhost', 'root', '', 'dev_brandboostdbx');
        } else {
            //$connection = mysqli_connect('db-brandboost.crokdqsmnwuz.us-west-2.rds.amazonaws.com', 'root', 'WdN&bX%K6fYNDHd(', 'brandboostdb');
            $connection = mysqli_connect('localhost', 'root', '!w@9Un+c.u[Ygehj', 'brandboostdb');
        }
    }
    // If connection was not successful, handle the error
    if ($connection === false) {
        // Handle error - notify administrator, log to a file, show an error screen, etc.
        return mysqli_connect_error();
    }
    return $connection;
}

$db = db_connect();

function getLocationInfoByIp() {

    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = @$_SERVER['REMOTE_ADDR'];
    $result = array('country' => '', 'countryCode' => '', 'city' => '', 'region' => '', 'longitude' => '', 'latitude' => '');
    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    //103.254.97.14
    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
    if ($ip_data && $ip_data->geoplugin_countryName != null) {
        $result['country'] = $ip_data->geoplugin_countryName;
        $result['countryCode'] = $ip_data->geoplugin_countryCode;
        $result['city'] = $ip_data->geoplugin_city;
        $result['region'] = $ip_data->geoplugin_region;
        $result['longitude'] = $ip_data->geoplugin_longitude;
        $result['latitude'] = $ip_data->geoplugin_latitude;
    }
    return $result;
}

function getBrowser() {
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }

    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }

    return array(
        'userAgent' => $u_agent,
        'name' => $bname,
        'version' => $version,
        'platform' => $platform,
        'pattern' => $pattern
    );
}

function getLocationData() {
    global $platform_device;
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    $aBrowserInfo = getBrowser(); // Return userAgent, browsername, version, platform, pattern
    $aLocationInfo = getLocationInfoByIp();
    $aData = array_merge($aBrowserInfo, $aLocationInfo);
    $aData['ip_address'] = $ipaddress;
    $aData['platform_device'] = $platform_device;

    return $aData;
}

function saveTrackingData($tableName, $aData) {
    global $db;
    if (!empty($aData)) {
        $sql = "INSERT INTO {$tableName} SET ";
        foreach ($aData as $key => $val) {
            $sql .= "`{$key}` = '{$db->real_escape_string($val)}',";
        }
        $sql = trim($sql, ",");
        $result = $db->query($sql);

        if ($result)
            return true;
        else
            return false;
    }
}

function getBBInfo($bbID) {
    global $db;
    $response = array();
    $sql = "SELECT * FROM tbl_brandboost WHERE id='{$bbID}'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    }
    return $response;
}

function getMessageIDDetails($msgID) {
    global $db;
    $response = array();
    $sql = "SELECT * FROM tbl_nps_automations_tracking_logs WHERE message_id='{$msgID}' LIMIT 1";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    }
    return $response;
}

function checkIfLinkExpired($delayUnit, $delayValue, $sourceTime) {
    $currentTime = time();
    switch ($delayUnit) {
        case "minute":
            $totalSeconds = 60 * $delayValue;
            break;
        case "hour":
            $totalSeconds = 60 * 60 * $delayValue;
            break;
        case "day":
            $totalSeconds = 60 * 60 * 24 * $delayValue;
            break;
        case "week":
            $totalSeconds = 60 * 60 * 24 * 7 * $delayValue;
            break;
        case "month":
            $totalSeconds = 60 * 60 * 24 * 7 * 30 * $delayValue;
            break;
        case "year":
            $totalSeconds = 60 * 60 * 24 * 7 * 30 * 365 * $delayValue;
            break;
        default :
            $totalSeconds = 0;
    }

    $expiryTime = $sourceTime + $totalSeconds;
    if ($expiryTime < $currentTime) {
        return true;
    } else {
        return false;
    }
}

function checkIfReviewGiven($bbID, $subscriberID) {
    global $db;
    $sql = "SELECT tbl_brandboost.id FROM tbl_brandboost "
            . "INNER JOIN tbl_users ON tbl_brandboost.user_id=tbl_users.id "
            . "INNER JOIN tbl_list_subscribers ON tbl_users.id=tbl_list_subscribers.user_id "
            . "WHERE tbl_list_subscribers.id='{$subscriberID}' AND tbl_brandboost.id='{$bbID}'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        return true;
    }else{
        return false;
    }
    
}

function base64UrlEncode($val) {
    return strtr(base64_encode($val), '+/=', '-_,');
}

function base64UrlDecode($val) {
    return base64_decode(strtr($val, '-_,', '+/='));
}

?>