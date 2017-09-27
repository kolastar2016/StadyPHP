<?php
/*
	������ 1 ���������. ������ � cookie
	�������. � ������� ����, ���������� ������� ��������� ����� ������������� (������� ������ ���� ��� � �����).
			��� ������ ������� ������ ������������ �� ���� �������� ������: "����� ���������� �� ��� ����!".
			��� ��������� ������� ������������ ��������� ���� ����� ���������� ������� � ���������� ���������.
*/

$visitCounter = 0;
if(isset($_COOKIE['visitCounter'])) 
{
	$visitCounter = $_COOKIE['visitCounter'];
}
$lastVisit = '';
if(isset($_COOKIE['lastVisit'])) 
	$lastVisit = date('d-n-T H:i:s', $_COOKIE['lastVisit']);
#-- ���������, ���� ������� ������������ �� �������?
if(date('d-m-Y', $_COOKIE['lastVisit']) != date('d-m-Y'))
{
	#-- ��������� cookie ��������������� "��������" �� ������� ��������� ����/������� 0x7FFFFFFF
	$visitCounter++;
	setcookie('visitCounter', $visitCounter, 0x7FFFFFFF);
	setcookie('lastVisit', time(), 0x7FFFFFFF);
}
#-- !!! �������� !!! ����� ����������� ������ php-������ "?\>" ����������� ������� "\n\r"
#-- � ��������� ������ ��� ����������� ��������� � cookie ����������� �� ����� !!!

	if(isset($visitCounter))
	if($visitCounter == 1)
	{
		$welcome = "����� ���������� �� ��� ����!";
	}
	else
	{
		$welcome = "�� ����� � ��� $visitCounter ���<br>";
		$welcome .= "��������� ��������� $lastVisit<br>";
	}

//-- ������ ������������� ������������
$id_bask=$_COOKIE["id_bask"];
//-- ������� ������������� ������������ (���� ���� �� �� ���������������)
if (!isset($id_bask))
{
	$uniq_ID=uniqid("ID");
	//-- �������� ������
	setcookie("id_bask", $uniq_ID, time()+60*60*24*14); // �������� ������
}
else
{
	//-- ������������ ������ � ��� �� ���������, �. �.
	//-- ������� ��� ���� �������� ��� �� 2 ������
	setcookie("id_bask", $id_bask, time()+60*60*24*14); // �������� ������

}
#echo "cookie=$id_bask<br>";
