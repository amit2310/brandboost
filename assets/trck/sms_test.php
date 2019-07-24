<?php 

require('vendor/autoload.php');
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC3d562f95a4be856b7120b492cd25a270';
$auth_token = '4975a5e2b3d6b6a7f2a4e07d63632b28';
$client = new Client($account_sid, $auth_token);
$records = $client->usage->records->read(
    array(
        "startDate" => "2019-06-01",
        "endDate" => "2019-06-30"
    )
);
echo '<pre>';
print_r($records);

?>