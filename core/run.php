<?php

if(isset($_POST['url']) && !empty($_POST['url'])){
	$url = $_POST['url'];
	echo $url;
}else{
	echo "No data!";
}



// $url = "toster.ru" . "/robots.txt";
// // инициализация сеанса curl
// $ch = curl_init($url);
// // будет возвращаться http-заголовок
// curl_setopt($ch, CURLOPT_HEADER, 1);
// // вся получаемая Вами страница будет сохраняться в переменной
// curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
// // таймаут соединения
// curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
// // таймаут ожидания
// curl_setopt($ch, CURLOPT_TIMEOUT, 5);
// // загрузка страницы 
// $header= curl_exec($ch);
// // проверяем ли ответ от сервера с кодом 200 ОК
// if(strpos($header, "200 OK")) {
// echo "Файл существует";
// echo "<pre>";
// echo $header;
// echo "</pre>";
// } else {
// echo "Файл не найден";
// die();
// }
// curl_close($ch); 