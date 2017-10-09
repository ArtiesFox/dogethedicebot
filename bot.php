<?php
$access_token = getenv('L_TOKE');
//----------------------------------------
include "lib/helper.php";
//----------------------------------------
$diceword = array("dice","ทอย","roll","โรล");
//----------------------------------------
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = strtolower($event['message']['text']);
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			//----------------------------------------
			
			if(startwithinarray($text, $diceword))
			{
				$respondtext = "";
				$prefixtext = "";
				$space = " ";
				$textarray = explode($text);
				
				foreach($textarray as $t)
				{
					$rand = mt_rand(1,$t);
					$respondtext .= "{$rand}{$space}";
				}
				
				$messages = [
					'type' => 'text',
					'text' => $respondtext
				];
			}
			else
			{
				
			}
			
			//----------------------------------------

			if(!is_null($message))
			{
				// Make a POST Request to Messaging API to reply to sender
				$url = 'https://api.line.me/v2/bot/message/reply';
				$data = [
					'replyToken' => $replyToken,
					'messages' => [$messages],
				];
				$post = json_encode($data);
				$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				curl_close($ch);

				echo $result . "\r\n";
			}
		}
	}
}
echo "OK";
