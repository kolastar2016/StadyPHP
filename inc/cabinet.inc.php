<?php
/*
	������������ ������ cabinet.inc.php - ��������������
	������������ ��������� �������� �������� �����������
*/


/*------------------------------------------------------------------------
��������� ������ ������
*/
//-- ���� ������ ������ "��������� ���������" ?
if($type==1)
{
	if($fam!="" && $im!="" && $addr!="" && $mail!="")
	{
		$strSQL1="UPDATE customers 
			SET fam='".$fam."', im='".$im."', addr='".$addr."',
			mail='".$mail."', subscribe='".$subscribe."' 
				WHERE id_cust=".$id;
		$result1=mysql_query($strSQL1) or die("He ���� ��������� ������ $strSQL1!");
		$_SESSION["log"]=$fam." ".$im;
		//-- �������� �������� ��������� ����������
		$message="<center> <b>��������� ������ ���������</b></center>";
	}
	else
		$message="<center> <b>He ��� ���� ���������!!!</b></center>";
}

/*------------------------------------------------------------------------
	�������� ���� ����� ���������� �������
*/
if(!isset($log))
{
	$success=false;
	$message="<center> <b>�� �� ������������!!!</b></center>";
}
else
	$success=true;


//-- ������������ �����������
if($success)
{
	//-- ��������� ����� ��������� ������������ ������
	$strSQL="SELECT * FROM customers WHERE id_cust='".$id."'";
	#echo "$strSQL<br>";
	$result=mysql_query($strSQL) or die("He ���� ��������� ������ $strSQL!");
	if($row=mysql_fetch_array($result))
	{
		$cabinet = '
		<form action='.$_SERVER["PHP_SELF"].' method=post>
			<!--form action=change.phtml method=get-->
			<input type=hidden name=type value=1>
			<input type="hidden" name="page" value="'.$page.'">
			<h3>Ba�� ������ ������</h3>
			<table border="0" width="100%" align="right">
				<tr>
					<td align="right"><i>�������: </i></td>
					<td> <input type=text name=fam value="'.$row["fam"].'"></td>
					<td align="right"><i>���: </i></td>
					<td><input type=text name=im value="'.$row["im"].'"></td>
				</tr>
				<tr>
					<td align="right"><i>��pec: </i></td>
					<td><input type=text name=addr value="'.$row["addr"].'"></td>
					<td align="right"><i>E-mail: </i></td>
					<td><input type=text name=mail value="'.$row["mail"].'"></td>
				</tr>
				<tr>
					<td align="right" colspan=3>
					<i><input type="checkbox" value="l" name="subscribe"
					'.(($row["subscribe"]==1) ? "checked" : "").'>
					</td>
					<td></td>
				</tr>
				<tr>
					<td align="center" colspan="4">
						<input type="submit" value="��������� ���������">
					</td>
				</tr>
			</table>
		</form>
	';	
	

	$cabinet .= '
		<h3>���� ������</h3>
	';
	//-- ��������� ���� ������
	$strSQL1="
	SELECT id_order, date_ord
		FROM orders
		WHERE 
			id_cust='".$id."' ORDER BY date_ord DESC";
	$result1=mysql_query($strSQL1) or die("He ���� ��������� ������1 $strSQL1!");
	while($row1=mysql_fetch_array($result1))
	{
		$order=$row1["id_order"];
		$strSQL2="
			SELECT 
				author, name_book, pages, price, kolvo, id_order,
			books.id_book
				FROM books, order_books
			WHERE
			books.id_book=order_books.id_book and
			id_order='".$order."'";
	
		$result2=mysql_query($strSQL2) or die("He ���� ��������� ������2!");
		$cabinet .= '
			<hr>
			<b>����� � '.$order.' �� '.$row1["date_ord"].'<br></b>
			<table border="1" width="100%" align="right">
				<tr>
					<td align="right" width="20%"><i>�����: </i></td>
					<td align="right" width="50%"><i>Ha������: </i></td>
					<td align="right" width="15%"><i>����: </i></td>
					<td align="right"width="15%"><i>Ko���ec��o: </i></td>
				</tr>
		';
		$sum=0;
		while($row2=mysql_fetch_array($result2))
		{
			$cabinet .= '
			<tr>
				<td>'.$row2["author"].'</td>
				<td><b>'.$row2["name_book"].'</b></td>
				<td>'.$row2 ["price"].'</td>
				<td>'.$row2["kolvo"].'</td>
			</tr>
			';
			$sum=$sum+$row2["price"]*$row2["kolvo"];
		}
		$strSQL3="
			SELECT name_cat
				FROM categories, orders
				WHERE
					categories.id_cat=orders.bonus AND
					id_order='".$order."'";
					
					
		$result3=mysql_query($strSQL3) or die("He ���� ��������� ������3!");
		if($row3=mysql_fetch_array($result3))
		{
			$cabinet .= '
				<tr>
					<td ��lspan=2>���������� ������� �� ���� </td>
					<td><b>
					'.$row3["name_cat"].'</b></td>
					<td></td>
				</tr>
			';
		}
		$cabinet .= '
			<tr>
				<td></td>
				<td align="right"><i>�����: </i></td>
				<td>'.$sum.'</td>
				<td></td>
			</tr>
		</table>
		';
		} //-- mysql_fetch_array($result1)
	} //-- mysql_fetch_array($result)
} //-- $success


?>