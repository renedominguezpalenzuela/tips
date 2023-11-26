<?php
/**
 * /lib/shortcodes.php
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */

add_shortcode( 'search', 'relevanssi_shortcode' );
add_shortcode( 'noindex', 'relevanssi_noindex_shortcode' );
add_shortcode( 'searchform', 'relevanssi_search_form' );

/**
 * Creates a link to search results.
 *
 * Using this is generally not a brilliant idea, actually. Google doesn't like
 * it if you create links to internal search results.
 *
 * Usage: [search term='tomato']tomatoes[/search] would create a link like this:
 * <a href="/?s=tomato">tomatoes</a>
 *
 * Set 'phrase' to something else than 'not' to make the search term a phrase.
 *
 * @global object $wpdb The WordPress database interface.
 *
 * @param array  $atts    The shortcode attributes. If 'term' is set, will use
 * it as the search term, otherwise the content word is used as the term.
 * @param string $content The content inside the shortcode tags.
 *
 * @return string A link to search results.
 */
function relevanssi_shortcode( $atts, $content ) {
	$attributes = shortcode_atts(
		array(
			'term'   => false,
			'phrase' => 'not',
		),
		$atts
	);

	$term   = $attributes['term'];
	$phrase = $attributes['phrase'];

	if ( false !== $term ) {
		$term = rawurlencode( relevanssi_strtolower( $term ) );
	} else {
		$term = rawurlencode( wp_strip_all_tags( relevanssi_strtolower( $content ) ) );
	}

	if ( 'not' !== $phrase ) {
		$term = '%22' . $term . '%22';
	}

	$link = get_bloginfo( 'url' ) . "/?s=$term";
	$pre  = "<a rel='nofollow' href='$link'>"; // rel='nofollow' for Google.
	$post = '</a>';

	return $pre . do_shortcode( $content ) . $post;
}

/**
 * Does nothing.
 *
 * In normal use, the [noindex] shortcode does nothing.
 *
 * @param array  $atts    The shortcode attributes. Not used.
 * @param string $content The content inside the shortcode tags.
 *
 * @return string The shortcode content.
 */
function relevanssi_noindex_shortcode( $atts, $content ) {
	return do_shortcode( $content );
}

/**
 * Returns nothing.
 *
 * During indexing, the [noindex] shortcode returns nothing.
 *
 * @param array  $atts    The shortcode attributes. Not used.
 * @param string $content The content inside the shortcode tags.
 *
 * @return string An empty string.
 */
function relevanssi_noindex_shortcode_indexing( $atts, $content ) {
	return '';
}

/**
 * Returns a search form.
 *
 * Returns a search form generated by get_search_form(). Any attributes passed to the
 * shortcode will be passed onto the search form, for example like this:
 *
 * [searchform post_types='post,product']
 *
 * This would add a
 *
 * <input type="hidden" name="post_types" value="post,product" />
 *
 * to the search form.
 *
 * @param array $atts The shortcode attributes.
 *
 * @return string A search form.
 */
function relevanssi_search_form( $atts ) {
	$form = get_search_form( false );
	if ( is_array( $atts ) ) {
		$additional_fields = array();
		foreach ( $atts as $key => $value ) {
			if ( 'dropdown' === substr( $key, 0, 8 ) ) {
				$key = 'dropdown';
			}
			if ( 'checklist' === substr( $key, 0, 9 ) ) {
				$key = 'checklist';
			}
			if ( 'post_type_boxes' === $key ) {
				$post_types = explode( ',', $value );
				if ( is_array( $post_types ) ) {
					$post_type_objects   = get_post_types( array(), 'objects' );
					$additional_fields[] = '<div class="post_types"><strong>Post types</strong>: ';
					foreach ( $post_types as $post_type ) {
						$checked = '';
						if ( '*' === substr( $post_type, 0, 1 ) ) {
							$post_type = substr( $post_type, 1 );
							$checked   = ' checked="checked" ';
						}
						if ( isset( $post_type_objects[ $post_type ] ) ) {
							$additional_fields[] = '<span class="post_type post_type_' . $post_type . '">'
							. '<input type="checkbox" name="post_types[]" value="' . $post_type . '"' . $checked . '/> '
							. $post_type_objects[ $post_type ]->name . '</span>';
						}
					}
					$additional_fields[] = '</div>';
				}
			} elseif ( 'dropdown' === $key && 'post_type' === $value ) {
				$field = '<select name="post_type">';
				$types = get_option( 'relevanssi_index_post_types', array() );
				if ( ! is_array( $types ) ) {
					$types = array();
				}
				foreach ( $types as $type ) {
					if ( post_type_exists( $type ) ) {
						$object = get_post_type_object( $type );
						$field .= '<option value="' . $type . '">' . $object->labels->singular_name . '</option>';
					}
				}
				$field              .= '</select>';
				$additional_fields[] = $field;

			} elseif ( 'dropdown' === $key && 'post_type' !== $value ) {
				$name = $value;
				if ( 'category' === $value ) {
					$name = 'cat';
				}
				if ( 'post_tag' === $value ) {
					$name = 'tag';
				}
				$args                = array(
					'taxonomy'         => $value,
					'echo'             => 0,
					'hide_if_empty'    => true,
					'show_option_none' => __( 'None' ),
					'name'             => $name,
				);
				$additional_fields[] = wp_dropdown_categories( $args );
			} elseif ( 'checklist' === $key && 'post_type' !== $value ) {
				$name = $value;
				if ( 'category' === $value ) {
					$name = 'cat';
				}
				if ( 'post_tag' === $value ) {
					$name = 'tag';
				}
				$args = array(
					'taxonomy' => $value,
					'echo'     => 0,
				);
				if ( ! function_exists( 'wp_terms_checklist' ) ) {
					include ABSPATH . 'wp-admin/includes/template.php';
				}
				$checklist           = wp_terms_checklist( 0, $args );
				$checklist           = str_replace( 'post_category', 'cats', $checklist );
				$checklist           = str_replace( 'tax_input[post_tag]', 'tags', $checklist );
				$checklist           = str_replace( "disabled='disabled'", '', $checklist );
				$checklist           = preg_replace( '/tax_input\[(.*?)\]/', '\1', $checklist );
				$additional_fields[] = $checklist;
			} else {
				$key   = esc_attr( $key );
				$value = esc_attr( $value );

				$additional_fields[] = "<input type='hidden' name='$key' value='$value' />";
			}
		}
		$form = str_replace( '</form>', implode( "\n", $additional_fields ) . '</form>', $form );
	}
	/**
	 * Filters the Relevanssi shortcode search form before it's used.
	 *
	 * @param string $form The form HTML code.
	 * @param array  $atts The shortcode attributes.
	 */
	return apply_filters( 'relevanssi_search_form', $form, $atts );
}
