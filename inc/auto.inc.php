<?php
/*
	������������ ������������� ������ auto.inc.php - ��������� ���������������
	����������� ������������
*/

if(isset($pass) && isset($login))
{
	$strSQL1="
	SELECT *
		FROM customers
		WHERE
			login='".$login."' AND
			pass='".$pass."'";
	$result1 = mysql_query($strSQL1) or die("He ���� ��������� ������ $strSQL1!");
	// ������������ � ����� ������� � ������� ������ ?
	if($row=mysql_fetch_array($result1))
	{
		// �������� ��������� ���������� ��� ��� ����������
		$_SESSION["log"]=$row["fam"]." ".$row["im"];
		// �������� ��������� ���������� ��� ID ����������
		$_SESSION["id"]=$row["id_cust"];
		$message_auto="<span bgcolor='#66cc66' align='center'><b>�� ������� ������������</b></span>";
		$success=true;
		$style_auto_Ok = 'style="background: #f1f1d1;"';
	}
	else
	{
		$message_auto="<span bgcolor='#ff9999' align='center'> <b>����� ������/������ �� ����������!!!</b></span>" ;
	}

}
else
{
	if(isset($_SESSION["log"]))
	{
		$success=false;
		$message_auto="<span bgcolor='#ff9999' align='center'>
		<b>".$_SESSION["log"]."</b></span>" ;
		$message_auto.="<br><a href='".$_SERVER["PHP_SELF"]."?page=basket'>�������</�>";
		$style_auto_Ok = 'style="background: #f1f1d1;"';
	}
	else
	{
		$success=false;
		$message_auto="<span bgcolor='#ff9999' align='center'> <b>������������� ����������</b></span>" ;
	}
}

if($success)
{
	//-- ���� �� ������ ��� ��������������- ��������� �� ������� ��������
	# include ("cabinet.phtml");
	if($page == "register") $page = "cabinet";
	header("Location: http://".$_SERVER[HTTP_HOST].$_SERVER["PHP_SELF"]."?page=".$page);
}
else
{
	//-- ���� ����������� �� ������
	if(!isset($style_auto_Ok))
	{
		$auto = '
			<div class=register id=register>
				<form action='.$_SERVER["PHP_SELF"].' method="post">
					<input type="hidden" name="page" value="'.$page.'">
					<p>
						<span>�����: <input class=input type="text" name="login" size=22 size=></span><br>
						<span>������ : <input class=input type="password" name="pass" size=16></span>
						<input type="submit" value=Ok>
					</p>
				</form>
			</div>
	';
	}
	else
		$auto = '';
}
?>
