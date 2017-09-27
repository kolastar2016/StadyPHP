<?php
/*
	Подключаемый модуль head.inc.php - шаблонный элемент сайта 
	"HTML-заголовок сайта" (любой страницы)
*/


$head = '
<head>
	<title> '.$title.' </title>
	
	<META http-equiv=Content-Type content="text/html; charset=windows-1251">
	<META name="author" content="'.$author.'">
	<META name="description" content="'.$description.'">
	<META name="keywords" content="'.$keywords.'">
	<META name="Copyright" content="'.$Copyright.'">
	<META name="robots" content="all">
	
	<link rel="stylesheet" href="css/my_style.css" type="text/css"/>
	<link rel="stylesheet" href="css/h_menu.css" type="text/css"/>	
</head>
';
?>