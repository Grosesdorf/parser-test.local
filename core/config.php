<?php

$arrConfig = [
	// Robots Section
	'checkRobots' => 'Проверка наличия файла robots.txt',
	'stRobotsTrue' => 'Файл robots.txt присутствует',
	'recRobotsTrue' => 'Доработки не требуются',
	'stRobotsFalse' => 'Файл robots.txt отсутствует',
	'recRobotsFalse' => 'Программист: Создать файл robots.txt и разместить его на сайте.',
	
	'checkSizeRobots' => 'Проверка размера файла robots.txt',
	'stSizeRobotsTrue' => 'Размер файла robots.txt составляет |SIZE|Кб, что находится в пределах допустимой нормы в 32Кб',
	'recSizeRobotsTrue' => 'Доработки не требуются',
	'stSizeRobotsFalse' => 'Размера файла robots.txt составляет |SIZE|Кб, что превышает допустимую норму в 32Кб',
	'recSizeRobotsFalse' => 'Программист: Максимально допустимый размер файла robots.txt составляем 32Кб. 
							 Необходимо отредактировть файл robots.txt таким образом, чтобы его размер не превышал 32Кб',

	'checkHttpCodeRobots' => 'Проверка кода ответа сервера для файла robots.txt',
	'stHttpCodeRobotsTrue' => 'Файл robots.txt отдаёт код ответа сервера 200',
	'recHttpCodeRobotsTrue' => 'Доработки не требуются',
	'stHttpCodeRobotsFalse' => 'При обращении к файлу robots.txt сервер возвращает код ответа |HTTPCODE|',
	'recHttpCodeRobotsFalse' => 'Программист: Файл robots.txt должны отдавать код ответа 200, иначе файл не будет обрабатываться. Необходимо настроить сайт таким образом, чтобы при обращении к файлу robots.txt сервер возвращает код ответа 200',
	// Host Section
	'checkHost' => 'Проверка указания директивы Host',
	'stHostTrue' => 'Директива Host указана',
	'recHostTrue' => 'Доработки не требуются',
	'stHostFalse' => 'В файле robots.txt не указана директива Host',
	'recHostFalse' => 'Программист: Для того, чтобы поисковые системы знали, какая версия сайта является основных зеркалом, 
					   необходимо прописать адрес основного зеркала в директиве Host. В данный момент это не прописано. 
					   Необходимо добавить в файл robots.txt директиву Host. Директива Host задётся в файле 1 раз, после всех правил.',

	'checkCountHost' => 'Проверка количества директив Host, прописанных в файле',
	'stCountHostTrue' => 'В файле прописана 1 директива Host',
	'recCountHostTrue' => 'Доработки не требуются',
	'stCountHostFalse' => 'В файле прописано |COUNTHOST| директив Host',
	'recCountHostFalse' => 'Программист: Директива Host должна быть указана в файле толоко 1 раз. 
						   Необходимо удалить все дополнительные директивы Host и оставить только 1, 
						   корректную и соответствующую основному зеркалу сайта',
	// Sitemap Section
	'checkSitemap' => 'Проверка указания директивы Sitemap',
	'stSitemapTrue' => 'Директива Sitemap указана',
	'recSitemapTrue' => 'Доработки не требуются',
	'stSitemapFalse' => 'В файле robots.txt не указана директива Sitemap',
	'recSitemapFalse' => 'Программист: Добавить в файл robots.txt директиву Sitemap',
];