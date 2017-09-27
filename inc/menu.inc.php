<?php
/*
	Подключаемый модуль menu.inc.php - шаблонный элемент сайта 
	"Левое боковое меню"
*/

$strSQL1="SELECT * FROM publishers ORDER BY name_publ";
$result1=mysql_query($strSQL1) or die("He могу выполнить запрос $strSQL1!");

$strSQL2="SELECT * FROM categories ORDER BY name_cat";
$result2=mysql_query($strSQL2) or die("He могу выполнить запрос $strSQL2!");

while ($row=mysql_fetch_array ($result1) )
{
	$publ_li .= '<li><a href="'.$_SERVER["PHP_SELF"].'?page=catalog&type=1&id_publ='.$row["id_publ"].'">'.
		$row["name_publ"].'</a></li>
		';
}
while ($row=mysql_fetch_array ($result2) )
{
	$cat_li .= '<li><a href="'.$_SERVER["PHP_SELF"].'?page=catalog&type=2&id_cat='.$row["id_cat"].'">'.
		$row["name_cat"].'</a></li>
		';
}

$menu = '
	<!-- Меню -->
	<div class="menu" id="menu">
		<nav>
			<ul>
				<li><a >Издaтeли</a></li>
				<ul>
					'.$publ_li.'
				</ul>
				<li><a >Kaтeгopии</a></li>
				<ul>
					'.$cat_li.'
				</ul>
			</ul>
		</nav>
	</div>
	<!-- Меню -->
';

?>