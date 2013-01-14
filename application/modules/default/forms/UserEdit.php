<?php
class Form_UserEdit extends Zend_Form {
	
	public function init() {
		
		$this->setAction ( '' )->setMethod ( 'post' );
		
		$email = $this->createElement ( "text", "txtEmail", array (
				'class' => 'textboxdsdf',
				'attribs' => array('readonly' => true),
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
		
		$password_old = $this->createElement (
				'password',
				'txtPasswordOld',
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
		$password_old->addErrorMessage ( 'Old password is required and must be from 3 to
				30 characters.' );
		$password_old->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$password_old->removeDecorator ( 'Errors' );
		
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
		
		$password_confirm = $this->createElement ( 
				'password', 
				'txtPasswordConfirm',
				array ( 
						'class' => 'textbox',
						'required' => true,
						'filters' => array (
								'StringTrim',
								'StripTags'
						),
						'validators' => array (
								new Zend_Validate_StringLength (
										array ( 'min' => 3, 'max' => 30 ) ),
								array (
										'identical', 
										false, 
										array ( 'token' => 'txtPassword' ) )
						)
		));
		$password_confirm->addErrorMessage ( 'Password confirm must be matched with password.' );
		$password_confirm->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$password_confirm->removeDecorator ( 'Errors' );
				
		$address = $this->createElement ( "text", "txtAddress", array (
				'class' => 'textbox',
				'filters' => array (
						'StringTrim'
				),
		) );
		$address->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$address->removeDecorator ( 'Errors' );
		
		$phone = $this->createElement ( "text", "txtPhone", array (
				'class' => 'textbox',
				'filters' => array (
						'StringTrim'
				),
		) );
		$phone->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$phone->removeDecorator ( 'Errors' );
		
		$displayName = $this->createElement ( "text", "txtDisplayName", array (
				'class' => 'textbox',
				'required' => true,
				'filters' => array (
						'StringTrim'
				),
		) );
		$displayName->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$displayName->removeDecorator ( 'Errors' );
		
		$biography = $this->createElement ( "text", "txtBiography", array (
				'class' => 'textbox',
				'filters' => array (
						'StringTrim'
				),
		) );
		$biography->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$biography->removeDecorator ( 'Errors' );
		
		$twitter = $this->createElement ( "text", "txtTwitter", array (
				'class' => 'textbox',
				'filters' => array (
						'StringTrim'
				),
		) );
		$twitter->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$twitter->removeDecorator ( 'Errors' );
		
		$facebook = $this->createElement ( "text", "txtFacebook", array (
				'class' => 'textbox',
				'filters' => array (
						'StringTrim'
				),
		) );
		$facebook->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$facebook->removeDecorator ( 'Errors' );
		
		$privacyStatus = $this->createElement ( 
				'select',
				'slPrivacyStatus',
				array ( 'class' => 'select',
						'multiOptions' => array(
					        'private' => 'Only owner',
					        'contactList' => 'Visible for contacts',
					        'public' => 'Public'
    	)));
		$privacyStatus->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$privacyStatus->removeDecorator ( 'Errors' );
		
		
		$this->addElements ( array (
				$email, $password_old, $password, $password_confirm,
				$address, $phone, $displayName, $biography, 
				$twitter, $facebook, $privacyStatus
		) );
		
		$this->setDecorators ( array (
				array (
						'viewScript',
						array (
								'viewScript' => 'user/_form_edit.phtml' 
						) 
				) 
		) );
	
	}
}