<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

require_once 'vendor/autoload.php'; // Loads the library

use Twilio\Rest\Client;

include 'functions.php';
$sid = "ACf98e572bd4b7e10cc1fc3637a2327f62";
$token = "572a09ee4ba0b098443d920693b865e9";
$client = new Client($sid, $token);

$from = '+14695027654';
$to = '+919717658547';

//$msg = 'To all my friends, be careful of some msgs in WhatsApp that asks you to put your thumb in a screen to unlock a msg like happy Independence day or happy new year... Beware of these msgs and don\'t put your thumb anywhere. Scanning your thumb impression will give the app owners access to your biometric data, this is very serious as your Aadhar biometric is linked to PAN, banks etc.. be very careful and spread the message !! cyber crime on the rise now.To all my friends, be careful of some msgs in WhatsApp that asks you to put your thumb in a screen to unlock a msg like happy Independence day or happy new year... Beware of these msgs and don\'t put your thumb anywhere. Scanning your thumb impression will give the app owners access to your biometric data, this is very serious as your Aadhar biometric is linked to PAN, banks etc.. be very careful and spread the message !! cyber crime on the rise now. To all my friends, be careful of some msgs in WhatsApp that asks you to put your thumb in a screen to unlock a msg like happy Independence day or happy new year... Beware of these msgs and don\'t put your thumb anywhere. Scanning your thumb impression will give the app owners access to your biometric data, this is very serious as your Aadhar biometric is linked to PAN, banks etc.. be very careful and spread the message !! cyber crime on the rise now. TRAI To all my friends, be careful of some msgs in WhatsApp that asks you to put your thumb in a screen to unlock a msg like happy Independence day or happy new year... Beware of these msgs and don\'t put your thumb anywhere. Scanning your thumb impression will give the app owners access to your biometric data, this is very serious as your Aadhar biometric is linked to PAN, banks etc.. be very careful and spread the message !! cyber crime on the rise now.To all my friends, be careful of some msgs in WhatsApp that asks you to put your thumb in a screen to unlock a msg like happy Independence day or happy new year... Beware of these msgs and don\'t put your thumb anywhere. Scanning your thumb impression will give the app owners access to your biometric data, this is very serious as your Aadhar biometric is linked to PAN, banks etc.. be very careful and spread the message !! cyber crime on the rise now. To all my friends, be careful of some msgs in WhatsApp that asks you to put your thumb in a screen to unlock a msg like happy Independence day or happy new year... Beware of these msgs and don\'t put your thumb anywhere. Scanning your thumb impression will give the app owners access to your biometric data, this is very serious as your Aadhar biometric is linked to PAN, banks etc.. be very careful and spread the message !! cyber crime on the rise now. TRAI- Thank you';
////$msg ="Hello";
//$client->messages->create(
//            $to, array(
//        'from' => $from,
//        'body' => substr($msg, 0, 1599),
//            )
//    );
//die;

if (empty($_REQUEST['Body'])) {
    echo "I am inside";
    $defaultMessage = 'How likely are you to recommend Brandboost to a friend? Please reply with a number from "0" (not likely) to "10" (very likely)';
    $client->messages->create(
            $to, array(
        'from' => $from,
        'body' => $defaultMessage,
            )
    );
} else {
    $defaultMessage = 'Please type your feedback and let us know why do you want to rate this?';
    $content = json_encode($_REQUEST);
    $body = $_REQUEST['Body'];
    $to = $_REQUEST['From'];
    $from = $_REQUEST['To'];
    $result = preg_replace("/[^A-Za-z0-9]/u", " ", $body);
    $result = trim($result);
    $result = strtolower($result);
    $client->messages->create(
            $to, array(
        'from' => $from,
        'body' => $defaultMessage,
            ));
    saveTrackingData('test', array('content'=> $content));
}
die("Messge Send succcessfully");




/*
 * * Read the contents of the incoming message fields.
 */
$body = $_REQUEST['Body'];
$to = $_REQUEST['From'];
$from = $_REQUEST['To'];

/*
 * * Remove formatting from $body until it is just lowercase   
 * * characters without punctuation or spaces.
 */
$result = preg_replace("/[^A-Za-z0-9]/u", " ", $body);
$result = trim($result);
$result = strtolower($result);
$sendDefault = true; // Default message is sent unless key word is found in following loop.

/*
 * * Choose the correct message response and set default to false.
 */
foreach ($responseMessages as $animal => $messages) {
    if ($animal == $result) {
        $body = $messages['body'];
        $media = $messages['media'];
        $sendDefault = false;
    }
}

// Send the correct response message.
if ($sendDefault != false) {
    $client->messages->create(
            $to, array(
        'from' => $from,
        'body' => $defaultMessage,
            )
    );
} else {
    $client->messages->create(
            $to, array(
        'from' => $from,
        'body' => $body,
        'mediaUrl' => $media,
            )
    );
}
?>