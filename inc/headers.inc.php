<?php
/*
	#-- PHP-скрипты часто генерируют динамический контент, 
	#-- который не должен кешироваться клиентским браузером 
	#-- или любым другим прокси-кешем между сервером и клиентским 
	#-- браузером. 
	#-- Многие клиенты и прокси-сервера можно заставить отключить
	#-- кеширование при помощи кода:
*/
	// Date in the past 
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
	// always modified 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	// HTTP/1.1 
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: post-check=0, pre-check=0", false); 
	// HTTP/1.0 
	header("Pragma: no-cache"); 

	#-- Однако, если нам необходимо закешировать страницу на некоторое время, 
	#header("Cache-Control: public");
	#-- включаем кеширование в кеше браузера
#	header("Cache-Control: private");
	#-- скажем 3 часа, этому соответствует 10800 - время (в секундах)
#	header("Expires: " . date("r", time()+10800));
#	header("Expires: " . gmdate('D, d M Y H:i:s', time()+10800) . ' GMT');

	header("Content-type: text/html; charset=win-1251");
	
	//-- Для регистрации и авторизации пользователя
	session_start();
