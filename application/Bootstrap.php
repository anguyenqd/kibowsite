<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	
	protected function _initDoctype() {
		$this->bootstrap ( 'view' );
		$view = $this->getResource ( 'view' );
		$view->doctype ( 'XHTML1_TRANSITIONAL' );
	
	}
	
	// create global varriable to store database information
	protected function _initDatabase() {
		$db = $this->getPluginResource ( 'db' )->getDbAdapter ();
		Zend_Registry::set ( 'db', $db );
	}
	
	protected function _initAutoload() {
		
		$autoLoader = Zend_Loader_Autoloader::getInstance ();
		$resourceLoader = new Zend_Loader_Autoloader_Resource ( array (
				'basePath' => APPLICATION_PATH,
				'namespace' => '',
				'resourceTypes' => array (
						//default bootstrap
						'default_model' => array (
								'path' => 'modules/default/models/',
								'namespace' => 'Model_'
						),
						'dante_thumbnail' => array (
								'path' => '../library/Dante/Thumbnail/',
								'namespace' => 'Dante_Thumbnail_'
						),
						//cp bootstrap
						'cp_model' => array (
								'path' => 'modules/cp/models/',
								'namespace' => 'Cp_Model_'
						),
						'cp_form' => array (
								'path' => 'modules/cp/forms/',
								'namespace' => 'Cp_Form_'
						),
						
						'form' => array (
								'path' => 'forms/',
								'namespace' => 'Form_' 
						),
						'kent_plugin' => array (
								'path' => '../library/Kent/Controller/Plugin/',
								'namespace' => 'Kent_Controller_Plugin_'
						)
				) 
		) );
		
		$front = Zend_Controller_Front::getInstance ();
		$front->registerPlugin ( new Zend_Controller_Plugin_ErrorHandler ( array (
				'module' => 'error',
				'controller' => 'error',
				'action' => 'error' 
		) ) );
		
		return $autoLoader;
	}
	
	

}