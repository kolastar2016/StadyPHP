<?php
/*
	������������ ������ connect.inc.php - ����������� � ���� ������
	�����: "root"
	������: ""
	����: "books"
*/
$db_host = "localhost";
$db_usr = "root";
$db_pass = "";
$db_source = "books";

@mysql_pconnect($db_host, $db_usr, $db_pass) or die ("He ���� ������������ � �������!");
//-- ��������� ������� ������� Win-1251
mysql_query("SET NAMES 'cp1251'");
mysql_query("SET CHARACTER SET 'cp1251'");
@mysql_select_db($db_source) or die ("He ���� ������������ � ���� ������ $db_source!");

?>