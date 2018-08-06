<?php

defined('ABSPATH') or die;
/*
Plugin Name: WP Ninja Gallery
Description: The Best WP Ninja Gallery Plugin for WordPress
Version: 1.0.0
Author: WPManageNinja
Author URI: https://wpmanageninja.com
Plugin URI: https://wpmanageninja.com/products/ninja-mortgage-calculator-plugin
License: GPLv2 or later
Text Domain: ninja_gallery
Domain Path: /languages
*/

include "load.php";
define("NINJA_GALLERY_PLUGIN_DIR_URL", plugin_dir_url(__FILE__));
define("NINJA_GALLERY_PUBLIC_DIR_URL", NINJA_GALLERY_PLUGIN_DIR_URL.'public/');
define("NINJA_GALLERY_PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
define("NINJA_GALLERY_PLUGIN_DIR_VERSION", 1.00);


class WPNinjaGallery
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
		add_action('init', array('NinjaGallery\Classes\CPT','register'));
		add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));
		add_shortcode('ninja_gallery', array('NinjaGallery\Classes\GalleryHandler','handleShortCode') );
	}


	public function adminHooks()
	{
		add_action('admin_menu', array('NinjaGallery\Classes\Menu','addAdminMenuPages'));
		add_action('wp_ajax_ninja_gallery_ajax_actions', array('NinjaGallery\Classes\GalleryHandler','handleAjaxCalls'));
		add_action('admin_enqueue_scripts', array($this, 'adminEnqueueScripts'));
		add_action('ninja_gallery_added_new_table', array('NinjaGallery\Classes\GalleryHandler','populateDemoData') );
	}


	public function publicHooks()
	{
		add_action('init', array('NinjaGallery\Classes\ProcessDemoPage','demoPageDisplay') );
		
	}


	public function enqueueScripts()
	{
		

	}


	public function adminEnqueueScripts()
	{
		if ( function_exists( 'wp_enqueue_editor' ) ) {
			wp_enqueue_editor();
			wp_enqueue_media();
		}
	}




	public function loadTextDomain()
	{
		
	}

}

add_action('plugins_loaded', function() {
	$wpNinjaGallery = new WPNinjaGallery();
	$wpNinjaGallery->boot();
});

