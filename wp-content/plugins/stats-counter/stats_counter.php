<?php
/*
Plugin Name: Stats Counter
Plugin URI: http://www.wpadm.com
Description: Visitors statistics by Stats Counter!
Version: 1.2.2.5
Author: WPAdm.com
Author URI: http://www.wpadm.com
*/

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'wpadm-class-wp.php';

require_once dirname(__FILE__) . '/class-wpadm-method-class.php';
require_once dirname(__FILE__) . '/methods/class-wpadm-method-stat.php';

add_action('init', 'wpadm_stat_run');
//register_activation_hook( __FILE__, 'wpadm_stat_activate' );

////register_deactivation_hook(  dirname(__FILE__) .  DIRECTORY_SEPARATOR . 'wpadm.php', 'wpadm_deactivation' );

register_uninstall_hook(  __FILE__, 'wpadm_stat_uninstall' );

add_action('admin_print_scripts', array('wpadm_wp_stat', 'include_admins_script' ));
add_action('admin_print_styles', array('wpadm_wp_stat',"adding_files_style") );   
add_action('admin_print_scripts', array('wpadm_wp_stat', "adding_files_script") );
add_action('admin_menu', array('wpadm_wp_stat', 'draw_menu'));

register_activation_hook( __FILE__, array('wpadm_wp_stat','on_activate'));
register_deactivation_hook( __FILE__, array('wpadm_wp_stat','on_deactivate'));
add_action('widgets_init', array('wpadm_wp_stat', 'widgets_initial') );
add_action('init', array('wpadm_wp_stat', 'initWidget'));
add_action( 'wp_footer', array("wpadm_wp_stat", "addFooter") );
add_action('admin_notices', array("wpadm_wp_stat", 'install_template_notice') );

add_filter('plugin_action_links', array('wpadm_wp_stat', 'manage_link'), 10, 2);


if (!function_exists('wpadm_debug')) {
    function wpadm_debug($msg)
    {
        file_put_contents(ABSPATH . "debug_plugin.log", "$msg\r\n", FILE_APPEND);
    }
}



if (!function_exists('wpadm_stat_run')) {
    function wpadm_stat_run()
    {
        require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'wpadm.php';
        wpadm_run('stat', dirname(__FILE__));
    }
}

if ( ! function_exists( 'wpadm_add_my_js' )) {
    /**
    * Adds to the page javascript to calculate statistics
    * @param string $content
    * @return string
    */
    function wpadm_add_my_js( $content ) {
        if (isset($_GET['wpadm_img_stat']) || WPAdm_Method_Stat::getJsHasBeen()) {
            return $content;
        }

        $js  = WPAdm_Method_Stat::generate_js_for_page();
        return $content . $js;
    }
}

if(! function_exists('wpadm_stat_activate')) {
    function wpadm_stat_activate()
    {
        wpadm_activation();
        // Create/update the table to gather statistics
        wpadm_stat_make_tables();
    }
}


if ( ! function_exists('wpadm_stat_make_tables')) {
    function wpadm_stat_make_tables() {
        /* global $wpdb;
        $table_name = $wpdb->prefix . "wpadm_stat";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
        $sql = "CREATE TABLE `{$table_name}` (
        `id` int(11) NOT NULL auto_increment,
        `dt` datetime default NULL,
        `type` varchar(100) default NULL,
        `value` text,
        `url` text,
        `request` text,
        `cookie_stat_id` text,
        `dt_day` text,
        PRIMARY KEY  (`id`),
        FULLTEXT KEY `type` (`type`,`cookie_stat_id`)
        ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
        ";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        } */

    }
}


if (!file_exists('wpadm_stat_uninstall') ) {
    function wpadm_stat_uninstall()
    {
        //remove the table statistics
        /*
        global $wpdb;
        $table_name = $wpdb->prefix . "wpadm_stat";
        $wpdb->query("DROP TABLE IF EXISTS {$table_name}");
        */
    }
}



