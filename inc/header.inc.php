<?php
/*
	������������ ������ header.inc.php - ��������� ������� ����� 
	"������������ ����� �����" (����� ��������)
	����� ����������� ���������� ����������� ������������������� ������������
*/

include ("./inc/auto.inc.php");


$h_menu = '
				<nav>
					<ul class="h_menu" id="h_menu">
						<li><a href="http://mysite.ua">�� mysite.ua</a></li>
						<li '.(($page == "catalog")?'class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=catalog">�������</a></li>
						<li '.(($page == "basket")?'class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=basket">�������</a></li>
						<li '.(($page == "order")?'class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=order">�����</a></li>
						'.(isset($_SESSION["log"]) 
							?
							'<li '.(($page == "cabinet")?'class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=cabinet">������ �������</a></li>'
							:
							'<li '.(($page == "register")?'class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=register">�����������</a></li>'
						).'
						<li '.(($page == "contacts")?'class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=contacts">��������</a></li>
						'.(isset($_SESSION["log"]) ?'<li><a href="exit.php?page=catalog">�����</a></li>':'').'
					</ul>
				</nav>
';
$header = '
			<div class="logo" id="logo">
				<img src="images/logo.jpg" width="208" height="113" alt="��� �������" class="logo" />
			</div>
			<div class="title" id="title">
				<blockquote>
					<b><i>����</i></b><br>
					<i>'.$welcome.'</i>
				</blockquote>
				<center>
					<h1> '.$title.' </h1>
				</center>
			</div>
			<div class="auto" id="auto"'.$style_auto_Ok.'>
				'.$auto.$message_auto.'
			</div>
			
			<div class="h_menu" id="h_menu">
'.$h_menu.'
			</div>
';
?>