<?php
/*
	Модуль 1 Практикум. Работа с cookie
	Задание. С помощью куки, установить счетчик посещения сайта пользователем (считает только один раз в сутки).
			При первом приходе нового пользоавтеля на сайт выдавать строку: "Добро пожаловать на наш сайт!".
			При повторном приходе пользоавтеля указавать дату время последнего прихода и количество посещений.
*/

$visitCounter = 0;
if(isset($_COOKIE['visitCounter'])) 
{
	$visitCounter = $_COOKIE['visitCounter'];
}
$lastVisit = '';
if(isset($_COOKIE['lastVisit'])) 
	$lastVisit = date('d-n-T H:i:s', $_COOKIE['lastVisit']);
#-- Проверяем, если сегодня пользователь не заходил?
if(date('d-m-Y', $_COOKIE['lastVisit']) != date('d-m-Y'))
{
	#-- Следующее cookie устанавливается "навсегда" по причине заданного даты/времени 0x7FFFFFFF
	$visitCounter++;
	setcookie('visitCounter', $visitCounter, 0x7FFFFFFF);
	setcookie('lastVisit', time(), 0x7FFFFFFF);
}
#-- !!! ВНИМАНИЕ !!! После закрывающей скобки php-модуля "?\>" НЕДОПУСТИМЫ символы "\n\r"
#-- В противном случаи все последующие заголовки и cookie установлены не будут !!!

	if(isset($visitCounter))
	if($visitCounter == 1)
	{
		$welcome = "Добро пожаловать на наш сайт!";
	}
	else
	{
		$welcome = "Вы зашли к нам $visitCounter раз<br>";
		$welcome .= "Последнее посещение $lastVisit<br>";
	}

//-- Читаем идентификатор пользователя
$id_bask=$_COOKIE["id_bask"];
//-- Создаем идентификатор пользователя (даже если он не зарегистрирован)
if (!isset($id_bask))
{
	$uniq_ID=uniqid("ID");
	//-- создадим ключик
	setcookie("id_bask", $uniq_ID, time()+60*60*24*14); // создадим ключик
}
else
{
	//-- пересоздадим ключик с тем же значением, т. е.
	//-- продлим его срок хранения еще на 2 недели
	setcookie("id_bask", $id_bask, time()+60*60*24*14); // создадим ключик

}
#echo "cookie=$id_bask<br>";
