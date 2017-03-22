<?php
require_once 'config.php';

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

function checkRobots($urlCheck, $pathCheckFile, $arrConfig, $file){
	$params = [];

	$url = $urlCheck;
	$path = $pathCheckFile;

	$fp = fopen($path, 'w');

	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);

	curl_exec($ch);

	$params['http_code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if($params['http_code'] == '200') {
		$countHost = 0;
		$countSitemap = 0;
		$arrTmp = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$sizeRobots = round(intval(curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD))/1024, 2);
		$params[] = [
			'check' => $arrConfig['checkHttpCodeRobots'],
			'status' => true,
			'state' => str_replace("|HTTPCODE|", $params['http_code'], $arrConfig['stHttpCodeRobotsFalse']),
			'rec' => $arrConfig['recHttpCodeRobotsFalse']
		];
		$params[] = [
			'check' => $arrConfig['checkRobots'],
			'status' => true,
			'state' => $arrConfig['stRobotsTrue'],
			'rec' => $arrConfig['recRobotsTrue']
		];

		if($sizeRobots <= 32){
			$params[] = [
			'check' => $arrConfig['checkSizeRobots'],
			'status' => true,
			'state' => str_replace("|SIZE|", $sizeRobots, $arrConfig['stSizeRobotsTrue']),
			'rec' => $arrConfig['recSizeRobotsTrue']
			];
		}
		else{
			$params[] = [
			'check' => $arrConfig['checkSizeRobots'],
			'status' => false,
			'state' => str_replace("|SIZE|", $sizeRobots, $arrConfig['stSizeRobotsFalse']),
			'rec' => $arrConfig['recSizeRobotsFalse']
			];
		}

   		// Scan Robots.txt (Host, Sitemap)
		foreach ($arrTmp as $value) {
			if(strpos($value, 'Host:') === 0){
				$countHost += 1;
			}
			elseif(strpos($value, 'Sitemap:') === 0){
				$countSitemap += 1;	
			}
		}
		// Check of Host
		if($countHost === 1){
			$params[] = [
			'check' => $arrConfig['checkHost'],
			'status' => true,
			'state' => $arrConfig['stHostTrue'],
			'rec' => $arrConfig['recHostTrue']
			];
			$params[] = [
			'check' => $arrConfig['checkCountHost'],
			'status' => true,
			'state' => $arrConfig['stCountHostTrue'],
			'rec' => $arrConfig['recCountHostTrue']
			];
		}	
		elseif($countHost === 0){
			$params[] = [
			'check' => $arrConfig['checkHost'],
			'status' => false,
			'state' => $arrConfig['stHostFalse'],
			'rec' => $arrConfig['recHostFalse']
			];
		}
		elseif($countHost > 1) {
			$params[] = [
			'check' => $arrConfig['checkCountHost'],
			'status' => false,
			'state' => str_replace("|COUNTHOST|", $countHost, $arrConfig['stCountHostFalse']),
			'rec' => $arrConfig['recCountHostFalse']
			];
		}
		// Check of Sitemap
		if($countSitemap === 1){
			$params[] = [
			'check' => $arrConfig['checkSitemap'],
			'status' => true,
			'state' => $arrConfig['stSitemapTrue'],
			'rec' => $arrConfig['recSitemapTrue']
			];
		}	
		elseif($countSitemap === 0){
			$params[] = [
			'check' => $arrConfig['checkSitemap'],
			'status' => false,
			'state' => $arrConfig['stSitemapFalse'],
			'rec' => $arrConfig['recSitemapFalse']
			];
		}
		elseif($countSitemap > 1){
			$params[] = [
			'check' => $arrConfig['checkSitemap'],
			'status' => false,
			'state' => 'Check Sitemap',
			'rec' => 'Check Sitemap'
			];
		}
	}
	else{
		$params[] = [
			'check' => $arrConfig['checkHttpCodeRobots'],
			'status' => false,
			'state' => str_replace("|HTTPCODE|", $params['http_code'], $arrConfig['stHttpCodeRobotsFalse']),
			'rec' => $arrConfig['recHttpCodeRobotsFalse']
		];
		$params[] = [
			'check' => $arrConfig['checkRobots'],
			'status' => false,
			'state' => $arrConfig['stRobotsFalse'],
			'rec' => $arrConfig['recRobotsFalse']
		];
	}
	curl_close($ch);
	fclose($fp);

	return $params;
}

if(filter_has_var(INPUT_POST, 'protocol') && filter_has_var(INPUT_POST, 'domen')){
	$urlCheck = $_POST['protocol'].'://'.$_POST['domen'];
	$urlCheck = filter_var($urlCheck, FILTER_SANITIZE_URL);
	if(checkUrl($urlCheck)){
		$urlCheck .= "/robots.txt";
		// echo json_encode(array_merge(checkRobots($urlCheck, $path, $arrConfig), parseFile($path)), JSON_UNESCAPED_UNICODE);
		echo json_encode(checkRobots($urlCheck, $path, $arrConfig, $path), JSON_UNESCAPED_UNICODE);
	}
	else{
		echo json_encode(['ERROR' => 'Введите корретный URL!'], JSON_UNESCAPED_UNICODE);
		// echo "Введите корретный URL!";
	}
}
// else{
// 	echo "Введите URL!";
// }