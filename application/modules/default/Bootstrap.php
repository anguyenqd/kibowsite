<?php

class Default_Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	protected function _initAutoload() {
		
		$autoLoader = Zend_Loader_Autoloader::getInstance ();
		$resourceLoader = new Zend_Loader_Autoloader_Resource ( array (
				'basePath' => APPLICATION_PATH,
				'namespace' => '',
				'resourceTypes' => array (
						
						'model_reference_code' => array (
								'path' => 'modules/default/models/',
								'namespace' => 'Model_'
						),
						'form_invitation' => array (
								'path' => 'modules/default/forms/',
								'namespace' => 'Form_'
						),
						'kent' => array (
								'path' => '../library/Kent/',
								'namespace' => 'Kent_'
						)
				) 
		) );
		
		return $autoLoader;
	}
	
}