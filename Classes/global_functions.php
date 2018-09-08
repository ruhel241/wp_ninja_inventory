<?php



function custom_plugin_use_test()
{
	
	global $wpdb;
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


	$charset_collate = $wpdb->get_charset_collate();

	if( count($wpdb->get_var('SHOW TABLES LIKE "wp_active_ruhel_test"')) == 0 ){
		$sql = "CREATE TABLE `wp_active_ruhel_test` (
		 `id` int(11) NOT NULL,
		 `name` int(11) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		dbDelta( $sql );
	}



}

register_activation_hook( __FILE__, 'custom_plugin_use_test');



function deactive_table_test()
{

	global $wpdb;

	$wpdb->query("DROP table IF Exists wp_active_ruhel_test ");
}

register_uninstall_hook(__FILE__, 'deactive_table_test');
// register_deactivation_hook(__FILE__, 'deactive_table');


