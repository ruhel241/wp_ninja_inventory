<?php

defined('ABSPATH') or die;
/*
Plugin Name:  Inventory Management Software
Description: The Best Inventory Management Software Plugin for WordPress
Version: 1.0.0
Author: Ruhel Khan
Author URI: https://ruhel.com
Plugin URI: https://ruhel.com/products/inventory-management-software
License: GPLv2 or later
Text Domain: ninja_inventory
Domain Path: /languages
*/

include "load.php";
define("NINJA_INVENTORY_PLUGIN_DIR_URL", plugin_dir_url(__FILE__));
define("NINJA_INVENTORY_PUBLIC_DIR_URL", NINJA_INVENTORY_PLUGIN_DIR_URL.'public/');
define("NINJA_INVENTORY_PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
define("NINJA_INVENTORY_PLUGIN_DIR_VERSION", 1.00);

// function activate_inventory_rquisition()
// {
//     require_once plugin_dir_path(__FILE__).'includes/NinjaTablesActivator.php';
//     \NinjaTables\Classes\NinjaTablesActivator::activate();
// }

// register_activation_hook(__FILE__, 'activate_inventory_rquisition');




class WPNinjaInventory
{
	
	public function boot()
	{
		$this->commonHooks();
		$this->adminHooks();
		
		
		$this->publicHooks();
		$this->loadTextDomain();
	}

	public function commonHooks()
	{	
		add_action('init', array('NinjaInventory\Classes\CPT','register'));
		add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));
		add_shortcode('ninja_inventory', array('NinjaInventory\Classes\InventoryHandler','handleShortCode') );
	
		
	}


	
	public function adminHooks()
	{
		add_action('admin_menu', array('NinjaInventory\Classes\Menu','addAdminMenuPages'));
		add_action('wp_ajax_ninja_inventory_ajax_actions', array('NinjaInventory\Classes\InventoryHandler','handleAjaxCalls'));
		add_action('admin_enqueue_scripts', array($this, 'adminEnqueueScripts'));
		add_action('ninja_inventory_added_new_table', array('NinjaInventory\Classes\InventoryHandler','populateDemoData') );
	}


	public function publicHooks()
	{
		add_action('init', array('NinjaInventory\Classes\ProcessDemoPage','demoPageDisplay') );
		
	}


	public function enqueueScripts()
	{
		

	}


	public function adminEnqueueScripts()
	{
		// if ( function_exists( 'wp_enqueue_editor' ) ) {
		// 	wp_enqueue_editor();
		// 	wp_enqueue_media();
		// }
	}




	public function loadTextDomain()
	{
		
	}

}

add_action('plugins_loaded', function() {
	(new WPNinjaInventory)->boot();
});

