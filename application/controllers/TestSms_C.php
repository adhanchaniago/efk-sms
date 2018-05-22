<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once ('/home/SITE_NAME/public_html/FOLDER_NAME/application/libraries/ion_auth.php');
require ("/home/u422738906/public_html/vendor/autoload.php");
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;
class TestSms_C extends CI_Controller {

    
	public function index()
	{
		$config = Configuration::getDefaultConfiguration();
$config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUyNjc4NzE0NSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjQ3OTgyLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.3ZMlXKv8EZXZ45QNzAHyq1ejWuFKF2PaEbKVkPzygxQ');
$apiClient = new ApiClient($config);
$messageClient = new MessageApi($apiClient);

// Sending a SMS Message
$sendMessageRequest1 = new SendMessageRequest([
    'phoneNumber' => '089687610639',
    'message' => 'test smsgateway yak',
    'deviceId' => 83493
]);

$sendMessages = $messageClient->sendMessages([
    $sendMessageRequest1
]);
print_r($sendMessages);
	}
}
