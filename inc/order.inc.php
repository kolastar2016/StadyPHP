<?php


/*------------------------------------------------------------------------
	Отправка заказа
*/
//-- Если была нажата ссылка "Отправить заказ"
if($order_send == 1)
{
	if(!isset($log))
	{
		#-- Перезапрос страницы
		header("Refresh: 5; url=http://".$_SERVER[HTTP_HOST]."/".$_SERVER["PHP_SELF"]."?page=register");
		 $message="<tr><td bgcolor='#ff9999' align='center'> <b>Вы не авторизованы!!! Пройдите регистрацию!</b></td></tr>";
	}
	else
	{
		$strSQL1="
			SELECT COUNT(*) as count
				FROM basket_books
				WHERE id_bask='".$id_bask."'";
		$result1=mysql_query($strSQL1) or die("He могу выполнить запрос1!");
		$row=mysql_fetch_array($result1);
		if($row["count"] == 0)
			$message="<tr><td bgcolor='#ff9999' align='center'> <b>Ваша корзина	пуста! </b></td></tr>";
		else
		{
			//-- создаем новый заказ
			$order=uniqid("OR");
			$strSQL="INSERT INTO orders(id_order, date_ord, id_cust, dostavka, bonus)
			VALUES ('".$order."',CURDATE(),".$id.", ".$dostavka.",".$bonus.")";
			mysql_query($strSQL) or die("He могу выполнить запрос: $strSQL !");	
		
		
			//-- читаем все из корзины покупателя
			$strSQL="SELECT * FROM basket_books WHERE id_bask='".$id_bask."'";
			$result=mysql_query($strSQL) or die("He могу выполнить запрос $strSQL!");
			while ($row=mysql_fetch_array($result))
			{
				//-- и переписываем в состав заказа
				$strSQL="
				INSERT INTO order_books (id_order, id_book, kolvo)
				VALUES ('".$order."',".$row["id_book"]. ",".$row["kolvo"].")";
				mysql_query($strSQL) or die("He могу выполнить запрос $strSQL!");
			}
		
			//-- очищаем корзину покупателя
			$strSQL="DELETE FROM basket_books WHERE id_bask='".$id_bask."'";
			mysql_query($strSQL) or die("He могу вьотолнить запрос $strSQL!");
		
			$uniq_ID=uniqid("ID");
			setcookie("id_bask", $uniq_ID, time()+60*60*24*14);
			
			$message="<tr><td bgcolor='#66cc66' align='center'> <b>Ваш заказ отправлен</b></td></tr>";
		}
	}
}

/*------------------------------------------------------------------------
Просмотр заказа
*/
$strSQL1="
	SELECT COUNT(*) as count
		FROM basket_books
		WHERE id_bask='".$id_bask."'";
$result1=mysql_query($strSQL1) or die("He могу выполнить запрос1!");
$row=mysql_fetch_array($result1);
if($row["count"]==0)
{
	$order = '
	<center>
		<b>Baшa корзина пуста!</b>
	</center>
	';
}
else
{
	$strSQL1="
		SELECT image, author, name_book, pages, price, kolvo, id_bask, books.id_book
			FROM books, basket_books
			WHERE
			books.id_book=basket_books.id_book AND
			id_bask='".$id_bask."'";
	$result1=mysql_query($strSQL1) or die("He могу выполнить запрос1!");
	$order = '
	<table border="1" width="100%" align="right" >
		<tr>
			<th align="right"><i>Aвтор: </i></th>
			<th align="right"><i>Название: </i></th>
			<th align="right"><i>Цена: </i></th>
			<th align="right"><i>Количество: </i></th>
		</tr>
	';
	$sum=0;
	while($row=mysql_fetch_array($result1))
	{
		$order .= '
			<tr>
				<td>'.$row["author"].'</td>
				<td><b>'.$row["name_book"].'</b></td>
				<td>'.$row["price"].'</td>
				<td>'.$row["kolvo"].'</td>
			</tr>
		';
		$sum=$sum+$row["price"]*$row["kolvo"];
	}
	$order .= '
		<tr>
			<td></td>
			<td align="right"><i>ИТОГО: </i></td>
			<td>'.$sum.'</td>
			<td></td>
		</tr>
	</table>
	
	<form action='.$_SERVER["PHP_SELF"].' method="post">
		<input type="hidden" name="page" value="'.$page.'">
		<input type="hidden" name="order_send" value="1">
	
	<p>&nbsp;</p>
	<b>Cпособ доставки: </b>
	<input type="radio" value=1 name="dostavka" checked> почта
	<input type="radio" value=2 name="dostavka"> курьер
	<input type="radio" value=3 name="dostavka"> самовывоз
	<br>
	Прислать бесплатный каталог по теме:
	<select name="bonus">
		<option value="0">
	';
	$strSQL1="SELECT * FROM categories";
	$result1=mysql_query($strSQL1) or die("He могу выполнить запрос!");
	while($row=mysql_fetch_array($result1))
	{
		$order .= '
		<option value="'.$row["id_cat"].'">'.$row["name_cat"].'
		';
	}
	$order .= '
	</select>
	<br>
	<br>
	<center>
		<!--a  href='.$_SERVER["PHP_SELF"].'?page='.$page.'&order_send=1><b>Отправить Заказ</b></a -->
	<input type="submit" value="Отправить Заказ">
	</center>
	</form>
	';
}

?>