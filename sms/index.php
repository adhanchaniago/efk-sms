<?php

/*require 'vendor/autoload.php';

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;

// Configure client
$config = Configuration::getDefaultConfiguration();
$config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUyNjc4NTcwOSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjQ3OTgyLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.rjhSdhzDbShNlYnkX7FWwzq_iZ5hH_kCEKCcq62B2Hc');
$apiClient = new ApiClient($config);
$messageClient = new MessageApi($apiClient);

// Sending a SMS Message
$sendMessageRequest1 = new SendMessageRequest([
    'phoneNumber' => '089687610639',
    'message' => 'tes sms gateway',
    'deviceId' => 83493
]);
$sendMessageRequest2 = new SendMessageRequest([
    'phoneNumber' => '089687610639',
    'message' => 'test2',
    'deviceId' => 83493
]);
$sendMessages = $messageClient->sendMessages([
    $sendMessageRequest1,
    $sendMessageRequest2
]);
print_r($sendMessages);*/


    if (class_exists('Memcache')) {
        $memcache = new Memcache;
        $connect = @$memcache->connect("mysql.hostinger.co.id");
         
        if ($connect) {
            echo "Memcached Version : ".$memcache->getVersion()."<br/>";
            $dataMemcached = $memcache->get('percobaan');
            if($dataMemcached) print_r($dataMemcached);
            else {
                $dataArray = array(
                'Hallo Jagocoding' => 'isi data'
                );
                $memcache->set('percobaan', $dataArray, false, 10);
                print_r($dataMemcached);
            }
        }
    } else {
        echo "Memcached tidak tersedia";
    }
?>