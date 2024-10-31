<?php
/**
 * Plugin Name: Scroll Up Sticky Header for Total
 * Plugin URI:  https://wordpress.org/plugins/scroll-up-sticky-header-for-total/
 * Description: Displays the theme's sticky header only when scrolling up so it will be hidden as you scroll down.
 * Author: WPExplorer
 * Author URI: https://www.wpexplorer.com/
 * Version: 1.2
 *
 * Text Domain: scroll-up-sticky-header-for-total
 * Domain Path: /languages/
 *
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Scroll_Up_Sticky_Header_For_Total' ) ) {

	final class Scroll_Up_Sticky_Header_For_Total {

		/**
		 * Class version.
		 */
		public $version = '1.2';

		/**
		 * Our single Scroll_Up_Sticky_Header_For_Total instance.
		 *
		 * @var Scroll_Up_Sticky_Header_For_Total
		 */
		private static $instance;

		/**
		 * Disable instantiation.
		 */
		private function __construct() {
			// Private to disabled instantiation.
		}

		/**
		 * Disable the cloning of this class.
		 *
		 * @return void
		 */
		final public function __clone() {
			throw new Exception( 'You\'re doing things wrong.' );
		}

		/**
		 * Disable the wakeup of this class.
		 *
		 * @return void
		 */
		final public function __wakeup() {
			throw new Exception( 'You\'re doing things wrong.' );
		}

		/**
		 * Create or retrieve the instance of Scroll_Up_Sticky_Header_For_Total.
		 *
		 * @return Scroll_Up_Sticky_Header_For_Total
		 */
		public static function instance() {
			if ( is_null( static::$instance ) ) {
				static::$instance = new Scroll_Up_Sticky_Header_For_Total;
				static::$instance->init_hooks();
			}

			return static::$instance;
		}

		/**
		 * Hook into actions and filters.
		 */
		public function init_hooks() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 10 );
		}

		/**
		 * Enqueue scripts.
		 */
		public function enqueue_scripts() {
			if ( ! function_exists( 'wpex_has_sticky_header' ) || ! wpex_has_sticky_header() ) {
				return;
			}

			$dir_url = trailingslashit( plugin_dir_url( __FILE__ ) );

			$dependencies = array();

			if ( defined( 'WPEX_THEME_JS_HANDLE' ) ) {
				$dependencies[] = WPEX_THEME_JS_HANDLE;
			}

			wp_enqueue_script(
				'scroll-up-sticky-header-for-total',
				$dir_url . 'assets/scroll-up-sticky-header-for-total.min.js',
				$dependencies,
				$this->version,
				true
			);

			wp_enqueue_style(
				'scroll-up-sticky-header-for-total',
				$dir_url . 'assets/scroll-up-sticky-header-for-total.css',
				array(),
				$this->version
			);

		}
	}

	Scroll_Up_Sticky_Header_For_Total::instance();

}