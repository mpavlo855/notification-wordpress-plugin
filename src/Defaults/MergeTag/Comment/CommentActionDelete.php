<?php
/**
 * Comment action delete URL merge tag
 *
 * @package notification
 */

namespace BracketSpace\Notification\Defaults\MergeTag\Comment;

use BracketSpace\Notification\Defaults\MergeTag\UrlTag;
use BracketSpace\Notification\Utils\WpObjectHelper;

/**
 * Comment action delete URL merge tag class
 */
class CommentActionDelete extends UrlTag {

	/**
	 * Trigger property to get the comment data from
	 *
	 * @var string
	 */
	protected $comment_type = 'comment';

	/**
	 * Merge tag constructor
	 *
	 * @since 5.0.0
	 * @param array $params merge tag configuration params.
	 */
	public function __construct( $params = [] ) {

		if ( isset( $params['comment_type'] ) && ! empty( $params['comment_type'] ) ) {
			$this->comment_type = $params['comment_type'];
		}

		$this->set_trigger_prop( $params['property_name'] ?? 'comment' );

		$comment_type_name = WpObjectHelper::get_comment_type_name( $this->comment_type );

		$args = wp_parse_args(
			$params,
			[
				'slug'     => 'comment_delete_action_url',
				// Translators: Comment type name.
				'name'     => sprintf( __( '%s delete URL', 'notification' ), $comment_type_name ),
				// Translators: comment type actions text.
				'group'    => sprintf( __( '%s actions', 'notification' ), $comment_type_name ),
				'resolver' => function ( $trigger ) {
					return admin_url( "comment.php?action=delete&c={$trigger->{ $this->get_trigger_prop() }->comment_ID}#wpbody-content" );
				},
			]
		);

		parent::__construct( $args );

	}

}
