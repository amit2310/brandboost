<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
//require_once '/var/www/html/assets/trck/vendor/autoload.php'; // Loads the library
require_once './vendor/autoload.php';
require_once './sockets/autoload.php';
use Twilio\Rest\Client;
//include '/var/www/html/assets/trck/functions.php';
include './functions.php';
$client = new \ElephantIO\Client(new \ElephantIO\Engine\SocketIO\Version2X('http://vue.brandboostx.com:3000'));
$client->initialize();
$client->emit('sms-incoming', ['msg' => 'hello how are you??']);
//$client->close();
echo "All Set";

?>
