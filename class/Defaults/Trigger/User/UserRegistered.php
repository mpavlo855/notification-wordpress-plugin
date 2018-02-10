<?php
/**
 * User registration trigger
 */

namespace underDEV\Notification\Defaults\Trigger\User;

use underDEV\Notification\Defaults\MergeTag;
use underDEV\Notification\Abstracts;

class UserRegistered extends Abstracts\Trigger {

	public function __construct() {

		parent::__construct( 'wordpress/user_registered', 'User registration' );

		$this->add_action( 'user_register', 10, 2 );
		$this->set_group( 'User' );
		$this->set_description( 'Fires when user registers new account' );

	}

	public function action() {

		$this->user_id = $this->callback_args[1]->ID;
		$this->user_object = get_userdata( $this->user_id );
		$this->user_meta = get_user_meta( $this->user_id );

	}

	public function merge_tags() {

		$this->add_merge_tag( new MergeTag\User\UserID( $this ) );

    	$this->add_merge_tag( new MergeTag\User\UserLogin( $this ) );

        $this->add_merge_tag( new MergeTag\User\UserEmail( $this ) );

		$this->add_merge_tag( new MergeTag\User\UserRegistered( $this ) );

		$this->add_merge_tag( new MergeTag\User\UserRole( $this ) );


    }

}
