<?php

class IndexController extends Zend_Controller_Action {
	
	public function init() {
		
		
		$option = array (
				"layout" => "layout",
				"layoutPath" => APPLICATION_PATH . "/layouts/scripts/default" 
		);
		Zend_Layout::startMvc ( $option );
	}
	public function indexAction() {
	
	}
}