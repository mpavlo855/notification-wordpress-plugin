<?php
/**
 * Notification functions
 *
 * @package notificaiton
 */

use BracketSpace\Notification\Core\Resolver;
use BracketSpace\Notification\Defaults\Store\Resolver as ResolverStore;
use BracketSpace\Notification\Interfaces;

/**
 * Adds Resolver to Store
 *
 * @since  [Next]
 * @param  Interfaces\Resolvable $resolver Resolver object.
 * @return \WP_Error | true
 */
function notification_register_resolver( Interfaces\Resolvable $resolver ) {

	$store = new ResolverStore();

	try {
		$store[ $resolver->get_slug() ] = $resolver;
	} catch ( \Exception $e ) {
		return new \WP_Error( 'notification_register_resolver_error', $e->getMessage() );
	}

	return true;

}

/**
 * Resolves the value
 *
 * @since [Next]
 * @param string                 $value   Unresolved string with tags.
 * @param Interfaces\Triggerable $trigger Trigger object.
 * @return string                         Resolved value
 */
function notification_resolve( $value, Interfaces\Triggerable $trigger ) {
	$resolver = new Resolver();
	return $resolver->resolve( $value, $trigger );
}
