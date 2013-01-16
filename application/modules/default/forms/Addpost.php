<?php
class Form_Addpost extends Zend_Form {
	public function init() {
		$this->setAction ( '' )->setMethod ( 'post' );
		$this->setAttrib ( 'enctype', 'multipart/form-data' );
		
		// Post picture element
		$postPicture = $this->createElement ( 'file', 'flPostPicture' );
		// add size validate
		$postPicture->addValidator ( 'FilesSize', false, array (
				'min' => '1kB',
				'max' => '4MB' 
		) );
		// add Extension is image
		$postPicture->addValidator ( 'Extension', false, array (
				'jpg',
				'png',
				'gif',
				'messages' => 'Not valid file type!' 
		) );
		
		// Post caption element
		$postCaption = $this->createElement ( 'textarea', 'txtPostCaption', array (
				'rows' => '4',
				'cols' => '8' 
		) );
		// add validate
		$postCaption->setRequired ( true )->addValidator ( 'NotEmpty', true, array (
				'messages' => 'Post capton could not be empty' 
		) );
		
		// post status
		$postStatus = $enabled = $this->createElement ( 'radio', 'rdStatus' )->setMultiOptions ( array (
				'1' => 'yes',
				'0' => 'no' 
		) )->setSeparator ( '' )->setValue ( "1" );
		
		$submit = $this->createElement ( "submit", "btnSubmit", array (
				"label" => "Submit" 
		) );
		$postStatus->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$postStatus->removeDecorator ( 'Errors' );
		$postPicture->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$postPicture->removeDecorator ( 'Errors' );
		$postCaption->removeDecorator ( 'HtmlTag' )->removeDecorator ( 'Label' );
		$postCaption->removeDecorator ( 'Errors' );
		$submit->removeDecorator ( 'DtDdWrapper' );
		
		$this->addElements ( array (
				$postPicture,
				$postCaption,
				$postStatus,
				$submit 
		) );
		
		$this->setDecorators ( array (
				array (
						'viewScript',
						array (
								'viewScript' => 'post/Form_add_post.phtml' 
						) 
				) 
		) );
	}
}