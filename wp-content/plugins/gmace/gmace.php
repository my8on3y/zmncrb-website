<?php
/*
    Plugin Name: GMAce
    Plugin URI: http://wordpress.org/plugins/gmace/
    Description: Free PHP-editor code Wordpress. A variety of themes, syntax highlighting and a built file manager
    Version: 1.5.2
    Author: German Mesky
    Author URI: http://vk.com/dr.gmes
*/
define('GMACE_DIR', plugin_dir_path(__FILE__));
define('GMACE_URL', plugin_dir_url(__FILE__));
define('GMACEPATH', ABSPATH);



if($_GET['gm-download-file'])
{
	include(ABSPATH . "/wp-includes/pluggable.php");
	include(GMACE_DIR . "inc/download-manager.php");
}



function gmace_init()
{
	if(!$_POST)
	{
		include(GMACE_DIR . "inc/filemanager.php");
	}

	if(file_exists(GMACE_DIR . "/inc/tmpflag")) unlink(GMACE_DIR . "/inc/tmpflag");
}
add_action('plugins_loaded', 'gmace_init');



function gmace_add_to_menu()
{
	if(!is_user_logged_in() || !current_user_can('administrator'))
	{
		return;
	}
	
	$page = add_menu_page("GMAce Editor", "GMAce", 8, "gmace-editor", "gmace_spread_page", "dashicons-editor-code");
	add_action('admin_print_scripts-'.$page, 'gmace_enqueue_script');
	
}
add_action('admin_menu', 'gmace_add_to_menu');



function gmace_enqueue_script()
{
	if(!is_user_logged_in() || !current_user_can('administrator'))
	{
		return;
	}
	
	wp_enqueue_script("jquery-ui-core");
	
	wp_enqueue_script('gmace-emmet-core', GMACE_URL ."/assets/js/emmet.js");
	wp_enqueue_script('gmace-ace-js', GMACE_URL ."/assets/js/ace/ace.js");
	wp_enqueue_script('gmace-ace-emmet', GMACE_URL ."/assets/js/ace/ext-emmet.js");
	wp_enqueue_script('gmace-ace-statusbar', GMACE_URL ."/assets/js/ace/ext-statusbar.js");
	wp_enqueue_script('gmace-ace-language_tools', GMACE_URL ."/assets/js/ace/ext-language_tools.js");

	wp_enqueue_script('gmace-js-completion', GMACE_URL ."/assets/js/autocomplete/javascript.js");
	wp_enqueue_script('gmace-wp-completion', GMACE_URL ."/assets/js/autocomplete/wordpress.js");
	wp_enqueue_script('gmace-php-completion', GMACE_URL ."/assets/js/autocomplete/php.js");

	wp_enqueue_script('gmace-head-js', GMACE_URL ."/assets/js/scripts.js", array('jquery'));
	
	wp_enqueue_style('gmace-head-styles', GMACE_URL . "/assets/css/style.css");
	wp_enqueue_style('gmace-fontawesome', "http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css", "1.0");
}



function gmace_spread_page()
{
	global $wpdb, $_GMACE_CCS;

	include(GMACE_DIR . "inc/code-completer-array.php");
	include(GMACE_DIR."inc/editor.php");
}



function gmace_manager_client()
{
	include_once(GMACE_DIR . "inc/filemanager.php");

	gmace_manager_server($_POST['_op']);
}
add_action('wp_ajax_gmace_manager', 'gmace_manager_client');
?>