<?
/*
	Выход - отмена авторизации
*/

	$page = $_GET["page"];
	if($page == "")$page="home";
	
	session_start();
	unset($_SESSION['log']);
	unset($_SESSION['id']);
	session_destroy();
	//-- Собственно переходим на главную страницу
	header("Location: http://".$_SERVER[HTTP_HOST]."/shop.php?page=".$page);
?>