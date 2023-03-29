<?php
/**
 * BlockArt Blocks Manager.
 *
 * @since 1.0.0
 * @package BlockArt
 */

namespace BlockArt;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use BlockArt\Traits\Singleton;

/**
 * BlockArt Blocks.
 *
 * Registers all the blocks & block categories and manages them.
 *
 * @since 1.0.0
 */
class Blocks {

	use Singleton;

	/**
	 * Constructor.
	 */
	protected function __construct() {
		$this->init_hooks();
	}

	/**
	 * BlockArt/Blocks_Manager Constructor.
	 *
	 * @since 1.0.0
	 */
	private function init_hooks() {
		// `block_categories` filter depreciated after WP5.8.
		if ( version_compare( get_bloginfo( 'version' ), '5.8', '>=' ) ) {
			add_filter( 'block_categories_all', array( $this, 'block_categories' ), PHP_INT_MAX, 2 );
		} else {
			add_filter( 'block_categories', array( $this, 'block_categories' ), PHP_INT_MAX, 2 );
		}
		add_action( 'init', array( $this, 'register_blocks' ) );
	}

	/**
	 * Add "BlockArt" category to the blocks listing in post edit screen.
	 *
	 * @since 1.0.0
	 * @param array $block_categories All registered block categories.
	 * @return array
	 */
	public function block_categories( $block_categories ) {
		return array_merge(
			array(
				array(
					'slug'  => 'blockart',
					'title' => esc_html__( 'BlockArt', 'blockart' ),
				),
			),
			$block_categories
		);
	}

	/**
	 * Register all the blocks.
	 *
	 * @since 1.0.0
	 */
	public function register_blocks() {
		register_block_type_from_metadata( dirname( BLOCKART_PLUGIN_FILE ) . '/dist/buttons' );
		register_block_type_from_metadata( dirname( BLOCKART_PLUGIN_FILE ) . '/dist/heading' );
		register_block_type_from_metadata( dirname( BLOCKART_PLUGIN_FILE ) . '/dist/image' );
		register_block_type_from_metadata( dirname( BLOCKART_PLUGIN_FILE ) . '/dist/section' );
		register_block_type_from_metadata( dirname( BLOCKART_PLUGIN_FILE ) . '/dist/spacing' );
		register_block_type_from_metadata( dirname( BLOCKART_PLUGIN_FILE ) . '/dist/paragraph' );
	}
}
