<?php
/**
 * Schema para o plugin Parceiros
 * @version 2.1
 * @since 2.0
 */
$parceiros = "CREATE TABLE IF NOT EXISTS parceiros (
                id int unsigned auto_increment primary key,
                nome varchar(255),
                url varchar(255),
                imagem text
)";

@mysql_query($parceiros);

$popularTabela = "insert into parceiros set nome='teste', url='http://redsuns.com.br', imagem=''";
for($cont = 0; $cont < 10; $cont++)
{
    //mysql_query($popularTabela);
}
