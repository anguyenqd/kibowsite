<?php
class Cp_Form_Editpost extends Zend_Form{
	public function init(){
		$this->setAction('')->setMethod('post');
		$this->setAttrib('enctype','multipart/form-data');
		//old image element
		$oldImage = $this->createElement('image', 'imgOldImage');
		$oldImage->setValue(BASE_PATH . UPLOAD_FOLDER . '/images.jpg');
		//Post picture element
		$postPicture = $this->createElement('file', 'flPostPicture');
		//add size validate
		$postPicture->addValidator('FilesSize',
                      false,
                      array('min' => '10kB', 'max' => '4MB'));
		
		//add Extension is image
		$postPicture->addValidator('Extension',false,array('jpg','png','gif','messages' => 'Not valid file type!'));
		
		//Post caption element
		$postCaption = $this->createElement('textarea','txtPostCaption',array(
																			'rows'=>'4',
																			'cols' => '8'	
		));
		//add validate
		$postCaption->setRequired(true)->addValidator('NotEmpty',true,array('messages' => 'Post capton could not be empty'));
		//post status
		$postStatus = $this->createElement('radio', 'rdStatus')
		->setMultiOptions(array('1'=>'yes', '0'=>'no'))
		->setSeparator('')
		->setValue("1");
		
		$postIDHIdden = $this->createElement('hidden', 'hdPostID', array('value' => '0'));
		$postOldImageHidden = $this->createElement('hidden', 'hdOldImage', array('value' => '0'));
		
		$submit = $this->createElement("submit", "btnSubmit",array("label" => "Submit"));
		$postStatus->removeDecorator('HtmlTag')->removeDecorator('Label');
		$postStatus->removeDecorator('Errors');
		$oldImage->removeDecorator('HtmlTag');
		$oldImage->removeDecorator('Errors');
		$postPicture->removeDecorator('HtmlTag');
		$postPicture->removeDecorator('Errors');
		$postCaption->removeDecorator('HtmlTag')->removeDecorator('Label');
		$postCaption->removeDecorator('Errors');
		$submit->removeDecorator('DtDdWrapper');
		
		$this->addElements(array($oldImage,$postPicture,$postCaption,$postStatus,$postIDHIdden,$postOldImageHidden,$submit));
		
		$this->setDecorators(array(
				array('viewScript',
						array('viewScript' => 'post/Form_edit_post.phtml')
				)
		));
	}
}
