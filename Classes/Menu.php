<?php  namespace NinjaGallery\Classes; 

class Menu
{

	public static function addAdminMenuPages() 
	{
	 	add_menu_page(
            __( 'WP Ninja Gallery', 'ninja_gallery' ),
            __( 'WP Ninja Gallery', 'ninja_gallery' ),
            static::managePermission(),
            'wp-ninja-gallery.php',
            array( static::class, 'renderGallery'),
            '',
            6
        );
	}

	public static function managePermission()
	{	
		return apply_filters('ninja_gallery_menu_manager_permission','manage_options');
	}


	public static function renderGallery()
	{
		// wp_enqueue_script('wp_ninja_gallery_js', NINJA_RECIPE_PUBLIC_DIR_URL.'js/wp_ninja_gallery.js', array('jquery'), NINJA_RECIPE_PLUGIN_DIR_VERSION, true);
		// include	NINJA_RECIPE_PLUGIN_DIR_PATH.'views/admin_view.php';

		echo "ruhel khan";
	}

}

 

