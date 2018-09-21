<?php 

	namespace NinjaInventory\Classes; 


class InventoryHandler
{
	
	public static function handleAjaxCalls()
	{
		$route = sanitize_text_field($_REQUEST['route'] );

		if( $route == 'add_table' ){
			$tableTitle  = sanitize_text_field($_REQUEST['product_name']);
			$description = sanitize_text_field($_REQUEST['description']);
			$quantity    = sanitize_text_field($_REQUEST['quantity']);
			static::addTable($tableTitle, $description, $quantity);
		}

		if ($route == 'get_table') {
            $tableId = intval($_REQUEST['table_id']);
            static::getTable($tableId, 'ajax');
        }

		if( $route == 'get_tables'){
			$pageNumber = intval($_REQUEST['page_number']);
			$perPage 	= intval($_REQUEST['per_page']);
			static::getTables($pageNumber, $perPage);
		}

        if ($route == 'update_table') {
            $tableId = intval($_REQUEST['table_id']);
            $table_con = wp_unslash($_REQUEST['table_config']);
			$table_config = json_decode(trim(stripslashes($table_con)), true);

			$inventoryType = sanitize_text_field($_REQUEST['inventory_type']); 
			static::updateTableConfig($tableId, $table_config, $inventoryType);
        }


        if ( $route == 'delete_table' ) {
            $tableId = intval($_REQUEST['table_id']);
            static::deleteTable($tableId);
        }
	}



	// public static function handleShortCode($atts)
	// {
	// 	$defaults = apply_filters('ninja_inventory_shortcode_default', array(
	// 		'id' => null
	// 	));
	// 	$attributes = shortcode_atts($defaults, $atts);
	// 	$tableId    = $attributes['id'];
	// 	$post 	    = get_post($tableId);
	// 	$inventoryMetaData = get_post_meta($tableId, '_ninija_inventory_table_config', true);
	// 	wp_enqueue_script('ninja_inventory_user_view', NINJA_INVENTORY_PUBLIC_DIR_URL.'js/ninja_inventory_user_view.js', array('jquery'), NINJA_INVENTORY_PLUGIN_DIR_VERSION, true);
	// 	wp_localize_script('ninja_inventory_user_view','inventoryMetaDataVars', array(
	// 		'post' 			=> $post,
	// 		'inventoryMetaData'=> $inventoryMetaData
	// 	));
	// 	return "<div id='wp_ninja_inventory'></div>";
	// }


	public static function addTable($tableTitle, $description, $quantity)
	{	
		if( ! $tableTitle ){
			wp_send_json_error(array(
				'message' => __("Please Provide Product Name", "ninja_inventory")
			), 423);
		}

		if( ! $description ){
			wp_send_json_error(array(
				'message' => __("Please Provide Your Description", 'ninja_inventory')
			), 423);
		}

		if( !$quantity ){
			wp_send_json_error( array(
				'message' => __("Please Provide Your Product Quantity", 'ninja_inventory')
			), 423 );
		}

		$tableData = array(
			'post_title'   => $tableTitle,
			'post_content' => $description,
			'post_excerpt'  => $quantity,
			'post_type'	   => CPT::$CPTName,
			'post_status'  => 'publish'
		);

		$tableId = wp_insert_post($tableData);

		do_action('ninja_inventory_added_new_table', $tableId); 

		if(is_wp_error($tableId)){
			wp_send_json_error(array(
				'message' => $tableId->get_error_message()
			), 423);
		}

		 wp_send_json_success(array(
            'message'  => __('Product Successfully created','ninja_inventory'),
            'table_id' => $tableId
        ), 200);

	}



	public static function getTables($pageNumber = 1, $perPage = 10)
	{
		
		$offset = ($pageNumber - 1 ) * $perPage;
		$tables = get_posts(array(
			'post_type' 	 => CPT::$CPTName,
			'offset' 		 => $offset,
			'posts_per_page' => $perPage
		));

		$totalCount = wp_count_posts(CPT::$CPTName);
		$formattedTables = array();
		foreach ($tables as $table) {
			$formattedTables[] = array(
                'ID'         	   => $table->ID,
                'product_name' 	   => $table->post_title,
				'description'  	   => $table->post_content,
				'quantity'  	   => $table->post_excerpt,
				'date'  	 	   => $table->post_date
                // 'demo_url'	   	   => home_url().'?ninja_inventory_preview='.$table->ID.'#ninja_inventory_demo',
                // 'defaultImage'	   => NINJA_INVENTORY_PLUGIN_DIR_URL.'img/default-image.jpg'
            );
		}

		wp_send_json_success(array(
			'tables' => $formattedTables,
			'total'  => intval($totalCount->publish)
		), 200);
	}


	public  static function getTable($tableId, $returnType = 'ajax')
	{
			
		$table = get_post($tableId);
		$tableConfig = get_post_meta($tableId, '_ninija_inventory_table_config', true);

		$formattedTable = (object)array(
			'ID' 		 	   => $table->ID,
			'post_title' 	   => $table->post_title,
			'inventory_type'	   => $table->post_content
		);
		
		wp_send_json_success(array(
            'table'        => $formattedTable,
            'tableConfig'  => $tableConfig,
            //'demoinventoryConfig' => static::getinventoryConfig(),
            'demo_url' => home_url().'?ninja_inventory_preview='.$tableId.'#ninja_inventory_demo'
        ), 200);
	}



	public static function deleteTable($tableId)
	{	
		delete_post_meta($tableId, '_ninija_inventory_table_config');	
		wp_delete_post($tableId);
		wp_send_json_success(array(
		  'message' => __('The Table successfully deleted!', 'ninja_inventory')
		),200);
	}



	public static function updateTableConfig($tableId, $table_config, $inventoryType)
	{
		
		$UpdateNinjainventory = array(
	      'ID'           => $tableId,
	      'post_content' => $inventoryType,
	    );
		wp_update_post($UpdateNinjainventory);

		update_post_meta($tableId, '_ninija_inventory_table_config', $table_config);

		do_action('ninija_inventory_table_config_updated', $tableId, $table_config);
		$tableConfig = get_post_meta($tableId, '_ninija_inventory_table_config', true);
		wp_send_json_success(array(
            'message' => __('Table Content has been updated', 'ninja_inventory'),
            'tableConfig' => $tableConfig,
        ), 200);


	}


	// public static function populateDemoData($tableId) //add meta label etc
 //    {
 //        //update_post_meta($tableId, '_ninija_inventory_table_config', static::getinventoryConfig());
 //    }

 //    public static function getinventoryConfig()
	// {
	// 	return array(
			
 //            'ingredient'  => 'ami bala asi',
 //            'description' => 'tmi vala aso ni',
 //            'nutrition'	  => 'oy vala asi'
	           
	// 		);
	// }




}




