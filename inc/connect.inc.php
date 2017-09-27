<?php
/*
	Подключаемый модуль connect.inc.php - подключения к базе данных
	Логин: "root"
	Пароль: ""
	База: "books"
*/
$db_host = "localhost";
$db_usr = "root";
$db_pass = "";
$db_source = "books";

@mysql_pconnect($db_host, $db_usr, $db_pass) or die ("He могу подключиться к серверу!");
//-- Установка кодовой таблицы Win-1251
mysql_query("SET NAMES 'cp1251'");
mysql_query("SET CHARACTER SET 'cp1251'");
@mysql_select_db($db_source) or die ("He могу подключиться к базе данных $db_source!");

?>