<?php 

/*
 * Plugin Name: Lojas
 * Description: O plugin Lojas facilita o cadastro de suas lojas físicas em seu Blog/Site
 * Author: Redsuns Design e Tecnologia Web
 * Author URI: http://www.redsuns.com.br
 * Date: 2012-09-27
 * Version: 1.1
 */


function menuLojas()
{
	add_menu_page('Lojas', 'Lojas', 7, 'Lojas/Lojas.php','','../wp-content/plugins/Lojas/Sources/Images/Lojas.png');
    add_submenu_page('Lojas/Lojas.php', 'Nova loja','Nova loja', 7, 'Lojas/NovaLoja.php');
}

// adding menu
add_action('admin_menu', 'menuLojas');

include_once 'Sources/Schemas/DefaultSchemaForLojas.php';

$url = get_bloginfo('url');
$themePath = str_replace($url,'..',get_bloginfo('template_url'));

if(!file_exists($themePath.'/page-lojas.php'))
{
	@copy('../wp-content/plugins/Lojas/ThemePages/PageLojas.php',$themePath.'/page-lojas.php');
}

?>