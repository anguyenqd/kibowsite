<?php
class Form_UploadFile_UploadFile{
    public $_upload;
    public function __construct(){
        $this->_upload = new Zend_File_Transfer;
        $this->_upload->setDestination(APPLICATION_PATH.'/../public/upload/');
    }
}