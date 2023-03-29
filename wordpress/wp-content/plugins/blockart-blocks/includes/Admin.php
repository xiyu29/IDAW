<?php
/**
 * AdminMenu class.
 *
 * @package BlockArt
 * @since 1.0.0
 */

namespace BlockArt;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use BlockArt\Traits\Singleton;

/**
 * Admin class.
 */
class Admin {

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
	 * @since 1.0.0
	 */
	private function init_hooks() {
		add_action( 'admin_menu', array( $this, 'init_menus' ) );
		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ), 1 );
		add_filter( 'update_footer', array( $this, 'admin_footer_version' ), 11 );
		add_action( 'in_admin_header', array( $this, 'hide_admin_notices' ) );
		add_action( 'admin_init', array( $this, 'admin_redirects' ) );
	}

	/**
	 * Init menus.
	 *
	 * @since 1.0.0
	 */
	public function init_menus() {
		$blockart_page = add_menu_page(
			esc_html__( 'BlockArt', 'blockart' ),
			esc_html__( 'BlockArt', 'blockart' ),
			'manage_options',
			'blockart',
			array( $this, 'markup' ),
			'data:image/svg+xml;base64,' . base64_encode( '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22 22H2V2h20zM3 21h18V3H3z" fill="#fff"/><path d="M13.46 10l-1.39-5-1.39 5zm.92 3H9.77l-1 4.46V19h6.4v-1.52z" fill="#fff" fill-rule="evenodd"/></svg>' ) // phpcs:ignore
		);

		add_submenu_page(
			'blockart',
			esc_html__( 'Getting Started', 'blockart' ),
			esc_html__( 'Getting Started', 'blockart' ),
			'manage_options',
			'blockart#/getting-started',
			array( $this, 'markup' )
		);

		add_submenu_page(
			'blockart',
			esc_html__( 'Settings', 'blockart' ),
			esc_html__( 'Settings', 'blockart' ),
			'manage_options',
			'blockart#/settings',
			array( $this, 'markup' )
		);

		add_action( "admin_print_scripts-$blockart_page", array( $this, 'enqueue' ) );
		remove_submenu_page( 'blockart', 'blockart' );
	}

	/**
	 * Markup.
	 *
	 * @since 1.0.0
	 */
	public function markup() {
		echo '<div id="blockart"></div>';
	}

	/**
	 * Enqueue.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {
		wp_enqueue_script( 'blockart-admin' );
		wp_enqueue_style( 'blockart-admin' );
	}

	/**
	 * Change admin footer text on BlockArt page.
	 *
	 * @param string $text Admin footer text.
	 * @return string Admin footer text.
	 */
	public function admin_footer_text( $text ) {
		if ( 'toplevel_page_blockart' !== get_current_screen()->id ) {
			return $text;
		}

		if ( ! get_option( '_blockart_admin_footer_text_rated' ) ) {
			$text = sprintf(
				/* translators: 1: BlockArt, 2: Five stars */
				esc_html__( 'Enjoyed %1$s? please leave us a %2$s rating. We really appreciate your support!', 'blockart' ),
				sprintf( '<strong>%s</strong>', esc_html__( 'BlockArt', 'blockart' ) ),
				'<a href="https://wordpress.org/support/plugin/blockart-blocks/reviews?rate=5#new-post" target="_blank" class="blockart-rating-link">&#9733;&#9733;&#9733;&#9733;&#9733;</a>'
			);
		} else {
			$text = esc_html__( 'Thank you for creating with BlockArt.', 'blockart' );
		}

		return $text;
	}

	/**
	 * Override WordPress version with plugin version.
	 *
	 * @param string $version Version text.
	 * @return string Version text.
	 */
	public function admin_footer_version( $version ) {
		return 'toplevel_page_blockart' !== get_current_screen()->id ? $version : __( 'Version ', 'blockart' ) . BLOCKART_VERSION;
	}

	/**
	 * Redirecting user to dashboard page.
	 */
	public function admin_redirects() {
		if ( get_option( '_blockart_activation_redirect' ) && apply_filters( 'blockart_activation_redirect', true ) ) {
			update_option( '_blockart_activation_redirect', false );
			wp_safe_redirect( admin_url( 'index.php?page=blockart#/getting-started' ) );
			exit;
		}
	}

	/**
	 * Hide admin notices from BlockArt admin pages.
	 *
	 * @since 1.0.0
	 */
	public function hide_admin_notices() {
		// Bail if we're not on a BlockArt screen or page.
		if ( empty( $_REQUEST['page'] ) || false === strpos( sanitize_text_field( wp_unslash( $_REQUEST['page'] ) ), 'blockart' ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			return;
		}

		global $wp_filter;
		$ignore_notices = apply_filters( 'blockart_ignore_hide_admin_notices', array() );

		foreach ( array( 'user_admin_notices', 'admin_notices', 'all_admin_notices' ) as $wp_notice ) {
			if ( empty( $wp_filter[ $wp_notice ] ) ) {
				continue;
			}

			$hook_callbacks = $wp_filter[ $wp_notice ]->callbacks;

			if ( empty( $hook_callbacks ) || ! is_array( $hook_callbacks ) ) {
				continue;
			}

			foreach ( $hook_callbacks as $priority => $hooks ) {
				foreach ( $hooks as $name => $callback ) {
					if ( ! empty( $name ) && in_array( $name, $ignore_notices, true ) ) {
						continue;
					}
					if (
						! empty( $callback['function'] ) &&
						! is_a( $callback['function'], '\Closure' ) &&
						isset( $callback['function'][0], $callback['function'][1] ) &&
						is_object( $callback['function'][0] ) &&
						in_array( $callback['function'][1], $ignore_notices, true )
					) {
						continue;
					}
					unset( $wp_filter[ $wp_notice ]->callbacks[ $priority ][ $name ] );
				}
			}
		}
	}
}
