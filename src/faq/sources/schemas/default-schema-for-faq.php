<?php
/**
 * Schema para o plugin Perguntas e respostas
 * @version 1.0
 * @since 1.0
 */

$faq = "CREATE TABLE IF NOT EXISTS `rs_faq` (
                `id` INT UNSIGNED AUTO_INCREMENT,
                `pergunta` VARCHAR(255) COLLATE utf8_unicode_ci,
                `solucao` TEXT COLLATE utf8_unicode_ci,
                `imagem` VARCHAR(255) COLLATE utf8_unicode_ci, 
                PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

@mysql_query($faq);

$popularTabela = "insert into rs_faq set pergunta='teste', solucao='esta é a solução', imagem=''";
for($cont = 0; $cont < 10; $cont++)
{
    //mysql_query($popularTabela) or die(mysql_error()); 
}

//$limparTabela = "delete from rs_faq";
//@mysql_query($limparTabela);
