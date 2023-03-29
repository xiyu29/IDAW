<?php
/**
 * Class Ajax.
 *
 * @package BlockArt
 * @since 1.0.6
 */

namespace BlockArt;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use BlockArt\Traits\Singleton;

/**
 * Class Ajax.
 *
 * @since 1.0.6
 */
class Ajax {

	use Singleton;

	/**
	 * Constructor.
	 */
	protected function __construct() {
		$this->init_hooks();
	}

	/**
	 * Init hooks.
	 *
	 * @since 1.0.6
	 * @return void
	 */
	private function init_hooks() {
		add_action( 'wp_ajax_blockart_get_library_data', array( $this, 'get_library_data' ) );
		add_action( 'wp_ajax_blockart_import_content', array( $this, 'import_content' ) );
		add_action( 'wp_ajax_blockart_get_widget_blocks', array( $this, 'get_widget_blocks' ) );
		add_action( 'wp_ajax_blockart_save_block_css', array( $this, 'save_block_css' ) );
	}

	/**
	 * Save block CSS.
	 *
	 * @return void
	 */
	public function save_block_css() {
		check_ajax_referer( '_blockart_nonce', 'security', false );

		$css            = isset( $_POST['css'] ) ? sanitize_text_field( wp_unslash( $_POST['css'] ) ) : '';
		$post_id        = isset( $_POST['post_id'] ) ? absint( wp_unslash( $_POST['post_id'] ) ) : 0;
		$has_blocks     = isset( $_POST['has_blocks'] ) && rest_sanitize_boolean( wp_unslash( $_POST['has_blocks'] ) );
		$filename       = "blockart-css-$post_id.css";
		$upload_dir_url = wp_upload_dir();
		$dir            = trailingslashit( $upload_dir_url['basedir'] ) . 'blockart/';

		if ( $has_blocks ) {
			if ( ! blockart()->utils->create_files( $filename, $css ) ) {
				wp_send_json_error();
			}
			update_post_meta( $post_id, '_blockart_active', 'yes' );
			update_post_meta( $post_id, '_blockart_css', $css );
		} else {
			delete_post_meta( $post_id, '_blockart_active' );
			delete_post_meta( $post_id, '_blockart_css' );
			file_exists( "$dir$filename" ) && unlink( "$dir$filename" );
		}
		wp_send_json_success();
	}

	/**
	 * Get library data.
	 *
	 * @since 1.0.6
	 * @return void
	 */
	public function get_library_data() {
		check_ajax_referer( '_blockart_nonce', 'security', false );

		$refresh = isset( $_POST['refresh'] ) && rest_sanitize_boolean( wp_unslash( $_POST['refresh'] ) );

		if ( $refresh ) {
			delete_transient( '_blockart_library_data' );
		}

		$data = get_transient( '_blockart_library_data' );

		if ( empty( $data ) ) {
			$response      = wp_remote_get(
				'https://wpblockart.com/wp-json/blockart-library/v1/all',
				array(
					'timeout' => 120,
				)
			);
			$response_code = wp_remote_retrieve_response_code( $response );

			if ( is_wp_error( $response ) || 200 !== (int) $response_code ) {
				wp_send_json_error( $response->get_error_message() );
			}

			$data = wp_remote_retrieve_body( $response );

			set_transient( '_blockart_library_data', $data, WEEK_IN_SECONDS );
		}

		wp_send_json_success( $data );
	}

	/**
	 * Import content.
	 *
	 * @since 1.0.6
	 * @return void
	 */
	public function import_content() {
		check_ajax_referer( '_blockart_nonce', 'security', false );

		$id      = isset( $_POST['id'] ) ? absint( wp_unslash( $_POST['id'] ) ) : 0;
		$content = '';

		if ( $id ) {
			$remote_data = wp_remote_get(
				'https://wpblockart.com/wp-json/blockart-library/v1/content',
				array(
					'timeout' => 120,
					'body'    => array(
						'id' => $id,
					),
				)
			);

			if ( is_wp_error( $remote_data ) ) {
				wp_send_json_error( __( 'Failed to retrieve data!', 'blockart' ) );
			}

			$raw     = json_decode( $remote_data['body'] );
			$content = blockart()->utils->process_content_for_import( $raw );
		}

		wp_send_json_success(
			array(
				'content'     => $content,
				'media_items' => blockart()->utils->get_media_items(),
			)
		);
	}

	/**
	 * Get widget block.
	 *
	 * @return void
	 */
	public function get_widget_blocks() {
		check_ajax_referer( '_blockart_nonce', 'security', false );
		wp_send_json_success( array( 'blocks' => blockart()->utils->get_widget_blocks() ) );
	}
}
