<?php 

/*
 * Plugin Name: Ofertas
 * Description: Adiciona menus de ofertas
 * Author: Redsuns Design e Tecnologia Web
 * Author URI: http://www.redsuns.com.br
 * Date: 2012-10-02
 * Version: 1.0
 */


function menuOfertas()
{
	add_menu_page('Ofertas', 'Ofertas', 7, 'ofertas/ofertas.php','','../wp-content/plugins/ofertas/sources/imagens/oferta.png');
    add_submenu_page('ofertas/ofertas.php', 'Nova oferta','Nova oferta', 7, 'ofertas/nova-oferta.php');
}

// adding menu
add_action('admin_menu', 'menuOfertas');

include_once 'sources/schemas/default-schema-for-ofertas.php';

wp_enqueue_script('javascript','/wp-content/plugins/ofertas/sources/js/jquery.fancybox-1.3.4/jquery-1.4.3.min.js');
wp_enqueue_script('javascript','/wp-content/plugins/ofertas/sources/js/jquery.fancybox-1.3.4/fancybox/jquery.mousewheel-3.0.4.pack.js');
wp_enqueue_script('javascript','/wp-content/plugins/ofertas/sources/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js');
wp_enqueue_script('javascript','/wp-content/plugins/ofertas/sources/js/functions-ofertas.js');
?>
<link rel="stylesheet" type="text/css" href="../wp-content/plugins/ofertas/sources/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<?php
$url = get_bloginfo('url');
$themePath = str_replace($url,'..',get_bloginfo('template_url'));

if(!file_exists($themePath.'/page-ofertas.php'))
{
	@copy('../wp-content/plugins/ofertas/theme-pages/page-ofertas.php',$themePath.'/page-ofertas.php');
}

?>