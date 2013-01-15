<?php

class Cp_IndexController extends Zend_Controller_Action {
	
	public function init() {
		$option = array (
				"layout" => "layout",
				"layoutPath" => APPLICATION_PATH . "/layouts/scripts/cp" 
		);
		Zend_Layout::startMvc ( $option );
	}
	public function indexAction() {
		
	}
}