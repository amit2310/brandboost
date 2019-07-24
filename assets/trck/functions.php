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
            $connection = mysqli_connect('db-brandboost.crokdqsmnwuz.us-west-2.rds.amazonaws.com', 'root', '!w@9Un+c.u[Ygehj', 'brandboostdb');
        }
    }
    print_r($connection);
    // If connection was not successful, handle the error
    if ($connection === false) {
        // Handle error - notify administrator, log to a file, show an error screen, etc.
        return mysqli_connect_error();
    }
    return $connection;
}

$db = db_connect();

function getUserbyPhoneCustom($phone) {

    global $db;
    $response = array();
    $sql = "SELECT tbl_users.avatar, tbl_subscribers.user_id, tbl_subscribers.firstname,tbl_subscribers.lastname FROM `tbl_subscribers`,tbl_users
  WHERE tbl_users.id =tbl_subscribers.user_id and  tbl_subscribers.phone='" . $phone . "' ";

    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    }
    return $response;
}

function showUserAvtarCustom($userImg = '', $firstName = '', $lastName = '', $width = '', $height = '', $fontSize = '') {


    if (!empty($width)) {
        $params .= ' width="' . $width . '"';
    }

    if (!empty($height)) {
        $params .= ' height="' . $height . '"';
    }

    $inlineStyle = '';

    if (!empty($params)) {
        $inlineStyle = ' style="width:' . $width . 'px!important;height:' . $height . 'px!important;line-height:' . $width . 'px;font-size:' . $fontSize . 'px;"';
        $imgClass = 'img-circle';
    } else {
        $imgClass = 'img-circle img-xs';
    }
    if ($userImg == '') {
        if (empty($firstName) && empty($lastName)) {
            $profileImage = '<span class="icons fl_letters_gray s32" ' . $inlineStyle . '>NA</span>';
        } else {
            $profileImage = '<span class="icons fl_letters s32" ' . $inlineStyle . '>' . ucfirst(substr($firstName, 0, 1)) . '' . ucfirst(substr($lastName, 0, 1)) . '</span>';
        }
    } else {

        $profileImage = '<span class="icons s32"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $userImg . '" onerror="this.src=\'/assets/images/default_avt.jpeg\'" class="' . $imgClass . '" alt="" ' . $params . '></span>';
    }
    return $profileImage;
}

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
        $insertID = $db->insert_id;

        if ($result)
            return ($insertID) ? $insertID : true;
        else
            return false;
    }
}

function saveUsageTrackingData($aData) {
    global $db;
    if (!empty($aData)) {
        $sql = "INSERT INTO tbl_account_usage_tracking SET ";
        foreach ($aData as $key => $val) {
            $sql .= "`{$key}` = '{$db->real_escape_string($val)}',";
        }
        $sql = trim($sql, ",");
        //echo $sql;
        $result = $db->query($sql);
        $insertID = $db->insert_id;

        if ($result)
            return ($insertID) ? $insertID : true;
        else
            return false;
    }
}

function addSmsMedia($aData) {
    global $db;
    if (!empty($aData)) {
        $sql = "INSERT INTO tbl_sms_video_links SET ";
        foreach ($aData as $key => $val) {
            $sql .= "`{$key}` = '{$db->real_escape_string($val)}',";
        }
        $sql = trim($sql, ",");
        //echo $sql;
        $result = $db->query($sql);
        $insertID = $db->insert_id;

        if ($result)
            return ($insertID) ? $insertID : true;
        else
            return false;
    }
}

function phone_display_custom($num) {
    $num = preg_replace('/[^0-9]/', '', $num);

    $len = strlen($num);
    if ($len == 11 && substr($num, 0, 1) == '1') {
        return substr($num, 1, 10);
    }
    return $num;
}

function getSmsToken($from, $to) {
    global $db;
    $response = array();
    $sql = "SELECT token FROM `tbl_chat_sms_thread` WHERE ((`from` LIKE '%" . $from . "%' AND `to` LIKE '%" . $to . "%') OR (`to` LIKE '%" . $from . "%' AND `from` LIKE '%" . $to . "%')) limit 1 ";

    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    }
    return $response;
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
    $sql = "SELECT * FROM tbl_tracking_log_email_sms WHERE message_id='{$msgID}' LIMIT 1";
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
    } else {
        return false;
    }
}

function base64UrlEncode($val) {
    return strtr(base64_encode($val), '+/=', '-_,');
}

function base64UrlDecode($val) {
    return base64_decode(strtr($val, '-_,', '+/='));
}

function db_in($string) {
    return addslashes(html_entity_decode(trim($string), ENT_QUOTES));
}

function db_out($string) {

    return stripslashes(htmlentities(trim($string), ENT_QUOTES));
}

function getLatestActivity($to, $from) {
    global $db;
    $sql = "SELECT * FROM tbl_chat_sms_thread WHERE (`to` LIKE '%{$to}' AND `from` LIKE '%{$from}') OR (`from` LIKE '%{$to}' AND `to` LIKE '%{$from}') ORDER BY id DESC LIMIT 1";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    }
    return $response;
}

function getTwilioAccount($contactNo) {
    global $db;
    if (strpos($contactNo, '+') !== false) {
        $phone = $contactNo;
    } else {
        $phone = '+1' . $contactNo;
    }
    $sql = "SELECT * FROM tbl_twilio_accounts WHERE contact_no='{$contactNo}' OR contact_no='{$phone}' LIMIT 1";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    }

    if (empty($response)) {
        $sql = "SELECT tbl_users_team.*, tbl_users_team.parent_user_id AS user_id FROM tbl_users_team WHERE bb_number='{$contactNo}' OR bb_number='{$phone}' LIMIT 1";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $response = $result->fetch_assoc();
        }
    }
    return $response;
}

