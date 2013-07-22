<?php 

/*
 * Plugin Name: Destaques Home
 * Description: Adiciona possibilidade de alteração da imagem da home
 * Author: Redsuns Design e Tecnologia Web
 * Author URI: http://www.redsuns.com.br
 * Date: 2012-12-06
 * Version: 1.0
 */


function menuDestaque() {
	add_menu_page('Destaque home', 'Destaque home', 7, 'destaque-home/destaque.php','','../wp-content/plugins/destaque-home/sources/imagens/plugin-icon.png');
}

// adding menu
add_action('admin_menu', 'menuDestaque');

