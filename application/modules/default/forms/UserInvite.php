<?php
class Form_UserInvite extends Zend_Form {
	
	public function init() {
		
		$this->setAction ( '' )->setMethod ( 'post' );
		
		$name = $this->createElement ( "text", "txtName", array (
				'class' => 'textbox',
				'required' => true,
				'filters' => array (
						'StringTrim',
						'StripTags' 
				),
				'validators' => array () 
		) );
		
		$email = $this->createElement ( "text", "txtEmail", array (
				'class' => 'textbox',
				'required' => true,
				'filters' => array (
						'StringTrim',
						'StripTags' 
				),
				'validators' => array (
						'EmailAddress' 
				) 
		) );
		
		$email->addErrorMessage ( 'Please enter valid email.' );
		$email->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$email->removeDecorator ( 'Errors' );
		
		$name->addErrorMessage ( 'Please enter Crew\'s name.' );
		$name->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$name->removeDecorator ( 'Errors' );
		
		$this->addElements ( array (
				$email, $name
		) );
		
		$this->setDecorators ( array (
				array (
						'viewScript',
						array (
								'viewScript' => 'user/_form_send-invitation.phtml' 
						) 
				) 
		) );
	
	}
}