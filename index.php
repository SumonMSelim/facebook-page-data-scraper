<?php
require_once __DIR__ . '/vendor/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '182728082068351',
  'app_secret' => 'b871a8b833ed66b2d60a23dce8a17909',
  'default_graph_version' => 'v2.5',
  ]);

$accessToken = '182728082068351|b871a8b833ed66b2d60a23dce8a17909';
$fb->setDefaultAccessToken($accessToken);

// Send the request to Graph
try {
  $response = $fb->get('/1442164872708299/posts?fields=message, full_picture, created_time');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

foreach($response->getDecodedBody()['data'] as $item) {
    foreach ($item as $key => $value) {
        if($key == 'full_picture') { echo '<img src="'.$value.'" width="300px" height="300px"/>'; }
        elseif($key == 'created_time') { echo date('F jS, Y h:i:s', strtotime($value));} else {
        echo $key .": ". $value;}
        echo "<br/>";
    }
    echo "<br/>--------------<br/>";
 }   

    