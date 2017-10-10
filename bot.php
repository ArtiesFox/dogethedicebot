<?php
$access_token = getenv('L_TOKE');
//----------------------------------------
//----------------------------------------
$diceword = array("dice","ทอย","roll","โรล");
$calword = array("cal","คิดเลข");
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
			
			include "lib/helper.php";
			if(startwithinarray($text, $diceword))
			{
				$respondtext = "";
				$prefixtext = "";
				$space = " ";
				$textarray = explode(" ", $text);
				$textcmd = $textarray[0];
				unset($textarray[0]);
				
				foreach($textarray as $t)
				{
					$rand = mt_rand(1,$t);
					$respondtext .= "{$rand}{$space}";
				}
				
				if(count($textarray) == 0)
				{
					$respondtext = mt_rand(1,6);
				}
				
				$messages = [
					'type' => 'text',
					'text' => $respondtext
				];
			}
			else if(startwithinarray($text, $calword))
			{
				$textarray = explode(" ", $text);
				
				if(count($textarray) > 1)
				{
					$respondtext = calculate_string($textarray[1]);
				}
				else
				{
					$respondtext = "สมการต้องไม่มีช่องว่างนะจ๊ะ อ๊ะๆๆๆ";
				}
				
				$messages = [
					'type' => 'text',
					'text' => $respondtext
				];
			}
			else
			{
				$trigger = file("knowledgebase/triggerword.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
				if(startwithinarray($text, $trigger))
				{
					$triggerword_respond = file("knowledgebase/triggerword_respond.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
					$operationcmd = "dice roll ทอย โรล";
					$triggerhelp = pickonefromarray($triggerword_respond);
					$respondtext = "{$triggerhelp}{$operationcmd}";
					
					$messages = [
						'type' => 'text',
						'text' => $respondtext
					];					
				}
				else
				{
					$curseword = file("knowledgebase/curseword.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
					if(startwithinarray($text, $curseword))
					{
						$curseword_respond = file("knowledgebase/curseword_respond.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
						$insult_suffix = file("knowledgebase/insult_suffix.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
						
						$payback = pickonefromarray($curseword);
						$respond = pickonefromarray($curseword_respond);
						$suffix = pickonefromarray($insult_suffix);
						$space = " ";
						
						$respondtext = "{$payback}{$respond}{$space}{$suffix}";
						
						$messages = [
							'type' => 'text',
							'text' => $respondtext
						];
					}
				}
			}
			
			//----------------------------------------

			if(!is_null($messages))
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
