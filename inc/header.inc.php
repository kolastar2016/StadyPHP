<?php
/*
	Подключаемый модуль header.inc.php - шаблонный элемент сайта 
	"Заголовочная часть сайта" (любой страницы)
	может реализовать функционал Авторизации Зарегистрированного пользователя
*/

include ("./inc/auto.inc.php");


$h_menu = '
				<nav>
					<ul class="h_menu" id="h_menu">
						<li><a href="http://mysite.ua">На mysite.ua</a></li>
						<li '.(($page == "catalog")?'class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=catalog">Каталог</a></li>
						<li '.(($page == "basket")?'class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=basket">Корзина</a></li>
						<li '.(($page == "order")?'class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=order">Заказ</a></li>
						'.(isset($_SESSION["log"]) 
							?
							'<li '.(($page == "cabinet")?'class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=cabinet">Личный кабинет</a></li>'
							:
							'<li '.(($page == "register")?'class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=register">Регистрация</a></li>'
						).'
						<li '.(($page == "contacts")?'class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=contacts">Контакты</a></li>
						'.(isset($_SESSION["log"]) ?'<li><a href="exit.php?page=catalog">Выход</a></li>':'').'
					</ul>
				</nav>
';
$header = '
			<div class="logo" id="logo">
				<img src="images/logo.jpg" width="208" height="113" alt="Наш логотип" class="logo" />
			</div>
			<div class="title" id="title">
				<blockquote>
					<b><i>МАУП</i></b><br>
					<i>'.$welcome.'</i>
				</blockquote>
				<center>
					<h1> '.$title.' </h1>
				</center>
			</div>
			<div class="auto" id="auto"'.$style_auto_Ok.'>
				'.$auto.$message_auto.'
			</div>
			
			<div class="h_menu" id="h_menu">
'.$h_menu.'
			</div>
';
?>