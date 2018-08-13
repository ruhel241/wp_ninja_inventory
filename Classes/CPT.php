<?php 

	namespace NinjaInventory\Classes; 

class CPT 
{	
	public static $CPTName = 'ninja_inventory_cpt';

	public static function register()
	{
		$cptArgs = array(
			'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => false,
            'show_in_menu'       => false,
            'query_var'          => false,
            'label'				 => __('Inventory Management', 'ninja_inventory')
		);
		register_post_type( self::$CPTName, $cptArgs );
	}
	
}





