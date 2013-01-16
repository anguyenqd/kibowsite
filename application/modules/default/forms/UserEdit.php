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
						'filters' => array (
								'StringTrim',
								'StripTags'
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
		
		$currentAvatar = $this->createElement('image', 'currentAvatar');
		$currentAvatar->setAttrib('src', BASE_PATH . '/' .  UPLOAD_FOLDER . '/noimg.jpg');
		
		$avatar = $this->createElement( 'file', 'attachment', array( 'class' => 'inputilfe' ) );
		$avatar->setLabel('Attach a file');
		$avatar->setRequired(FALSE);
		// specify the path to the upload folder. this should not be publicly
		// accessible!
		$avatar->setDestination(UPLOAD_PATH);
		// ensure that only 1 file is uploaded
		// ensure minimum 1, maximum 3 files
		$avatar->addValidator('Count', false,
				array('min' => 0, 'max' => 10));
		$avatar->setMultiFile(1);
		$avatar->addValidator('Size', false, 204800);
		$avatar->addValidator('Extension', false, 'jpg,png,gif');
		$avatar->addErrorMessage ( 'Avatar must be have Extension: jpg,png,gif and less than 2Mb.' );
		$avatar->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$avatar->removeDecorator ( 'Errors' );
		$this->setAttrib('enctype', 'multipart/form-data');
		
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
				$address, $phone, $displayName, $currentAvatar, $avatar, $biography, 
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