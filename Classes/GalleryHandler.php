<?php namespace NinjaGallery\Classes;


class GalleryHandler
{
	
	public static function handleAjaxCalls()
	{
		$route = sanitize_text_field($_REQUEST['route'] );

		if( $route == 'add_table' ){
			$tableTitle = sanitize_text_field($_REQUEST['post_title']);
			$galleryType = sanitize_text_field($_REQUEST['gallery_type']);
			static::addTable($tableTitle, $galleryType);
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

			$galleryType = sanitize_text_field($_REQUEST['gallery_type']); 
			static::updateTableConfig($tableId, $table_config, $galleryType);
        }


        if ( $route == 'delete_table' ) {
            $tableId = intval($_REQUEST['table_id']);
            static::deleteTable($tableId);
        }
	}



	public static function handleShortCode($atts)
	{
		$defaults = apply_filters('ninja_gallery_shortcode_default', array(
			'id' => null
		));
		$attributes = shortcode_atts($defaults, $atts);
		$tableId    = $attributes['id'];
		$post 	    = get_post($tableId);
		$galleryMetaData = get_post_meta($tableId, '_ninija_gallery_table_config', true);
		wp_enqueue_script('ninja_gallery_user_view', NINJA_GALLERY_PUBLIC_DIR_URL.'js/ninja_gallery_user_view.js', array('jquery'), NINJA_GALLERY_PLUGIN_DIR_VERSION, true);
		wp_localize_script('ninja_gallery_user_view','galleryMetaDataVars', array(
			'post' 			=> $post,
			'galleryMetaData'=> $galleryMetaData
		));
		return "<div id='wp_ninja_gallery'></div>";
	}


	public static function addTable($tableTitle, $galleryType)
	{	
		
		if( ! $tableTitle ){
			wp_send_json_error(array(
				'message' => __("Please Provide Table Title", "ninja_gallery")
			), 423);
		}

		if( ! $galleryType ){
			wp_send_json_error(array(
				'message' => __("Please Select gallery Type", 'ninja_gallery')
			), 423);
		}


		$tableData = array(
			'post_title'   => $tableTitle,
			'post_content' => $galleryType,
			'post_type'	   => CPT::$CPTName,
			'post_status'  => 'publish'
		);

		$tableId = wp_insert_post($tableData);

		do_action('ninja_gallery_added_new_table', $tableId); 

		if(is_wp_error($tableId)){
			wp_send_json_error(array(
				'message' => $tableId->get_error_message()
			), 423);
		}

		 wp_send_json_success(array(
            'message'  => __('Table Successfully created','ninja_gallery'),
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
                'post_title' 	   => $table->post_title,
                'gallery_type'	   => $table->post_content,
                'tableConfig' 	   => get_post_meta($table->ID,'_ninija_gallery_table_config', true),
                'demo_url'	   	   => home_url().'?ninja_gallery_preview='.$table->ID.'#ninja_gallery_demo',
                'defaultImage'	   => ninja_gallery_PUBLIC_DIR_URL.'img/default-image.jpg'
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
		$tableConfig = get_post_meta($tableId, '_ninija_gallery_table_config', true);

		$formattedTable = (object)array(
			'ID' 		 	   => $table->ID,
			'post_title' 	   => $table->post_title,
			'gallery_type'	   => $table->post_content
		);
		
		wp_send_json_success(array(
            'table'        => $formattedTable,
            'tableConfig'  => $tableConfig,
            //'demogalleryConfig' => static::getgalleryConfig(),
            'demo_url' => home_url().'?ninja_gallery_preview='.$tableId.'#ninja_gallery_demo'
        ), 200);
	}



	public function deleteTable($tableId)
	{	
		delete_post_meta($tableId, '_ninija_gallery_table_config');	
		wp_delete_post($tableId);
		wp_send_json_success(array(
		  'message' => __('The Table successfully deleted!', 'ninja_gallery')
		),200);
	}



	public function updateTableConfig($tableId, $table_config, $galleryType)
	{
		
		$UpdateNinjagallery = array(
	      'ID'           => $tableId,
	      'post_content' => $galleryType,
	    );
		wp_update_post($UpdateNinjagallery);

		update_post_meta($tableId, '_ninija_gallery_table_config', $table_config);

		do_action('ninija_gallery_table_config_updated', $tableId, $table_config);
		$tableConfig = get_post_meta($tableId, '_ninija_gallery_table_config', true);
		wp_send_json_success(array(
            'message' => __('Table Content has been updated', 'ninja_gallery'),
            'tableConfig' => $tableConfig,
        ), 200);


	}


	public static function populateDemoData($tableId) //add meta label etc
    {
        //update_post_meta($tableId, '_ninija_gallery_table_config', static::getGalleryConfig());
    }

    public static function getGalleryConfig()
	{
		return array(
			
            'ingredient'  => 'ami bala asi',
            'description' => 'tmi vala aso ni',
            'nutrition'	  => 'oy vala asi'
	           
			);
	}




}




