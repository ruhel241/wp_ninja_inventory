<?php  

	namespace NinjaInventory\Classes; 

class Menu
{

	public static function addAdminMenuPages() 
	{
	 	add_menu_page(
            __( 'Inventory Management', 'ninja_inventory' ),
            __( 'Inventory Management', 'ninja_inventory' ),
            static::managePermission(),
            'wp-ninja-inventory.php',
            array( static::class, 'renderInventory'),
            '',
            6
        );
	}

	public static function managePermission()
	{	
		return apply_filters('ninja_inventory_menu_manager_permission','manage_options');
	}


	public static function renderInventory()
	{
		
		wp_enqueue_script('wp_ninja_inventory_js',  NINJA_INVENTORY_PUBLIC_DIR_URL.'js/wp_ninja_inventory.js', array('jquery'), NINJA_INVENTORY_PLUGIN_DIR_VERSION, true);
		include NINJA_INVENTORY_PLUGIN_DIR_PATH.'views/admin_view.php';

	}

}

 

