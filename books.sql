create database books;
use books;
create table publishers( 
	id_publ int(5) primary key auto_increment, 
	name_publ varchar(50)
);

insert into publishers (name_publ)	values ("�����"); 
insert into publishers (name_publ)	values ("BHV"); 
insert into publishers (name_publ)	values ("����"); 
insert into publishers (name_publ)	values ("����������");
insert into publishers (name_publ)	values ("Que");

create table categories( 
	id_cat int(5) primary key auto_increment, 
	name_cat varchar(50)
);

insert into categories (name_cat) values ("������������ ����������");
insert into categories (name_cat) values ("�������������� ����������");
insert into categories (name_cat) values ("�����������");
insert into categories (name_cat) values ("����������� �����");
insert into categories (name_cat) values ("���������");

create table books( 
	id_book int(5) primary key auto_increment, 
	name_book varchar(100), 
	id_publ int(5), 
	id_cat int(5), 
	author varchar(50), 
	pages int(4), 
	price int(4), 
	dat int(4), 
	image varchar(50)
);

insert into books(name_book,id_publ,id_cat,author,pages,price,dat,image) values
("Ajax � ��������", 4, 1, "���� �����, ���� ����������, ������ ������", 640, 200, 2006, "1216642298_145214.png");
insert into books(name_book,id_publ,id_cat,author,pages,price,dat,image) values
("Microsoft Visual Studio 2008", 2, 1, "������ �., ����� M.", 1192, 400, 2009, "4a98c94faal76.jpg");
insert into books(name_book,id_publ,id_cat,author,pages,price,dat,image) values
("������� Ajax", 1, 1, "����� ���������", 425, 300, 2008, "1224319675_izuchaem-ajax.jpg");
insert into books(name_book,id_publ,id_cat,author,pages,price,dat,image) values
("������ ���������� ���-���������� � ����� Rails", 1, 1, "�. �����, �. X. �������", 720, 400, 2008, "1217485667_1000657293.jpg");
insert into books(name_book,id_publ,id_cat,author,pages,price,dat,image) values
("Microsoft Visual C# � ������� � ��������", 2, 1, "�. �������", 314, 140, 2006, "4a3de5b9e8517.jpg");

create table basket_books(
	id_bask char(16),
	id_book int(5),
	kolvo int(2),
	date_bask date
);

create table customers(
	id_cust int(5) primary key auto_increment,
	fam varchar(30),
	im varchar(30),
	addr varchar(100),
	mail varchar(30),
	login varchar(10),
	pass varchar(10),
	subscribe int(1)
);

create table orders(
	id_order char(15),
	date_ord date,
	id_cust int(5),
	dostavka int(1),
	bonus int(5)
);

create table order_books(
	id_order char(15),
	id_book int(5),
	kolvo int(2)
);
