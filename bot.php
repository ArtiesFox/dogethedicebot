<?php
$access_token = 'VU3Z4IF7ztZwLscjXzSKUBvwqdLbs7r2nxvaWn8jXU96EBH7oDZe8cEZ6bKzndWrmY8S6pnQ0VWWJiGD3KB2JoR9Dez+euL20hNu+AoPcSg7S+XGH7goLWgXCMAvwC/L0KumWUU4Im+HdSHGyCSSPgdB04t89/1O/w1cDnyilFU=';
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
			
					
				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => $text
				];

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
