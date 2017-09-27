<?php
/*
	Подключаемый модуль register.inc.php - функциональный
	Формирования основного контента страницы Регистрации
*/


#echo "$type, $fam, $im, $addr, $mail, $login, $pass, $pass2.<br>";
// была нажата кнопка "отправить" ?
if($type==1)
{
	// все поля не пустые ?
	if($fam !="" && $im!="" && $addr!="" && $mail!="" && $login!="" && $pass!="" && $pass2!="")
	{
		// поля пароля и повтора пароля не совпадают ?
		if ($pass!=$pass2)
		{
			$message="<span bgcolor='#ff9999' align='center'><b> Поля пароля и повтора пароля не совпадают!!!</b></span>";
		}
		else
		{
			// ищем, нет ли в базе данных пользователя с таким логином
			$strSQL1="SELECT id_cust FROM customers WHERE login='".$login."'";
			$result1=mysql_query($strSQL1) or die("He могу выполнить запрос $strSQL1");
			
			// такой логин уже есть ?
			if($row=mysql_fetch_array($result1))
			{
				$message="<span bgcolor='#ff9999' align='center'><b>Такой логин уже существует!!! Выберите другой логин</b></span>";
			}
			else
			{
				// создаем нового пользователя
				$strSQL1="INSERT INTO 
					customers(fam, im, addr, mail, login, pass,	subscribe)
					VALUES
						('".$fam."', '".$im."', '".$addr."', '".$mail."', '".$login."', '".$pass."', ".$subscribe.")";
				$result1=mysql_query($strSQL1) or die("He могу выполнить запрос $strSQL1!");
				$message="<span bgcolor='#66cc66' align='center'> <b>Вы успешно 3apeгистрировались</b></span>";
				$success=true;
			}
		}
	}
	else
		$message="<span bgcolor='#ff9999' align='center'> <b>He все поля заполнены!!!</b></span>";
}

if(!$success)
{
	$register = '
	'.$message.'
	<form action='.$_SERVER["PHP_SELF"].' method=post>
		<small>Звездочками отмечены обязательные поля</small>
		<table border="0" width="100%" align="right">
			<tr>
				<td align="right" width="50%"><i>Фaмилия: </i></td>
				<td> <input type=text name=fam value="'.$fam.'">*</td>
			</tr>
			<tr>
				<td align="right"><i>Имя: </i></td>
				<td><input type=text name=im value="'.$im.'">*</td>
			</tr>
			<tr>
				<td align="right"><i>Адрес: </i></td>
				<td><input type=text name=addr value="'.$addr.'">*</td>
			</tr>
			<tr>
				<td align="right"><i>E-mail: </i></td>
				<td><input type=text name=mail value="'.$mail.'">*</td>
			</tr>
			<tr>
				<td align="right"><i>Логин: </i></td>
				<td><input type=text name=login value="'.$login.'">*</td>
			</tr>
				<tr><td align="right"><i>Пароль: </i></td>
				<td><input type=password name=pass value="">*</td>
			</tr>
			<tr>
				<td align="right"><i>Повтор пароля: </i></td>
				<td><input type=password name=pass2 value="">*</td>
			</tr>
			<tr>
				<td><input type="checkbox" value="1" name="subscribe"></td>
				<td><i>Подписаться на рассылку новостей</i></td>
			</tr>
			<input type=hidden name=type value=1>
			<input type=hidden name=page value=register>
			<tr>
				<td align="right"></td>
				<td> <input type=submit value="Отправить"></td>
			</tr>
		</table>
	</form>
';
}
else
{
$register = '
'.$message;

if($page == "register") $page = "cabinet";
header("Refresh: 10;  url=http://".$_SERVER[HTTP_HOST].$_SERVER["PHP_SELF"]."?page=".$page);
}
?>