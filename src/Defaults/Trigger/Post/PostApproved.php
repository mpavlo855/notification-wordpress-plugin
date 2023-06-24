<?php

/**
 * Post approved trigger
 *
 * @package notification
 */

declare(strict_types=1);

namespace BracketSpace\Notification\Defaults\Trigger\Post;

use BracketSpace\Notification\Defaults\MergeTag;
use BracketSpace\Notification\Utils\WpObjectHelper;

/**
 * Post approved trigger class. Approved means published after review.
 */
class PostApproved extends PostTrigger
{
	/**
	 * Post approving user object
	 *
	 * @var \WP_User|false
	 */
	public $approvingUser;

	/**
	 * Constructor
	 *
	 * @param string $postType optional, default: post.
	 */
	public function __construct($postType = 'post')
	{
		parent::__construct(
			[
				'post_type' => $postType,
				'slug' => 'post/' . $postType . '/approved',
			]
		);

		$this->addAction(
			'pending_to_publish',
			10
		);
	}

	/**
	 * Lazy loads the name
	 *
	 * @return string name
	 */
	public function getName(): string
	{
		return sprintf(
		// translators: singular post name.
			__(
				'%s approved',
				'notification'
			),
			WpObjectHelper::getPostTypeName($this->postType)
		);
	}

	/**
	 * Lazy loads the description
	 *
	 * @return string description
	 */
	public function getDescription(): string
	{
		return sprintf(
		// translators: 1. singular post name, 2. post type slug.
			__(
				'Fires when %1$s (%2$s) is approved',
				'notification'
			),
			WpObjectHelper::getPostTypeName($this->postType),
			$this->postType
		);
	}

	/**
	 * Sets trigger's context
	 *
	 * @param object $post Post object.
	 * @return mixed void or false if no notifications should be sent
	 */
	public function context($post)
	{
		// phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps
		if ($post->post_type !== $this->postType) {
			return false;
		}

		/** @var \WP_Post $post */
		$this->posts[$this->postType] = $post;

		$this->author = get_userdata((int)$this->posts[$this->postType]->post_author);
		$this->lastEditor = get_userdata(
			(int)get_post_meta(
				$this->posts[$this->postType]->ID,
				'_edit_last',
				true
			)
		);
		$this->approvingUser = get_userdata(get_current_user_id());

		$this->{$this->postType . '_creation_datetime'} = strtotime(
			$this->posts[$this->postType]->post_date_gmt
		);
		$this->{$this->postType . '_publication_datetime'} = strtotime(
			$this->posts[$this->postType]->post_date_gmt
		);
		$this->{$this->postType . '_modification_datetime'} = strtotime(
			$this->posts[$this->postType]->post_modified_gmt
		);
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function mergeTags()
	{

		$postTypeName = WpObjectHelper::getPostTypeName($this->postType);

		parent::mergeTags();

		// Approving user.
		$this->addMergeTag(
			new MergeTag\User\UserID(
				[
					'slug' => sprintf(
						'%s_approving_user_ID',
						$this->postType
					),
					'name' => sprintf(
					// translators: singular post name.
						__(
							'%s approving user ID',
							'notification'
						),
						$postTypeName
					),
					'property_name' => 'approving_user',
					'group' => __(
						'Approving user',
						'notification'
					),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => sprintf(
						'%s_approving_user_login',
						$this->postType
					),
					'name' => sprintf(
					// translators: singular post name.
						__(
							'%s approving user login',
							'notification'
						),
						$postTypeName
					),
					'property_name' => 'approving_user',
					'group' => __(
						'Approving user',
						'notification'
					),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => sprintf(
						'%s_approving_user_email',
						$this->postType
					),
					'name' => sprintf(
					// translators: singular post name.
						__(
							'%s approving user email',
							'notification'
						),
						$postTypeName
					),
					'property_name' => 'approving_user',
					'group' => __(
						'Approving user',
						'notification'
					),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserNicename(
				[
					'slug' => sprintf(
						'%s_approving_user_nicename',
						$this->postType
					),
					'name' => sprintf(
					// translators: singular post name.
						__(
							'%s approving user nicename',
							'notification'
						),
						$postTypeName
					),
					'property_name' => 'approving_user',
					'group' => __(
						'Approving user',
						'notification'
					),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => sprintf(
						'%s_approving_user_display_name',
						$this->postType
					),
					'name' => sprintf(
					// translators: singular post name.
						__(
							'%s approving user display name',
							'notification'
						),
						$postTypeName
					),
					'property_name' => 'approving_user',
					'group' => __(
						'Approving user',
						'notification'
					),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => sprintf(
						'%s_approving_user_firstname',
						$this->postType
					),
					'name' => sprintf(
					// translators: singular post name.
						__(
							'%s approving user first name',
							'notification'
						),
						$postTypeName
					),
					'property_name' => 'approving_user',
					'group' => __(
						'Approving user',
						'notification'
					),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => sprintf(
						'%s_approving_user_lastname',
						$this->postType
					),
					'name' => sprintf(
					// translators: singular post name.
						__(
							'%s approving user last name',
							'notification'
						),
						$postTypeName
					),
					'property_name' => 'approving_user',
					'group' => __(
						'Approving user',
						'notification'
					),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\Avatar(
				[
					'slug' => sprintf(
						'%s_approving_user_avatar',
						$this->postType
					),
					'name' => sprintf(
					// translators: singular post name.
						__(
							'%s approving user avatar',
							'notification'
						),
						$postTypeName
					),
					'property_name' => 'approving_user',
					'group' => __(
						'Approving user',
						'notification'
					),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserRole(
				[
					'slug' => sprintf(
						'%s_approving_user_role',
						$this->postType
					),
					'name' => sprintf(
					// translators: singular post name.
						__(
							'%s approving user role',
							'notification'
						),
						$postTypeName
					),
					'property_name' => 'approving_user',
					'group' => __(
						'Approving user',
						'notification'
					),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\DateTime\DateTime(
				[
					'slug' => sprintf(
						'%s_approving_datetime',
						$this->postType
					),
					'name' => sprintf(
					// translators: singular post name.
						__(
							'%s approving date and time',
							'notification'
						),
						$postTypeName
					),
				]
			)
		);
	}
}
