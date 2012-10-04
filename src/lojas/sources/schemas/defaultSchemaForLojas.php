<?php

$lojas = "CREATE TABLE IF NOT EXISTS lojas (
                id int unsigned auto_increment primary key,
                nome varchar(255),
                endereco varchar(255),
                cidade varchar(255),
                telefone varchar(255),
                farmacia_popular varchar(255)
)";

mysql_query($lojas) or die(mysql_error());

$popularTabela = "insert into lojas set nome='teste', endereco='teste', cidade='teste', telefone='11111111', farmacia_popular='nao'";
for($cont = 0; $cont < 10; $cont++)
{
    //mysql_query($popularTabela);
}
