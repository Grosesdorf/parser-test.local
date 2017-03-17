<?php

function check($urlCheck){
	$url = $urlCheck;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	$header= curl_exec($ch);
	if(stripos($header, "200 OK")) {
		echo "Файл существует";
		// return true;
	}else{
		echo "Файл не найден";
		// return false;
	}
	curl_close($ch);
}

if(isset($_POST['url']) && !empty($_POST['url'])){
	$urlCheck = $_POST['url'] . "/robots.txt";
	if(stripos($urlCheck, "http://") === 0 || stripos($urlCheck, "https://") === 0){
		check($urlCheck);
	}else{
		echo "Проверьте введенный URL";
	}
		
		
	
}else{
	echo "Введите URL!";
}

// || stripos($urlCheck, "https")



