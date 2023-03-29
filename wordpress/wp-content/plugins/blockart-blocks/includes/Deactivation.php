<?php
/**
 * Deactivation class.
 *
 * @package BlockArt
 * @since 1.0.0
 */

namespace BlockArt;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use BlockArt\Traits\Singleton;

/**
 * Deactivation class.
 */
class Deactivation {

	use Singleton;

	/**
	 * Constructor.
	 */
	protected function __construct() {
		register_deactivation_hook( BLOCKART_PLUGIN_FILE, array( __CLASS__, 'on_deactivate' ) );
	}

	/**
	 * Callback for plugin deactivation hook.
	 *
	 * @since 1.0.0
	 */
	public static function on_deactivate() {}
}
