<?php


//-- ��� �������� �������
//-- ���� �� ������ ��� ��������� ��������
if(!isset($type))
{
	//-- ������������� ���: �� ��������� � ������ ��������
	$type=1;
	$id_publ=1;
}

if ($type==1)
{
	$strSQL1 = "SELECT name_publ FROM publishers WHERE id_publ=".$id_publ;

	$result=mysql_query($strSQL1) or die("He ���� ��������� ������ $strSQL1!");
	if($row=mysql_fetch_array($result))
		$title=$row["name_publ"];
		
	$strSQL1 = "
	SELECT 
			id_book, image, author, name_book, 
			books.id_publ, name_publ, pages,
			price, books.id_cat, name_cat
		FROM books, publishers, categories
		WHERE
			books.id_cat=categories.id_cat AND
			books.id_publ=publishers.id_publ AND
			books.id_publ=".$id_publ;
}
if ($type==2)
{
	$strSQL1="SELECT name_cat FROM categories WHERE id_cat=".$id_cat;
	$result=mysql_query($strSQL1) or die("He ���� ��������� ������1!");
	if($row=mysql_fetch_array($result))
		$title=$row["name_cat"];
		
	$strSQL1 = "
	SELECT 
			id_book, image, author, name_book, 
			books.id_publ, name_publ, pages,
			price, books.id_cat, name_cat
		FROM books, publishers, categories
		WHERE
			books.id_cat=categories.id_cat AND
			books.id_publ=publishers.id_publ AND
			books.id_cat=".$id_cat;
}
#echo "$type:$page - $strSQL1"."<br>";

$resultl=mysql_query($strSQL1) or die("He ���� ��������� ������ $strSQL1!");


$count_members=0;
$catalog_tmp="";
while ($row=mysql_fetch_array ($resultl) )
{
	$count_members++;
	$catalog_tmp .= '
	<tr>
		<td align="center">
			<img src="images/'.$row ["image"].'" alt="'.$row["name_book"].'" border="0">
			<center>
				<a href="'.$_SERVER["PHP_SELF"].'?page=basket&type=1&id_book='.$row["id_book"].'">
					<font size=-1>�������� � �������</font>
				</�>
			</center>
		</td>
		<td>
		
			<table>
				<tr>
					<td align="right"><i>�����: </i></td>
					<td>'. $row["author"].'</td>
				</tr>
				<tr>
					<td align="right"><i>Ha������:</i></td>
					<td>'.$row["name_book"].'</td>
				</tr>
				<tr>
					<td align="right"><i>������������:</i></td>
					<td><a href="'.$_SERVER["PHP_SELF"].'?page='.$page.'&type=1&id_publ='.$row["id_publ"].'">'.$row["name_publ"].'</a> </td>
				</tr>
				<tr>
					<td align="right"><i>����������	�������: </i></td>
					<td>'.$row["pages"].'</td>
				</tr>
				<tr>
					<td align="right"><i>����: </i></td>
					<td>'.$row["price"].'</td>
				</tr>
				<tr>
					<td align="right"><i>���������:	</i></td>
					<td><a href="'.$_SERVER["PHP_SELF"].'?page='.$page.'&type=2&id_cat='.$row["id_cat"].'">'.$row["name_cat"].'</a> </td>
				</tr>
			</table>
			<hr>
		</td>
	</tr>
	';
}

if($count_members > 0)
	$catalog = '<p>���������� '.$count_members.' ������������ '.(($type==1)?'�������� '.$title:'��������� '.$title).' :</p>
	<table border="0" width="100%" align="right">
'.$catalog_tmp.'
	</table>
';
else
	$catalog = '<p>�� ������ ������ ����������� ���.</p>';
?>