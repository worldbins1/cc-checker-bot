<?php
    date_default_timezone_set("Asia/kolkata");
    //Data From Webhook
    $content = file_get_contents("php://input");
    $update = json_decode($content, true);
    $chat_id = $update["message"]["chat"]["id"];
    $message = $update["message"]["text"];
    $message_id = $update["message"]["message_id"];
    $id = $update["message"]["from"]["id"];
    $username = $update["message"]["from"]["username"];
    $firstname = $update["message"]["from"]["first_name"];
    $start_msg = $_ENV['START_MSG']; 
    
    $gate1 = "xxxxxxxx/api.php"; /// Your Checker URl with api.php or chk.php
  //$gate2 = "";
if($message == "/start"){
    send_message($chat_id,$message_id, "Hey $firstname \nUse /cmds to View Commands \n$start_msg");
}

if($message == "/cmds"){
    send_message($chat_id,$message_id, "
    !ch xxxxxxxxxxxxxxxx|xx|xxxx|xxx Made by | @LordCireee  
    ");
}

//Gate 1
if(strpos($message, "!ch") === 0){
    $cc = substr($message, 4);
    $curl = curl_init();
    curl_setopt_array($curl, [
    CURLOPT_URL => "$gate1?lista=$cc",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
    "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
    "accept-language: en-GB,en-US;q=0.9,en;q=0.8,hi;q=0.7",
    "sec-fetch-dest: document",
    "sec-fetch-site: none",
    "user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1"
   ],
   ]);

 $result = curl_exec($curl);
 curl_close($curl);
   send_message($chat_id,$message_id, "$result \nChecked By @$username ");

}

/*
//Gate 2
if(strpos($message, "!ch") === 0){
    $cc = substr($message, 4);
    $curl = curl_init();
    curl_setopt_array($curl, [
    CURLOPT_URL => "$gate2?lista=$cc",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
    "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng;q=0.8,application/signed-exchange;v=b3;q=0.9",
    "accept-language: en-GB,en-US;q=0.9,en;q=0.8,hi;q=0.7",
    "sec-fetch-dest: document",
    "sec-fetch-site: none",
    "user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1"
   ],
   ]);

 $result = curl_exec($curl);
 curl_close($curl);
   send_message($chat_id,$message_id, "$result \nChecked By @$username ");

}
*/
    function send_message($chat_id,$message_id, $message){
        $text = urlencode($message);
        $apiToken = "2081705501:AAGQ4kpZysQ4wb1-BKoLMeXRwqS38I8n4IA"; ///Bot api token  
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chat_id&reply_to_message_id=$message_id&text=$text&parse_mode=html");
    }
?>
