<?php

namespace Yoast\WP\SEO\Integrations\Admin;

use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Integrations\Cleanup_Integration;
use Yoast\WP\SEO\Conditionals\No_Conditionals;

/**
 * This integration registers a run of the cleanup routine whenever the plugin is activated.
 */
class Activation_Cleanup_Integration implements Integration_Interface {

	use No_Conditionals;

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	private $options_helper;

	/**
	 * Activation_Cleanup_Integration constructor.
	 *
	 * @param Options_Helper $options_helper The options helper.
	 */
	public function __construct(
		Options_Helper $options_helper
	) {
		$this->options_helper = $options_helper;
	}

	/**
	 * Registers the action to register a cleanup routine run after the plugin is activated.
	 *
	 * @return void
	 */
	public function register_hooks() {
		add_action( 'wpseo_activate', [ $this, 'register_cleanup_routine' ], 11 );
	}

	/**
	 * Registers a run of the cleanup routine if this has not happened yet.
	 *
	 * @return void
	 */
	public function register_cleanup_routine() {
		$first_activated_on = $this->options_helper->get( 'first_activated_on', false );

		if ( ! $first_activated_on || time() > ( $first_activated_on + ( MINUTE_IN_SECONDS * 5 ) ) ) {
			if ( ! \wp_next_scheduled( Cleanup_Integration::START_HOOK ) ) {
				\wp_schedule_single_event( ( time() + DAY_IN_SECONDS ), Cleanup_Integration::START_HOOK );
			}
		}
	}
}
