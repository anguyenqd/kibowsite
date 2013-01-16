<?php
class Kent_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract {
	
	protected $_auth;
	protected $_acl;
	
	public function preDispatch(Zend_Controller_Request_Abstract $request) {
		$auth = Zend_Auth::getInstance ();
		$acl = new Kent_Acl ( $auth );
		$this->_auth = $auth;
		$this->_acl = $acl;
		
		if ($this->_auth->hasIdentity ()) {
			
			$role_id = $this->_auth->getIdentity ()->user_group_id; // lấy role từ database
			
			switch ($role_id) {
				case 1 :
					$role = 'guest';
					break;
				case 2 :
					$role = 'member';
					break;
				case 3 :
					$role = 'administrator';
					break;
			
			}			
		} else {
			
			$role = 'guest';
		}
		
		$controller = $request->getParam ( 'controller' );
		
		$action = $request->getParam ( 'action' );
		
		if ($this->_acl->isAllowed ( $role, $controller, $action )) {			
			echo 'Permisstion ok';
		} else {
			echo 'Permission deny.';
		}
		
		$request = $this->getRequest ();
		
		// Acl check
		if (! $this->_acl->isAllowed ( $role, $controller, $action )) {
			if ($this->_auth->hasIdentity ()) {
				$request->setModuleName('error');
				$request->setControllerName ( 'error' );
				$request->setActionName ( 'error' );
			} else { // bắt login
				//$request->setModuleName('user');
				$request->setControllerName ( 'user' );
				$request->setActionName ( 'sign-in' );
 			}
		}
	}
}