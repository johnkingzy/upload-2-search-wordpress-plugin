<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com
 * @since      1.0.0
 *
 * @package    Upload_2_Search
 * @subpackage Upload_2_Search/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Upload_2_Search
 * @subpackage Upload_2_Search/admin
 * @author     Raj Sumith <email>
 */
class Upload_2_Search_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Upload_2_Search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Upload_2_Search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/upload-2-search-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Upload_2_Search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Upload_2_Search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/upload-2-search-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function add_plugin_menu() {
		add_menu_page('Upload 2 Search', 'Upload 2 Search', 'manage_options', 'upload_excel', array($this, 'admin_index'));
	}

	public function admin_index() {
		require_once plugin_dir_path(__FILE__ ) . 'partials/upload-2-search-admin-display.php';
	}
}
