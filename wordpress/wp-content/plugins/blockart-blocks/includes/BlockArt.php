<?php
/**
 * BlockArt plugin main class.
 *
 * @since 1.0.0
 * @package BlockArt
 */

namespace BlockArt;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use BlockArt\Traits\Singleton;

/**
 * BlockArt setup.
 *
 * Include and initialize necessary files and classes for the plugin.
 *
 * @since   1.0.0
 */
final class BlockArt {

	use Singleton;

	/**
	 * @var Utils
	 */
	public $utils;

	/**
	 * Plugin Constructor.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	protected function __construct() {
		$this->init_props();
		Activation::init();
		Deactivation::init();
		Admin::init();
		Review::init();
		Blocks::init();
		ScriptStyle::init();
		Ajax::init();
		$this->init_hooks();
	}

	/**
	 * Init properties.
	 *
	 * @return void
	 */
	private function init_props() {
		$this->utils = Utils::init();
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
	 */
	private function init_hooks() {
		add_action( 'init', array( $this, 'after_wp_init' ), 0 );
	}

	/**
	 * Initialize BlockArt when WordPress initializes.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function after_wp_init() {
		/**
		 * BlockArt before init.
		 *
		 * @since 1.0.0
		 */
		do_action( 'blockart_before_init' );
		$this->update_plugin_version();
		$this->load_text_domain();
		$this->register_settings();
		/**
		 * BlockArt init.
		 *
		 * Fires after BlockArt has loaded.
		 *
		 * @since 1.0.0
		 */
		do_action( 'blockart_init' );
	}

	/**
	 * Update the plugin version.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private function update_plugin_version() {
		update_option( '_blockart_version', BLOCKART_VERSION );
	}

	/**
	 * Load plugin text domain.
	 */
	private function load_text_domain() {
		load_plugin_textdomain( 'blockart', false, plugin_basename( BLOCKART_PLUGIN_DIR ) . '/languages' );
	}

	/**
	 * Register settings.
	 *
	 * @since 1.0.0
	 */
	private function register_settings() {
		register_setting(
			'_blockart_settings',
			'_blockart_dynamic_css_print_method',
			array(
				'type'              => 'string',
				'show_in_rest'      => true,
				'default'           => 'internal-css',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		register_setting(
			'_blockart_settings',
			'_blockart_widget_css',
			array(
				'type'              => 'string',
				'show_in_rest'      => true,
				'default'           => '',
				'sanitize_callback' => '',
			)
		);
		register_setting(
			'_blockart_settings',
			'_blockart_admin_footer_text_rated',
			array(
				'type'              => 'boolean',
				'show_in_rest'      => true,
				'default'           => false,
				'sanitize_callback' => 'rest_sanitize_boolean',
			)
		);
	}
}
