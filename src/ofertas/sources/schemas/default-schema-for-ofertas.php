<?php

$ofertas = "CREATE TABLE IF NOT EXISTS ofertas (
                id int unsigned auto_increment primary key,
                mes varchar(255) COLLATE utf8_unicode_ci,
                ciclo varchar(255) COLLATE utf8_unicode_ci,
                ativa int(1),
                data_cadastro timestamp
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

@mysql_query($ofertas);

$imagens = "CREATE TABLE IF NOT EXISTS imagens_ofertas (
				id int unsigned auto_increment primary key,
				id_oferta int unsigned,
				imagem text 
				)";
@mysql_query($imagens);

$popularTabela = "insert into ofertas set mes='Setembro', ciclo='2', data_cadastro='2012-09-28'";

for($cont = 0; $cont < 10; $cont++)
{
    //mysql_query($popularTabela);
}
