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
		`description` varchar(55) NULL,
		`userId` int(11) NULL,
		`requisition_products` text NULL,
		`total_products` int(11) NUll,
		`date` datetime DEFAULT '0000-00-00 00:00:00' NULL,
		PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
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
			$title    			  = sanitize_text_field($_REQUEST['title']);
			$description  		  = sanitize_text_field($_REQUEST['description']);
			$requisition_products = wp_unslash($_REQUEST['requisition_products']);
			$total_products 	  = intval($_REQUEST['total_products']);
			static::addRequisition($title, $description, $requisition_products, $total_products);
		}

		if( $route == 'get_requisitions'){
			// $pageNumber = intval($_REQUEST['page_number']);
			// $perPage 	= intval($_REQUEST['per_page']);
			static::getRequisitions();
		}


		if($route == 'delete_requisition'){
			$id = intval($_REQUEST['requisitionId']);
			static::deleteRequisition($id);
		}



	}


	public static function addRequisition($title, $description, $requisition_products, $total_products)
	{
		
		global $wpdb;
					
		$addRequisition = array(
			'title'		   		   => $title,
			'description'   	   => $description,
			'userId'   	  		   => 1,
			'requisition_products' =>  maybe_serialize($requisition_products),
			'total_products'	   =>  $total_products,
			'date' 				   => date('Y-m-d H:i:s', current_time('timestamp', 1))
		);

		$table = 'wp_inventory_requisition_table';
		$data = $addRequisition;
		$requisitionSuccess = $wpdb->insert($table, $data);
		$requisitionID 		= $wpdb->insert_id;

		wp_send_json_success(array(
			'message'  => __('Product Successfully created','ninja_inventory'),
            'table_id' => $requisitionID
		), 200);


	}



	public static function getRequisitions()
	{
		global $wpdb;

		$requisitions = $wpdb->get_results( "SELECT * FROM wp_inventory_requisition_table" );

		// $offset = ($pageNumber - 1 ) * $perPage;
		// $tables = get_posts(array(
		// 	'post_type' 	 => CPT::$CPTName,
		// 	'offset' 		 => $offset,
		// 	'posts_per_page' => $perPage
		// ));

		// $totalCount = wp_count_posts(CPT::$CPTName);
		$requisitionsTable = array();
		foreach ($requisitions as $requisition) {
			$requisitionsTable[] = array(
                'id'         	  	   => $requisition->id,
                'title' 	  	  	   => $requisition->title,
				'description'  	  	   => $requisition->description,
				'userId'  	   	       => $requisition->userId,
				'requisition_products' => maybe_unserialize($requisition->requisition_products),
				'total_products'  	   => $requisition->total_products,
				'date'  	 	   	   => $requisition->date
                // 'demo_url'	   	   => home_url().'?ninja_inventory_preview='.$table->ID.'#ninja_inventory_demo',
                // 'defaultImage'	   => NINJA_INVENTORY_PLUGIN_DIR_URL.'img/default-image.jpg'
            );
		}

		wp_send_json_success(array(
			'allRequisitions' => $requisitionsTable,
			// 'total'  => intval($totalCount->publish)
		), 200);
	}





	public static function deleteRequisition($id)
	{	
		
		global $wpdb;
		$table_name = "wp_inventory_requisition_table";
		$wpdb->delete( $table_name, ['id'=> $id] );
	
		wp_send_json_success(array(
			'message' => __("The Table successfully deleted", 'ninja_inventory'),
		), 200);
	}




}