<?php

 namespace NinjaInventory\Classes; 

class RequisitionHandler 
{
	
	public static function requisitionDB()
	{
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		
		$charset_collate = $wpdb->get_charset_collate();

		if( count($wpdb->get_var('SHOW TABLES LIKE "wp_inventory_requisition_table"')) == 0 ){
			$sql = "CREATE TABLE `wp_inventory_requisition_table` (
			 `id` int(11) NOT NULL,
			 `name` varchar(250) NULL,
			 `description` varchar(250) NULL,
			 `requisition_products` text NULL
			) ENGINE=InnoDB DEFAULT CHARSET=latin1";

			dbDelta( $sql );
		}
	}




	public static function deactiveDBTable()
	{
		global $wpdb;
		$wpdb->query("DROP table IF Exists wp_inventory_requisition_table ");

	}



	public static function handleAjaxCalls()
	{
		$route = sanitize_text_field($_REQUEST['route'] );

		// if( $route == 'get_tables'){
		// 	$pageNumber = intval($_REQUEST['page_number']);
		// 	$perPage 	= intval($_REQUEST['per_page']);
		// 	static::getTables($pageNumber, $perPage);
		// }

	}



}