<?php

/*-------------------------------------------------------------------
	Подкл. функциональный модуль basket.inc.php - Просмотр корзины
	Действия с корзиной
	Сначала выполняются действия с корзиной, если таковые происходили
	и в соответствии с этими действиями изменяются записи в базе данных,
	таблица:
		basket_books
*/

if($type==1) //-- Положить в корзину
{
	$strSQL="
		SELECT *
			FROM basket_books
			WHERE
				id_book=".$id_book." AND
				id_bask='".$id_bask."'";
	$result=mysql_query($strSQL) or die("He могу выполнить запрос $strSQL!");
	if ($row=mysql_fetch_array($result))
	{
		$strSQL="UPDATE basket_books SET kolvo=kolvo+1 
			WHERE 
				id_book=".$id_book." AND 
				id_bask='".$id_bask."'";
	}
	else
	{
		$strSQL="INSERT INTO basket_books 
			(id_bask, id_book, kolvo, date_bask) VALUES
			('".$id_bask."',".$id_book.",1,CURDATE())";
	}
	mysql_query($strSQL);
}
else if($type==2) //-- Уменьшить количество
{
	$strSQL="
		SELECT *
			FROM basket_books
			WHERE
			id_book=".$id_book." AND
			id_bask='".$id_bask."'";
	$result=mysql_query($strSQL) or die("He могу выполнить запрос $strSQL!");
	if ($row=mysql_fetch_array($result))
	{
		if ($row["kolvo"]>1)
		{
			$strSQL="UPDATE basket_books SET kolvo=kolvo-1 
				WHERE
					id_book=".$id_book." AND 
					id_bask='".$id_bask."'";
		}
		else
		{
			$strSQL="DELETE FROM basket_books 
				WHERE 
					id_book=".$id_book." AND
					id_bask='".$id_bask."'";
		}
	}
	mysql_query($strSQL);
}
else if($type==3) //-- Удалить из корзины
{
	$strSQL="DELETE FROM basket_books 
		WHERE 
			id_book=".$id_book." AND
			id_bask='".$id_bask."'";
	mysql_query($strSQL);
}
else if($type==4) //-- Очистить корзину
{
	$strSQL="DELETE FROM basket_books WHERE id_bask='".$id_bask."'";
	mysql_query($strSQL);
}

$strSQL1="SELECT COUNT(*) as count FROM basket_books WHERE id_bask='".$id_bask."'";
$result1=mysql_query($strSQL1) or die("He могу выполнить запрос $strSQL1!");
$row=mysql_fetch_array($result1);
if($row["count"] == 0)
{
	$basket = '
		<b>Ваша корзина пуста!</b>
	';
}
else
{
	$strSQL1="
	SELECT 
			image, author, name_book, pages, price, 
			kolvo, id_bask, books.id_book
		FROM books, basket_books
		WHERE
			books.id_book=basket_books.id_book AND
			id_bask='".$id_bask."'";
	
	$result1=mysql_query($strSQL1) or die("He могу выполнить запрос $strSQL1!");
	$basket .= '
	<table border="l" width="100%" align="right">
		<tr>
			<th align="right"><i>Aвтop: </i></th>
			<th align="right"><i>Название: </i></th>
			<th align="right"><i>Цена: </i></th>
			<th align="right"><i>Количество: </i></th>
			<th></th>
		</tr>
	';
	$sum=0;
	while($row=mysql_fetch_array($result1))
	{
		$basket .= '
		<tr>
			<td>'.$row["author"].'</td>
			<td><b>'.$row ["name_book"].'</b></td>
			<td>'.$row["price"].'</td>
			<td>'.$row["kolvo"].'
				<a href="'.$_SERVER["PHP_SELF"].'?page=basket&type=1&id_book='.$row["id_book"].'" title="Увеличить"> [ + ] </a>
				<a href="'.$_SERVER["PHP_SELF"].'?page=basket&type=2&id_book='.$row["id_book"].'" title="Уменьшить"> [ - ]</a>
			</td>
			<td><a href="'.$_SERVER["PHP_SELF"].'?page=basket&type=3&id_book='.$row["id_book"].'">Удалить</а></td>
		</tr>
		';
		$sum += $row["price"]*$row["kolvo"];
	}
	$basket .= '
		<tr>
			<td align="right"></td>
			<td align="right"><i>ИТОГО: </i></td>
			<td align="right">'.$sum.'</td>
			<td align="right"></td>
		</tr>
	</table>
	<center>
		<a href='.$_SERVER["PHP_SELF"].'?page=basket&type=4><b>Очистить корзину</b></a>
	</center>
	<center>
		<a href="'.$_SERVER["PHP_SELF"].'?page=order&order_send=0"><b>Оформить заказ</b></a>
	</center>
	';

}
?>