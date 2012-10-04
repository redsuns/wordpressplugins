<?php 

/*
 * Plugin Name: Lojas
 * Description: Adiciona menus de lojas
 * Author: Redsuns Design e Tecnologia Web
 * Author URI: http://www.redsuns.com.br
 * Date: 2012-09-27
 * Version: 1.0
 */


function menuLojas()
{
	add_menu_page('Lojas', 'Lojas', 7, 'lojas/lojas.php','','../wp-content/plugins/lojas/sources/imagens/lojas.png');
    add_submenu_page('lojas/lojas.php', 'Nova loja','Nova loja', 7, 'lojas/nova-loja.php');
}

// adding menu
add_action('admin_menu', 'menuLojas');

include_once 'sources/schemas/defaultSchemaForLojas.php';

$url = get_bloginfo('url');
$themePath = str_replace($url,'..',get_bloginfo('template_url'));

if(!file_exists($themePath.'/page-lojas.php'))
{
	@copy('../wp-content/plugins/lojas/theme-pages/page-lojas.php',$themePath.'/page-lojas.php');
}

?>