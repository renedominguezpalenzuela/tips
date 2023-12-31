<?php

/**
 * Class LLA_Helpers
 */
class LLA_Helpers {

    /**
     * @param string $msg
     */
    public static function show_message( $msg = '', $is_error = false ) {
        if( empty( $msg ) ) return;

        $class = $is_error ? 'error' : 'updated';
        echo '<div id="message" class="' . $class . ' fade"><p>' . $msg . '</p></div>';
    }

    /**
     * @param $log
     *
     * @return array
     */
    public static function sorted_log_by_date( $log ) {
        $new_log = array();

        if ( ! is_array( $log ) || empty( $log ) ) {
            return $new_log;
        }

        foreach ( $log as $ip => $users ) {

            if ( ! empty( $users ) ) {
                foreach ( $users as $user_name => $info ) {

                    if ( is_array( $info ) ) { // For new plugin version
                        $new_log[ $info['date'] ] = array(
                            'ip'       => $ip,
                            'username' => $user_name,
                            'counter'  => $info['counter'],
                            'gateway'  => ( isset( $info['gateway'] ) ) ? $info['gateway'] : '-',
                            'unlocked' => !empty( $info['unlocked'] ),
                        );
                    } else { // For old plugin version
                        $new_log[0] = array(
                            'ip'       => $ip,
                            'username' => $user_name,
                            'counter'  => $info,
                            'gateway'  => '-',
                            'unlocked' => false,
                        );
                    }

                }
            }

        }

        krsort( $new_log );

        return $new_log;
    }

    public static function get_countries_list() {

    	if( ! ( $countries = require LLA_PLUGIN_DIR . '/resources/countries.php' ) ) {

    		return array();
		}

    	asort($countries);

    	return $countries;
	}

	/**
	 * @param $ip
	 * @param $cidr
	 * @return bool
	 */
	public static function check_ip_cidr($ip, $cidr) {

		if( !$ip || !$cidr ) return false;

    	$cidr_checker = new LLAR_cidr_check();
    	return $cidr_checker->match( $ip, $cidr );
	}

	/**
	 * Checks if the plugin is installed as Must Use plugin
	 *
	 * @return bool
	 */
	public static function is_mu() {

		return ( strpos( LLA_PLUGIN_DIR, 'mu-plugins' ) !== false );
	}

	/**
	 * @param $content
	 * @return string|string[]|null
	 */
	public static function deslash( $content ) {

		$content = preg_replace( "/\\\+'/", "'", $content );
		$content = preg_replace( '/\\\+"/', '"', $content );
		$content = preg_replace( '/\\\+/', '\\', $content );

		return $content;
	}

	public static function isAutoUpdateEnabled() {
		$auto_update_plugins = get_site_option( 'auto_update_plugins' );
		return is_array( $auto_update_plugins ) && in_array( LLA_PLUGIN_BASENAME, $auto_update_plugins );
	}

	public static function getWordpressVersion() {
		global $wp_version;
		return $wp_version;
	}

	public static function short_number($num) {
	    $units = ['', 'K', 'M', 'B', 'T'];
	    for ($i = 0; $num >= 1000; $i++) {
	        $num /= 1000;
	    }
		return round($num, 1) . $units[$i];
	}

	public static function send_mail_with_logo( $to, $subject, $body ) {

		add_action( 'phpmailer_init', array( 'LLA_Helpers', 'add_attachments_to_php_mailer' ) );

		@wp_mail( $to, $subject, $body, array( 'content-type: text/html' ) );

		remove_action( 'phpmailer_init', array( 'LLA_Helpers', 'add_attachments_to_php_mailer' ) );
	}

	public static function add_attachments_to_php_mailer( &$phpmailer ) {
		$logo_path = LLA_PLUGIN_DIR . '/assets/img/logo.png';

		if( file_exists( $logo_path ) ) {
			$phpmailer->AddEmbeddedImage( $logo_path, 'logo' );
		}
	}
}