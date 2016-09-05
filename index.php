<?php 
  $access_token = "<il tuo token d'accesso>";
  $verify_token = "<il tuo token di verifica>";
  $hub_verify_token = null;

  $content = file_get_contents('php://input');
  $input = json_decode(file_get_contents('php://input'), true);

  $sender = $input['entry'][0]['messaging'][0]['sender']['id'];
  $message = $input['entry'][0]['messaging'][0]['message']['text'];

  $message_to_reply = 'hai detto: '.$message;
  
  //API Url
  $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;


  //Initiate cURL.
  $ch = curl_init($url);

  //The JSON data.
  $jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
    },
    "message":{
        "text":"'.$message_to_reply.'"
    }
  }';

  //Encode the array into JSON.
  $jsonDataEncoded = $jsonData;

  //Tell cURL that we want to send a POST request.
  curl_setopt($ch, CURLOPT_POST, 1);

  //Attach our encoded JSON string to the POST fields.
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

  //Set the content type to application/json
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

  //Execute the request
  if(!empty($input['entry'][0]['messaging'][0]['message'])){
    $result = curl_exec($ch);
  }

?>
