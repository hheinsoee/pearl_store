<?php
function smsSender($phone,$text){
	if ($phone!=""&&$text!="") 
	{
		// SMSPoh Authorization Token
		$token = "_w00I3IbTqu91amlwxkKw4K3REPQE5Z1RrcJYQNYR9CE1jt0lGg6HomwA16bxIxN";
		//header('Location: https://smspoh.com/api/http/send?key='.$token.'&message='.$text.'&recipients='.$phone);
		$data = [
		    "to"        =>      $phone,
		    "message"   =>      $text,
		    "sender"    =>      "heinsoe.com"
		];
		
		
		$ch = curl_init("https://smspoh.com/api/v2/send");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
		        'Authorization: Bearer ' . $token,
		        'Content-Type: application/json'
		    ]);
		
		$result = curl_exec($ch);		
		echo $result;
	}
}
// https://smspoh.com/api/http/send?key=ZQCm5nHWuvhwyT_uPptbUlTYHmhMIGul53bY1FNQiExYQgpwpffXUGuZqD91Z_Jy&message=Hello Naing Ko&recipients=09261210855
?>