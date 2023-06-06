create database db_servico;

use db_servico;

create table tb_cliente(
id int auto_increment primary key,
nr_cpf char(11) ,
nm_cliente varchar(50),
nm_endereco varchar(50),
nr_telefone varchar(11),
nm_bairro varchar(50),
nm_cidade varchar(25),
nr_cep varchar(20),
imagem longblob NOT NULL
);

create table tb_produto(
id int auto_increment primary key,
nm_produto varchar(50),
ds_produto longtext,
vl_produto decimal(10,2),
qt_estoque varchar(5),
imagem longblob NOT NULL
);

create table tb_fornecedor(
id int auto_increment primary key,
nr_cnpj char(14) ,
nm_fornecedor varchar(50),
nm_endereco varchar(50),
nr_telefone varchar(11),
nm_bairro varchar(50),
nm_cidade varchar(25),
nr_cep varchar(20),
imagem longblob NOT NULL
);

CREATE TABLE tb_funcionario(
id int auto_increment primary key,
nr_cpf char(11) ,
nm_funcionario varchar(50) NOT NULL,
nm_endereco varchar(50) NOT NULL,
nr_telefone char(11),
nm_bairro varchar(50) NOT NULL,
nm_cidade varchar(50) NOT NULL,
nr_cep char(8) NOT NULL,
imagem longblob NOT NULL
);

CREATE TABLE tb_usuario(
  id int auto_increment primary key,
  email varchar(30) NOT NULL,
  senha varchar(20) NOT NULL,
  tipo ENUM('comum', 'administrador') NOT NULL
);

insert into tb_usuario
(email, senha, tipo) values
('admin@teste', 'admin', 'administrador');

insert into tb_usuario
(email, senha, tipo) values
('teste@teste', 'teste', 'comum');

select * from tb_produto;
select * from tb_fornecedor;
select * from tb_funcionario;
select * from tb_usuario;