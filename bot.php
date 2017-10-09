<?php
$access_token = 'f3GSjb1lwSoZ/VLLhDekpZFDORekC8TFqWMIcJ452V/Hrf8RaC6hUzCDR0wCpKzWmY8S6pnQ0VWWJiGD3KB2JoR9Dez+euL20hNu+AoPcSgs8mIRYNUK9CL01IvpcAo3DDxMf9onFPXbxrr0jD52dQdB04t89/1O/w1cDnyilFU=';
$guide = 'doge can only dice / dice3 / dice6 / dice9 fren'
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
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			if($event['message']['text'] == 'dice6' || $event['message']['text'] == 'dice')
			{
				$messages = [
					'type' => 'text',
					'text' => rand(1,6)
				];
			}
			else if($event['message']['text'] == 'dice4')
			{
				$messages = [
					'type' => 'text',
					'text' => rand(1,4)
				];
			}
			else if($event['message']['text'] == 'dice9')
			{
				$messages = [
					'type' => 'text',
					'text' => rand(1,9)
				];
			}
			else
			{			
				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => $guide
				];
			}

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
echo "OK";
