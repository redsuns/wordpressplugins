<?php 

/*
 * Plugin Name: Perguntas e respostas
 * Description: O plugin Perguntas e respostas facilita o cadastro de perguntas frequentes em seu Blog/Site
 * Author: Redsuns Design e Tecnologia Web
 * Author URI: http://www.redsuns.com.br
 * Date: 2012-10-04
 * Version: 1.0
 */


function menuFAQ()
{
	add_menu_page('Perguntas e respostas', 'Perguntas e respostas', 7, 'faq/perguntas.php','','../wp-content/plugins/faq/sources/images/question.png');
    add_submenu_page('faq/perguntas.php', 'Nova pegunta','Nova pergunta', 7, 'faq/nova-pergunta.php');
}

// adding menu
add_action('admin_menu', 'menuFAQ');

include_once 'sources/schemas/default-schema-for-faq.php';

$url = get_bloginfo('url');
$themePath = str_replace($url,'..',get_bloginfo('template_url'));

if(!file_exists($themePath.'/page-faq.php'))
{
	@copy('../wp-content/plugins/faq/theme-pages/page-faq.php',$themePath.'/page-faq.php');
}

?>