<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://enfocandoelfuturo.com
 * @since      1.0.0
 *
 * @package    WP_AI_MANAGER
 * @subpackage WP_AI_MANAGER/includes
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @since      1.0.0
 * @package    WP_AI_MANAGER
 * @subpackage WP_AI_MANAGER/includes
 * @author     Miguel Angel Rubio <miguel@enfocandoelfuturo.com>
 */
class WP_AI_MANAGER_PUBLIC {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/plugin-name-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		if( get_option( 'gtm-active' ) && !empty( get_option( 'gtm-id' ) ) ) {
			// Adding the Google Tag Manager Tracking code to the wordpress header
			wp_enqueue_script( $this->plugin_name . '-gtm', plugin_dir_url( __FILE__ ) . 'js/wp-ai-manager-gtm.js', array(), $this->version, !get_option( 'gtm-head' ) );
			wp_localize_script( $this->plugin_name . '-gtm', 'gtmcid', get_option( 'gtm-id' ) );
		}

		if ( get_option( 'scripts-footer' ) ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/wp-ai-manager-speed-up.php';
			WP_AI_MANAGER_PUBLIC_PAGE_SPEED_UP::load_scripts_in_footer($this->plugin_name);
		}

		if ( 1 ) {
			// Adding the Google Tag Manager Tracking code to the wordpress header
			wp_enqueue_script( $this->plugin_name . '-track-scroll', plugin_dir_url( __FILE__ ) . 'js/wp-ai-manager-scroll.js', array( 'jquery' ), $this->version, true );
		}
	}
}
