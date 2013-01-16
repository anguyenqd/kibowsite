<?php
class Kent_Acl extends Zend_Acl {
	public function __construct(Zend_Auth $auth) {
		$this->add ( new Zend_Acl_Resource ( 'index' ) );
		$this->add ( new Zend_Acl_Resource ( 'error' ) );		
		$this->add ( new Zend_Acl_Resource ( 'user' ) );
		$this->add ( new Zend_Acl_Resource ( 'post' ) );
		
		$this->addRole ( new Zend_Acl_Role ( 'guest' ) );
		$this->addRole ( new Zend_Acl_Role ( 'member' ), 'guest' );
		$this->addRole ( new Zend_Acl_Role ( 'administrator' ), 'member' );
		
		$this->allow ( 'guest', 'index', null );
		$this->allow ( 'guest', 'post', null );
		$this->allow ( 'administrator', 'user', array ( 
				'list','delete-user', 
				'send-invitation',
				'send-invitation-success' ) );
		$this->allow ( 'guest', 'user', array( 'sign-in', 'sign-out', 'edit', 'register', 'register-success' ) );
		$this->allow ( 'member', 'user', array( 'index' ) );

	
	}
}