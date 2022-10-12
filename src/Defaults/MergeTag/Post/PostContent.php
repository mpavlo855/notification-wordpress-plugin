<?php
/**
 * Post content merge tag
 *
 * Requirements:
 * - Trigger property of the post type slug with WP_Post object
 *
 * @package notification
 */

namespace BracketSpace\Notification\Defaults\MergeTag\Post;

use BracketSpace\Notification\Defaults\MergeTag\StringTag;
use BracketSpace\Notification\Utils\WpObjectHelper;

/**
 * Post content merge tag class
 */
class PostContent extends StringTag {

	/**
	 * Post Type slug
	 *
	 * @var string
	 */
	protected $post_type;

	/**
	 * Merge tag constructor
	 *
	 * @since 5.0.0
	 * @param array $params merge tag configuration params.
	 */
	public function __construct( $params = [] ) {

		$this->set_property_name($params, 'post_type', 'post');

		$post_type_name = WpObjectHelper::get_post_type_name( $this->post_type );

		$args = wp_parse_args(
			$params,
			[
				'slug'        => sprintf( '%s_content', $this->post_type ),
				// translators: singular post name.
				'name'        => sprintf( __( '%s content', 'notification' ), $post_type_name ),
				'description' => __( 'Welcome to WordPress. This is your first post. Edit or delete it, then start writing!', 'notification' ),
				'example'     => true,
				'group'       => $post_type_name,
				'resolver'    => function ( $trigger ) {
					return apply_filters( 'the_content', $trigger->{ $this->post_type }->post_content );
				},
			]
		);

		parent::__construct( $args );

	}

}
