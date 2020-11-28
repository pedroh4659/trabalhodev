CREATE DATABASE trabalho;
USE trabalho;

create table casa (
	id int primary key auto_increment not null,
	endereco varchar(100) not null,
	estado char(2) not null,
	cidade varchar(45) not null,
	preco float not null,
	area float not null,
	numbanheiros int,
	numquartos int,
	garagem bool not null,
	vendaluguel bool not null,
	descricao varchar(200)
);
