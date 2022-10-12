<?php
/**
 * Taxonomy term permalink merge tag
 *
 * Requirements:
 * - Trigger property of the WP_Taxonomy term object
 *
 * @package notification
 */

namespace BracketSpace\Notification\Defaults\MergeTag\Taxonomy;

use BracketSpace\Notification\Defaults\MergeTag\UrlTag;

/**
 * Taxonomy term permalink merge tag class
 */
class TermPermalink extends UrlTag {

	/**
	 * Property name
	 *
	 * @var string
	 */
	protected $property_name;

	/**
	 * Merge tag constructor
	 *
	 * @since 5.2.2
	 */
	public function __construct( $params = [] ) {

		$this->set_property_name($params, 'property_name', 'term');

		$args = wp_parse_args(
			[
				'slug'        => sprintf('%s_link', $this->property_name),
				'name'        => __( 'Term link', 'notification' ),
				'description' => 'http://example.com/category/nature',
				'example'     => true,
				'group'       => __( 'Term', 'notification' ),
				'resolver'    => function ( $trigger ) {
					return $trigger->term_permalink;
				},
			]
		);

		parent::__construct( $args );

	}
}
