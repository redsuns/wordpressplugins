<?php 

/*
 * Plugin Name: Parceiros
 * Description: O plugin Parceiros facilita o cadastro de seus parceiros, convênios e clientes em seu Blog/Site
 * Author: Redsuns Design e Tecnologia Web
 * Author URI: http://www.redsuns.com.br
 * Date: 2012-09-28
 * Version: 2.1
 */


function menuParceiros()
{
	add_menu_page('Parceiros', 'Parceiros', 7, 'parceiros/parceiros.php','','../wp-content/plugins/parceiros/sources/images/Parceiros.png');
    add_submenu_page('parceiros/parceiros.php', 'Novo parceiro','Novo parceiro', 7, 'parceiros/novo-parceiro.php');
}

// adding menu
add_action('admin_menu', 'menuParceiros');

include_once 'sources/schemas/default-schema-for-parceiros.php';
$url = get_bloginfo('url');
$themePath = str_replace($url,'..',get_bloginfo('template_url'));

if(!file_exists($themePath.'/page-parceiros.php'))
{
	@copy('../wp-content/plugins/parceiros/theme-pages/page-parceiros.php',$themePath.'/page-parceiros.php');
}
?>