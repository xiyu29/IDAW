<?php
/**
 * Register and enqueue scripts for plugin.
 *
 * @since 1.0.0
 * @package BlockArt
 */

namespace BlockArt;

defined( 'ABSPATH' ) || exit;

use BlockArt\Traits\Singleton;

/**
 * Register and enqueue scripts for plugin.
 *
 * @since 1.0.0
 */
class ScriptStyle {

	use Singleton;

	/**
	 * Constructor.
	 */
	protected function __construct() {
		$this->init_hooks();
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
	 */
	private function init_hooks() {
		add_action( 'init', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_block_styles' ) );
	}

	/**
	 * Register scripts and styles for plugin.
	 *
	 * @since 1.0.0
	 */
	public function register_scripts() {
		$this->register_admin_scripts();
		$this->register_admin_styles();
		$this->register_blocks_scripts();
		$this->register_blocks_styles();
	}

	/**
	 * Register admin scripts.
	 *
	 * @since 1.0.0
	 */
	private function register_admin_scripts() {
		$asset  = $this->get_asset_file( 'admin' );
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_register_script(
			'blockart-admin',
			plugins_url( "/dist/admin$suffix.js", BLOCKART_PLUGIN_FILE ),
			$asset['dependencies'],
			BLOCKART_VERSION,
			true
		);
		wp_localize_script(
			'blockart-admin',
			'_BLOCKART_ADMIN_',
			array(
				'cssPrintMethod' => get_option( '_blockart_dynamic_css_print_method' ),
				'version'        => BLOCKART_VERSION,
				'adminURL'       => admin_url(),
			)
		);
	}

	/**
	 * Register admin styles.
	 *
	 * @since 1.0.0
	 */
	private function register_admin_styles() {
		wp_register_style(
			'blockart-admin',
			plugins_url( 'dist/admin.css', BLOCKART_PLUGIN_FILE ),
			array( 'wp-components' ),
			BLOCKART_VERSION
		);
	}

	/**
	 * Register script for blocks.
	 *
	 * @since 1.0.0
	 */
	private function register_blocks_scripts() {
		global $pagenow;
		$asset  = $this->get_asset_file( 'blocks' );
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_register_script(
			'blockart-blocks',
			plugins_url( "/dist/blocks$suffix.js", BLOCKART_PLUGIN_FILE ),
			$asset['dependencies'],
			BLOCKART_VERSION,
			true
		);
		wp_set_script_translations( 'blockart-blocks', 'blockart', BLOCKART_LANGUAGES );
		wp_localize_script(
			'blockart-blocks',
			'_BLOCKART_',
			array(
				'isNotPostEditor'  => 'widgets.php' === $pagenow || 'customize.php' === $pagenow,
				'placeholderImage' => BLOCKART_ASSETS_DIR_URL . '/images/placeholder.png',
				'isWP59OrAbove'    => is_wp_version_compatible( '5.9' ),
				'nonce'            => wp_create_nonce( '_blockart_nonce' ),
				'ajaxUrl'          => admin_url( 'admin-ajax.php' ),
				'mediaItems'       => blockart()->utils->get_media_items(),
			)
		);
	}

	/**
	 * Register all the block styles.
	 *
	 * @since 1.0.0
	 */
	private function register_blocks_styles() {
		wp_register_style(
			'blockart-blocks',
			plugins_url( 'dist/style-blocks.css', BLOCKART_PLUGIN_FILE ),
			is_admin() ? array( 'wp-editor' ) : null,
			BLOCKART_VERSION
		);
		wp_register_style(
			'blockart-blocks-editor',
			plugins_url( 'dist/blocks.css', BLOCKART_PLUGIN_FILE ),
			array( 'wp-edit-blocks' ),
			BLOCKART_VERSION
		);
	}

	/**
	 * Enqueue Google fonts.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_block_styles() {
		$css_print_method        = get_option( '_blockart_dynamic_css_print_method', 'internal-css' );
		$post_id                 = get_the_ID();
		$css                     = get_post_meta( $post_id, '_blockart_css', true );
		$upload_dir_url          = wp_get_upload_dir();
		$blockart_upload_dir_url = trailingslashit( $upload_dir_url['basedir'] );
		$widget_block_css        = get_option( '_blockart_widget_css', '' );

		if ( $post_id ) {
			$blockart_css_path = $blockart_upload_dir_url . "blockart/blockart-css-$post_id.css";
			if ( 'external-css-file' === $css_print_method && file_exists( $blockart_css_path ) ) {
				$blockart_css_dir_url = trailingslashit( $upload_dir_url['baseurl'] );
				wp_enqueue_style(
					"blockart-post-$post_id",
					"{$blockart_css_dir_url}blockart/blockart-css-$post_id.css",
					array( 'blockart-blocks' ),
					filemtime( $blockart_css_path )
				);
			} else {
				if ( ! empty( $css ) ) {
					wp_add_inline_style( 'blockart-blocks', $css );
				}
			}
		}

		! empty( $widget_block_css ) && wp_add_inline_style( 'blockart-blocks', $widget_block_css );

		$google_fonts_url = $this->get_google_fonts_url();

		! empty( $google_fonts_url ) && wp_enqueue_style(
			'blockart-google-fonts',
			$google_fonts_url,
			array(),
			BLOCKART_VERSION
		);
	}

	/**
	 * Enqueue Google fonts.
	 *
	 * @since 1.0.0
	 */
	private function get_google_fonts_url() {
		global $post;
		$google_fonts = '';

		if ( ! is_object( $post ) ) {
			return $google_fonts;
		}

		$widget_content  = blockart()->utils->get_widget_blocks();
		$content         = apply_filters( 'blockart_block_content', $post->post_content );
		$blocks          = array_merge( parse_blocks( $content ), parse_blocks( $widget_content ) );
		$font_attributes = $this->get_font_attributes( $blocks );

		if ( count( $font_attributes ) > 0 ) {
			foreach ( $font_attributes as $family => $weight ) {
				if ( ! empty( $family ) && 'Default' !== $family ) {
					$google_fonts .= str_replace( ' ', '+', trim( $family ) ) . ':' . join( ',', array_unique( $weight ) ) . '|';
				}
			}
		}

		if ( ! empty( $google_fonts ) ) {
			return add_query_arg(
				array(
					'family'  => $google_fonts,
					'display' => 'swap',
				),
				'//fonts.googleapis.com/css'
			);
		}

		return $google_fonts;
	}

	/**
	 * Get font attributes used in BlockArt blocks.
	 *
	 * @since 1.0.0
	 * @param array $blocks All blocks in a content.
	 * @param array $fonts Used Google fonts.
	 * @return array Font attributes.
	 */
	private function get_font_attributes( $blocks, $fonts = array() ) {
		foreach ( $blocks as $block ) {
			if ( false !== strpos( $block['blockName'], 'blockart' ) ) {
				foreach ( $block['attrs'] as $key => $attr ) {
					if ( isset( $attr['typography'] ) && isset( $attr['family'] ) ) {
						$weight             = $block['attrs'][ $key ]['weight'] ? (string) $block['attrs'][ $key ]['weight'] : '400';
						$family             = $block['attrs'][ $key ]['family'];
						$fonts[ $family ][] = $weight;
					}
				}

				if ( isset( $block['innerBlocks'] ) && count( $block['innerBlocks'] ) > 0 ) {
					$inner_block_fonts = $this->get_font_attributes( $block['innerBlocks'], $fonts );

					if ( count( $inner_block_fonts ) > 0 ) {
						$fonts = array_merge( $fonts, $inner_block_fonts );
					}
				}
			}
		}

		return $fonts;
	}

	/**
	 * Get asset file
	 *
	 * @param string $prefix Filename prefix.
	 * @return array|mixed
	 */
	private function get_asset_file( $prefix ) {
		$asset_file = dirname( BLOCKART_PLUGIN_FILE ) . "/dist/$prefix.asset.php";

		return file_exists( $asset_file )
			? include $asset_file
			: array(
				'dependencies' => array(),
				'version'      => BLOCKART_VERSION,
			);
	}
}
