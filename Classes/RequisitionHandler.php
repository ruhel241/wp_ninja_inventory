<?php

 namespace NinjaInventory\Classes; 

class RequisitionHandler 
{
	
	public static function requisitionDB()
	{
		
		global $wpdb;
			
			$charset_collate = $wpdb->get_charset_collate();
			$table_name = "wp_inventory_requisition_table";
			$sql = "CREATE TABLE $table_name (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`title` varchar(55) NULL,
			`description` text NOT NULL,
			`userId` text NOT NULL,
			`requisition_products` varchar(55) NULL,
			`total_products` int(50) NUll,
			`date` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			PRIMARY KEY  (id)
			) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

		// global $wpdb, $table_prefix,$table_name;
		
		// if( count($wpdb->get_var("SHOW TABLES LIKE wp_inventory_requisition_table")) == 0 ){
		// 	$charset_collate = $wpdb->get_charset_collate();
		// 	$sql = "CREATE TABLE `wp_inventory_requisition_table` (
		// 	id int(11) NOT NULL AUTO_INCREMENT,
		// 	title varchar(250) NULL,
		// 	description varchar(250) NULL,
		// 	userId int(50) NULL,
		// 	requisition_products text NULL,
		// 	total_products varchar(250) NULL, 
		// 	date DATETIME,
		// 	PRIMARY KEY  (id)
		// 	) $charset_collate;";

		// 	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		// 	dbDelta( $sql );
		// }
}




	public static function deactiveDBTable()
	{
		global $wpdb;
		$wpdb->query("DROP table IF Exists wp_inventory_requisition_table ");

	}



	public static function handleAjaxCalls()
	{
		$route = sanitize_text_field($_REQUEST['route'] );

		if( $route == 'add_requisition' ){
			$tableTitle    = sanitize_text_field($_REQUEST['name']);
			$description   = sanitize_text_field($_REQUEST['description']);
			$totalProducts = wp_unslash($_REQUEST['totalProducts']);
			static::addRequisition($tableTitle, $description, $totalProducts);
		}

		if( $route == 'get_requisitions'){
			$pageNumber = intval($_REQUEST['page_number']);
			$perPage 	= intval($_REQUEST['per_page']);
			static::getRequisitions($pageNumber, $perPage);
		}

	}


	public static function addRequisition($tableTitle, $description, $totalProducts)
	{
		global $wpdb;
		
		$addRequisition = array(
			'name'		   		   => $tableTitle,
			'description'   	   => $description,
			'requisition_products' =>  maybe_serialize($totalProducts),
			'date' 				   => date('Y-m-d H:i:s', current_time('timestamp', 1))
		);

		$table = 'wp_inventory_requisition_table';
		$data = $addRequisition;
		$format = array('%s','%s','%d','%s','%s');
		$requisitionSuccess = $wpdb->insert($table, $data, $format);
		// $requisitionID = $wpdb->insert_id;

		wp_send_json_error(array(
			'message' => $requisitionSuccess
		), 423);


	}



	public static function getRequisitions($pageNumber = 1, $perPage = 10)
	{
		// $offset = ($pageNumber - 1 ) * $perPage;
		// $tables = get_posts(array(
		// 	'post_type' 	 => CPT::$CPTName,
		// 	'offset' 		 => $offset,
		// 	'posts_per_page' => $perPage
		// ));

		// $totalCount = wp_count_posts(CPT::$CPTName);
		// $formattedTables = array();
		// foreach ($tables as $table) {
		// 	$formattedTables[] = array(
  //               'ID'         	   => $table->ID,
  //               'product_name' 	   => $table->post_title,
		// 		'description'  	   => $table->post_content,
		// 		'quantity'  	   => $table->post_excerpt,
		// 		'date'  	 	   => $table->post_date
  //               // 'demo_url'	   	   => home_url().'?ninja_inventory_preview='.$table->ID.'#ninja_inventory_demo',
  //               // 'defaultImage'	   => NINJA_INVENTORY_PLUGIN_DIR_URL.'img/default-image.jpg'
  //           );
		// }
		// wp_send_json_success(array(
		// 	'tables' => $formattedTables,
		// 	'total'  => intval($totalCount->publish)
		// ), 200);
	}



}