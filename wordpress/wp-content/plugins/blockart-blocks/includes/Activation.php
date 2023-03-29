<?php
/**
 * Activation class.
 *
 * @package BlockArt
 * @since 1.0.0
 */

namespace BlockArt;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use BlockArt\Traits\Singleton;

/**
 * Activation class.
 */
class Activation {

	use Singleton;

	/**
	 * Constructor.
	 */
	protected function __construct() {
		register_activation_hook( BLOCKART_PLUGIN_FILE, array( $this, 'on_activate' ) );
		add_action( 'init', array( $this, 'check_version' ), 0 );
	}

	/**
	 * Callback for plugin activation hook.
	 */
	public function on_activate() {
		$this->maybe_set_activation_redirect();
		$this->maybe_set_activation_time();
	}

	/**
	 * Set initial activation redirect flag.
	 *
	 * @return void
	 */
	private function maybe_set_activation_redirect() {
		$blockart_version = get_option( '_blockart_version' );

		if ( empty( $blockart_version ) ) {
			update_option( '_blockart_activation_redirect', true );
		}
	}

	/**
	 * Set initial activation time.
	 *
	 * @return void
	 */
	private function maybe_set_activation_time() {
		$activation_time = get_option( '_blockart_activation_time', '' );

		if ( empty( $activation_time ) ) {
			update_option( '_blockart_activation_time', time() );
		}
	}

	/**
	 * Check version on init.
	 *
	 * @return void
	 */
	public function check_version() {
		if ( ! defined( 'IFRAME_REQUEST' ) && version_compare( get_option( '_blockart_version' ), BLOCKART_VERSION, '<' ) ) {
			$this->maybe_set_activation_time();
		}
	}
}
