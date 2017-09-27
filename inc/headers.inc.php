<?php
/*
	#-- PHP-������� ����� ���������� ������������ �������, 
	#-- ������� �� ������ ������������ ���������� ��������� 
	#-- ��� ����� ������ ������-����� ����� �������� � ���������� 
	#-- ���������. 
	#-- ������ ������� � ������-������� ����� ��������� ���������
	#-- ����������� ��� ������ ����:
*/
	// Date in the past 
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
	// always modified 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	// HTTP/1.1 
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: post-check=0, pre-check=0", false); 
	// HTTP/1.0 
	header("Pragma: no-cache"); 

	#-- ������, ���� ��� ���������� ������������ �������� �� ��������� �����, 
	#header("Cache-Control: public");
	#-- �������� ����������� � ���� ��������
#	header("Cache-Control: private");
	#-- ������ 3 ����, ����� ������������� 10800 - ����� (� ��������)
#	header("Expires: " . date("r", time()+10800));
#	header("Expires: " . gmdate('D, d M Y H:i:s', time()+10800) . ' GMT');

	header("Content-type: text/html; charset=win-1251");
	
	//-- ��� ����������� � ����������� ������������
	session_start();
