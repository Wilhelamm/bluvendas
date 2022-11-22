CREATE DATABASE bluvendas;

create table cadastro (
id_cadastro          INTEGER AUTO_INCREMENT PRIMARY KEY,
nome                 CHAR(100)  not null,
cpf                  CHAR(11)   not null,
data_nascimento      CHAR(10)   not null,
senha                CHAR(50)   not null,
email                CHAR(100)  not null
);

create table produto (
id_produto           INTEGER AUTO_INCREMENT PRIMARY KEY,
id_vendedor          INTEGER not null,
tipo_veiculo         CHAR(100)  not null,
descricao            VARCHAR(1000)  not null,
quilometragem        CHAR(100)  not null,
cor                  CHAR(100)  not null,
preco                CHAR(100)  not null,
foto                 CHAR(100)  not null
);

create table contato (
id_contato           INTEGER AUTO_INCREMENT PRIMARY KEY,
id_produto           INTEGER not null,
id_vendedor          INTEGER not null,
id_comprador         INTEGER not null
);

create table chat (
id_chat              INTEGER AUTO_INCREMENT PRIMARY KEY,
id_contato           INTEGER not null,
remetente            CHAR(100) not null,
mensagem             CHAR(255)
);

alter table produto add constraint fk_vendedor_prod 
foreign key (id_vendedor) references cadastro (id_cadastro) on delete cascade;

alter table contato add constraint fk_produto
foreign key (id_produto) references produto (id_produto) on delete cascade;

alter table contato add constraint fk_vendedor 
foreign key (id_vendedor) references cadastro (id_cadastro) on delete cascade;

alter table contato add constraint fk_comprador 
foreign key (id_comprador) references cadastro (id_cadastro) on delete cascade;

alter table chat add constraint fk_contato
foreign key (id_contato) references contato (id_contato) on delete cascade;
