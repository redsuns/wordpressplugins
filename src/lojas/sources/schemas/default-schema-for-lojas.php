<?php
/**
 * Schema para o plugin Lojas
 * @version 2.1
 * @since 2.0
 */

$lojas = "CREATE TABLE IF NOT EXISTS lojas (
                id int unsigned auto_increment primary key,
                nome varchar(255) COLLATE utf8_unicode_ci,
                endereco varchar(255) COLLATE utf8_unicode_ci,
                horario_funcionamento varchar(100) COLLATE utf8_unicode_ci,
                cidade varchar(255) COLLATE utf8_unicode_ci,
                telefone varchar(255) COLLATE utf8_unicode_ci,
                farmacia_popular varchar(255) COLLATE utf8_unicode_ci
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_c";

mysql_query($lojas) or die(mysql_error());
/*
$popularTabela = "insert into lojas set nome='teste', endereco='teste', cidade='teste', telefone='11111111', farmacia_popular='nao'";
for($cont = 0; $cont < 10; $cont++)
{
    mysql_query($popularTabela);
}
*/