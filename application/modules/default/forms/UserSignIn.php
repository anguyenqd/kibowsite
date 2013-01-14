<?php
class Form_UserSignIn extends Zend_Form {
	
	public function init() {
		
		$this->setAction ( '' )->setMethod ( 'post' );
		
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
		
		$password = $this->createElement ( 
				'password',
				'txtPassword',
				array ( 'class' => 'textbox',
						'required' => true,
						'filters' => array (
								'StringTrim',
								'StripTags'
						),
						'validators' => array (
								new Zend_Validate_StringLength ( 
										array ( 'min' => 3, 'max' => 30 ) )		 
						)
		));
		$password->addErrorMessage ( 'Password is required and must be from 3 to 
									  30 characters.' );
		$password->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$password->removeDecorator ( 'Errors' );
		
		
		
		$this->addElements ( array (
				$email, $password
		) );
		
		$this->setDecorators ( array (
				array (
						'viewScript',
						array (
								'viewScript' => 'user/_form_sign-in.phtml' 
						) 
				) 
		) );
	
	}
}