function getNPSInfo($npsID) {
    global $db;
    $sql = "SELECT * FROM tbl_nps_main WHERE `id`='{$npsID}' LIMIT 1";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    }
    return $response;
}

function updateSurveyFeedback($aData, $id) {
    global $db;
    if ($id > 0) {
        $sql = "UPDATE tbl_nps_score SET "
                . "`title` = '" . $aData['title'] . "',"
                . "`feedback`='" . $aData['feedback'] . "',"
                . "`updated_at`='" . $aData['updated_at'] . "' "
                . "WHERE `id`='$id'";
        ;
        $result = $db->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function getCreditValues() {
    global $db;
    $sql = "SELECT * FROM tbl_credit_values";
    $result = $db->query($sql);
    return $result;
}

function getCurrentUsage($clientID) {
    global $db;
    if ($clientID > 0) {
        $sql = "SELECT * FROM tbl_account_usage WHERE `user_id`='" . $clientID . "'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $response = $result->fetch_assoc();
        }
    }

    return $response;
}

function random_strings($length_of_string) {

    // String of all alphanumeric character 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    // Shufle the $str_result and returns substring 
    // of specified length 
    return substr(str_shuffle($str_result), 0, $length_of_string);
}

function updateCreditUsage($aData = array()) {
    global $db;
    if (!empty($aData['client_id'])) {
        $direction = $aData['direction'];
        $oCreditVal = getCreditValues();
        if (!empty($oCreditVal)) {
            $iEmailCredits = $iSMSOutbound = $iSMSInbound = $iMMSOutbound = $iMMSInbound = 0;
            while ($oCr = $oCreditVal->fetch_assoc()) {

                if ($oCr['feature_key'] == 'email') {
                    $iEmailCredits = $oCr['credit_value'];
                }

                if ($oCr['feature_key'] == 'outbound_sms') {
                    $iSMSOutbound = $oCr['credit_value'];
                }

                if ($oCr['feature_key'] == 'inbound_sms') {
                    $iSMSInbound = $oCr['credit_value'];
                }

                if ($oCr['feature_key'] == 'outbound_mms') {
                    $iMMSOutbound = $oCr['credit_value'];
                }

                if ($oCr['feature_key'] == 'inbound_mms') {
                    $iMMSInbound = $oCr['credit_value'];
                }
            }
        }
        $totalDeduction = 0;
        $oCurrentUsage = getCurrentUsage($aData['client_id']);
        if (!empty($oCurrentUsage)) {

            $mainCredits = $oCurrentUsage['credits'];
            $topupCredits = $oCurrentUsage['credits_topup'];

            $totalCredits = $mainCredits + $topupCredits;

            if ($totalCredits < 1) {
                return false;
            }



            if ($totalCredits > 0) {

                if ($aData['usage_type'] == 'email') {
                    if ($totalCredits < $iEmailCredits) {
                        return false;
                    }

                    if ($mainCredits > $iEmailCredits) {
                        $sFieldName = '`credits`';
                    } else {
                        $sFieldName = '`credits_topup`';
                    }
                    $totalDeduction = $iEmailCredits;
                    $sql = "UPDATE tbl_account_usage SET {$sFieldName} = {$sFieldName} - {$iEmailCredits} WHERE user_id='" . $aData['client_id'] . "'";
                } else if ($aData['usage_type'] == 'sms') {

                    $iSMSCost = ($direction == 'inbound') ? $iSMSInbound : $iSMSOutbound;
                    if ($totalCredits < $iSMSCost) {
                        return false;
                    }

                    if ($mainCredits > $iSMSCost) {
                        $sFieldName = '`credits`';
                    } else {
                        $sFieldName = '`credits_topup`';
                    }
                    $totalDeduction = $iSMSCost;
                    $sql = "UPDATE tbl_account_usage SET {$sFieldName} = {$sFieldName} - {$iSMSCost} WHERE user_id='" . $aData['client_id'] . "'";
                } else if ($aData['usage_type'] == 'mms') {
                    $iMMSCost = ($direction == 'inbound') ? $iMMSInbound : $iMMSOutbound;
                    if ($totalCredits < $iMMSCost) {
                        return false;
                    }

                    if ($mainCredits > $iMMSCost) {
                        $sFieldName = '`credits`';
                    } else {
                        $sFieldName = '`credits_topup`';
                    }
                    $totalDeduction = $iMMSCost;
                    $sql = "UPDATE tbl_account_usage SET {$sFieldName} = {$sFieldName} - {$iMMSCost} WHERE user_id='" . $aData['client_id'] . "'";
                }
                $result = $db->query($sql);
                $aTrackingData = array(
                    'user_id' => $aData['client_id'],
                    'usage_type' => $aData['usage_type'],
                    'direction' => $aData['direction'],
                    'segment' => $aData['segment'],
                    'spend_to' => $aData['spend_to'],
                    'spend_from' => $aData['spend_from'],
                    'module_name' => $aData['module_name'],
                    'module_unit_id' => $aData['module_unit_id'],
                    'content' => base64_encode($aData['content']),
                    'opening_balance' => $totalCredits,
                    'balance_deducted' => $totalDeduction,
                    'closing_balance' => ($totalCredits - $totalDeduction),
                    'created' => date("Y-m-d H:i:s")
                );
                if ($result) {
                    saveUsageTrackingData($aTrackingData);
                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;
    }
    return false;
}

?>