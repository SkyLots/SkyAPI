<?php
header('Content-Type: text/html; charset=utf-8'); 
$api_key="YOUR_KEY";	#Ключ

# Подключаем пример простого клиента для работы с API SkyLots
require_once("client.php");

# Инициализация
$sky_api=new SkyAPI_client($api_key); 

# Пример проверки соединения с сервером API
if($sky_api->get_status()){
	print "<font color=green><b>Соединение установлено. Ключ валиден.</b></font><br><br>";
	
	# Получаем информацию о пользователе по ID
	$user=$sky_api->get_user_info(12362517);
	print "<br><b>Пользователь:</b> ".$user['name']." ID: ".$user['id']." Рейтинг: ".$user['rating'].'<br><br>';


	# Получаем последние лоты пользователя
	$lots=$sky_api->get_last_lots(12362517);
	print '<b>Последние лоты:</b> <br><pre>';
	print_r($lots);
	print '</pre><br><br>';
  
	# Получаем 50 случайных лотов пользователя
	$lots=$sky_api->get_last_lots(12362517,"rand");
	print '<b>50 случайных лотов:</b> <br><pre>';
	print_r($lots);
	print '</pre><br><br>';
	
	# Получаем 50 случайных лотов пользователя из категории с id 28641
	$last_lots=$sky_api->get_last_lots(12362517,"rand",28641);
	print '<b>50 случайных лотов из категории Автозапчасти, Тюнинг, GPS:</b> <br><pre>';
	print_r($last_lots);
	print '</pre><br><br>';
	
	# Получаем 50 последних отзывов
	$reviews=$sky_api->get_last_reviews(12362517);
	print '<b>Последние отзывы:</b> <br><pre>';
	print_r($reviews);
	print '</pre><br><br>';
}else
	print "<font color=green><b>Соединение не установлено. Проверьте ключ.</b></font><br><br>";