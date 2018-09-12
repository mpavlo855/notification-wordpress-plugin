<?php
/**
 * Plugin trigger abstract
 *
 * @package notification
 */

namespace BracketSpace\Notification\Defaults\Trigger\Plugin;

use BracketSpace\Notification\Abstracts;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Plugin trigger class
 */
abstract class PluginTrigger extends Abstracts\Trigger {

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		$this->add_merge_tag( new MergeTag\StringTag( array(
			'slug'        => 'plugin_name',
			'name'        => __( 'Plugin name', 'notification' ),
			'description' => __( 'Akismet', 'notification' ),
            'example'     => true,
			'resolver'    => function( $trigger ) {
				return $trigger->plugin['Name'];
			},
		) ) );

		$this->add_merge_tag( new MergeTag\StringTag( array(
			'slug'        => 'plugin_author_name',
			'name'        => __( 'Plugin author name', 'notification' ),
			'description' => __( 'Automattic', 'notification' ),
            'example'     => true,
            'resolver'    => function( $trigger ) {
				return $trigger->plugin['AuthorName'];
			},
		) ) );

		$this->add_merge_tag( new MergeTag\StringTag( array(
			'slug'        => 'plugin_version',
			'name'        => __( 'Plugin version', 'notification' ),
			'description' => __( '1.0.0', 'notification' ),
			'example'     => true,
			'resolver'    => function( $trigger ) {
				return $trigger->plugin['Version'];
			},
		) ) );

		$this->add_merge_tag( new MergeTag\StringTag( array(
			'slug'        => 'plugin_url',
			'name'        => __( 'Plugin adress URL', 'notification' ),
			'description' => __( 'http://example.com', 'notification' ),
			'example'     => true,
			'resolver'    => function( $trigger ) {
				return $trigger->plugin['PluginURI'];
			},
		) ) );

	}
}
