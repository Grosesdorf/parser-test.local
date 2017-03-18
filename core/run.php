<?php

$path = '../tmp/temp_robots.txt';

function checkUrl($url = NULL){
    if($url==NULL){
    	return false;
    }

    $pattern = '/((http|https)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\&\.\/\?\:@\-_=#])*/';
    if(preg_match($pattern, $url)){
    	return true;
	} 
    else{
    	return false;	
    }
}

function checkRobots($urlCheck, $pathCheckFile){
	$params = [];

	$url = $urlCheck;
	$path = $pathCheckFile;

	$fp = fopen($path, 'w');

	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);

	curl_exec($ch);

	$params['HTTP_CODE'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	if($params['HTTP_CODE'] == '200') {
		$params['CONTENT_LENGTH'] = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
		// echo '<pre>';
		// var_dump(curl_getinfo($ch));
		// echo '</pre>';
	}
	curl_close($ch);
	fclose($fp);

	return $params;
}

function parseFile($file){
	$params = [];
	$count = 0;
	$arrTmp = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

	foreach ($arrTmp as $value) {
		if(strpos($value, 'Host:') === 0){
			$params['COUNT_HOST'] += 1;
		}
		elseif(strpos($value, 'Sitemap:') === 0){
			$params['COUNT_SITEMAP'] += 1;	
		}
	}

	return $params;
}

if(filter_has_var(INPUT_POST, 'protocol') && filter_has_var(INPUT_POST, 'domen')){
	$urlCheck = $_POST['protocol'].'://'.$_POST['domen'];
	$urlCheck = filter_var($urlCheck, FILTER_SANITIZE_URL);
	if(checkUrl($urlCheck)){
		$urlCheck .= "/robots.txt";
		echo json_encode(array_merge(checkRobots($urlCheck, $path), parseFile($path)));
	}
	else{
		echo "Введите корретный URL!";
	}
}
else{
	echo "Введите URL!";
}