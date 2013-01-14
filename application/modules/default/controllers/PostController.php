<?php

/**
 * @author Dante Nguyen
 * 
 */
class PostController extends Zend_Controller_Action {
	public function init() {
		$option = array (
				"layout" => "layout",
				"layoutPath" => APPLICATION_PATH . "/layouts/scripts/default" 
		);
		Zend_Layout::startMvc ( $option );
	}
	public function indexAction() {
		$baseurl=$this->_request->getbaseurl();
		$this->view->headTitle("Kibow site");
		$this->view->headLink()->appendStylesheet($baseurl . "/css/reset.css");
		$this->view->headLink()->appendStylesheet($baseurl . "/css/colorbox.css");
		$this->view->headLink()->appendStylesheet($baseurl . "/css/layout.css");
		$this->view->headLink()->appendStylesheet($baseurl . "/css/ie.css", "all","ie");
		$this->view->headscript()->appendFile($baseurl . "/js/jquery-1.8.3.min.js","text/javascript");
		$this->view->headscript()->appendFile($baseurl . "/js/jquery.masonry.min.js","text/javascript");
		$this->view->headscript()->appendFile($baseurl . "/js/jquery.colorbox-min.js","text/javascript");
		$this->view->headscript()->appendFile($baseurl . "/js/controllAll.js","text/javascript");
		
		
		$paginator = $this->_loadPostList();
		
	}
	
	public function listPostAction()
	{
		$this->_loadPostList();
	}
	
	public function imagePopUpAction() {
		$this->_helper->layout()->disableLayout();
		$modelPost = new Model_post();
		$post = $modelPost-> getPostById($this->_request->getParam('id'));		
		$this->view->postInfo = $post[0];
	}
	
	public function addAction() {
		$addPostForm = new Form_Addpost();
		if($this->_request->getPost())
		{
			$data = $this->_request->getPost();
			$upload = new Form_UploadFile_UploadFile();
			$files = $upload->_upload->getFileInfo();
			
			if(!$addPostForm->isValid($data))//Invalid
			{
				$this->view->form = $addPostForm;
			}else//Valid
			{
				try {
					$postPicture = 'N/A';
					//check file upload
					$timestampNow = time();
					foreach($files as $file=>$info){
						if($upload->_upload->isUploaded($file)){
							//change file name before upload - file name will be timestamp + orginalName
							$oginalFileName = pathinfo($upload->_upload->getFileName());
							$newFileName = 'file-'.$timestampNow.'-'. rand(11111111,99999999).'.'.$oginalFileName['extension'];
							$upload->_upload->addFilter("Rename",$newFileName);
							$upload->_upload->receive();
							$postPicture = $newFileName;
							//create thumbnail
							$thumb = Dante_Thumbnail_PhpThumbFactory::create(UPLOAD_PATH . '/' . $newFileName);
							$thumb->resize(THUMBNAIL_WITDH,THUMBNAIL_HEIGHT);
							$thumb->save(THUMBNAIL_FOLDER . '/' . THUMBNAIL_NAME . $newFileName);
							//create thumbnail
							//$thumb = new PhpThumbFactory();
							//$thumb->re
						}
					}
					
					//Insert to database
					$postCaption = $this->_request->getPost('txtPostCaption');
					$postStatus = $this->_request->getPost('rdStatus');
					$user_id = 1;//dump user
					$languageId = 1;
					$mpost = new Model_post();
					$arr_data = array(
							'post_picture' => $postPicture,
							'post_caption' => $postCaption,
							'post_time' => $timestampNow,
							'user_id' => $user_id,
							'post_status' => $postStatus,
							'language_id' => $languageId
					); 
					$result = $mpost->addNewPost($arr_data);
					if($result != 0)
					{
						$this->view->mess = 'success';
					}else
					{
						$addPostForm->addErrorMessage("Can not add new post!");
					}
					
				}catch(Zend_Exception $e)
				{
					echo "Caught exception: " . get_class($e) . "\n";
					echo "Message: " . $e->getMessage() . "\n";
				}
			}
		}
		$this->view->form = $addPostForm;
		
	}
	
	/**
	 * Load a post for edit
	 */
	private function _loadPost()
	{
		
	}
	
	/**
	 * Load a post list for view 
	 */
	private function _loadPostList()
	{	
		$mpost = new Model_post();
		$paginator = Zend_Paginator::factory($mpost->getPosts(null, array('field' => 'post_time', 'dir' => 'DESC')));
		$paginator->setItemCountPerPage(PAGING_ITEM_LIMIT);
		$paginator->setPageRange(PAGING_RANGE_LIMIT);
		$currentPage = $this->_request->getParam('page',1);
		$paginator->setCurrentPageNumber($currentPage);
		$this->view->data=$paginator;
	}
	
	public function editAction () {
		$mpost = new Model_post();
		//create form
		$meditpost = new Form_Editpost();
		$user_id = 1;
		if($this->_request->getPost())
		{
			$data = $this->_request->getPost();
			$actionName = $this->_request->getPost('txtActionName');
			$this->view->form = $meditpost;
			if($actionName == 'edit-step-1')
			{
				$postID = $this->_request->getPost('txtArticelID');
				
				//load post information
				$arr_colums = array('post_id',
									'post_picture',
									'post_caption',
									'post_time',
									'user_id',
									'post_status',
									'language_id');
				$oldPostData = $mpost->getPost($user_id, $postID, $arr_colums);
				$postPicture = "";
				$postCaption = "";
				$postStatus = "";
				foreach ($oldPostData as $postData)
				{
					$postPicture = $postData['post_picture'];
					$postCaption = $postData['post_caption'];
					$postStatus = $postData['post_status'];
				}
				//set data to form
				if($postPicture != 'N/A')
					$this->view->form->imgOldImage->setImage(BASE_PATH . '/' . UPLOAD_FOLDER . '/' . $postPicture);
				else
					$this->view->form->imgOldImage->setImage(BASE_PATH . '/' . UPLOAD_FOLDER . '/images.jpg');
				$this->view->form->txtPostCaption->setValue($postCaption);
				$this->view->form->rdStatus->setValue($postStatus);
				$this->view->form->hdPostID->setValue($postID);
				$this->view->form->hdOldImage->setValue($postPicture);
				
			}else if($actionName == 'edit-step-2')
			{
				if(!$meditpost->isValid($data))//Invalid
				{
					$this->view->form = $meditpost;
				}else//Valid
				{
					try{
						$upload = new Form_UploadFile_UploadFile();
						$files = $upload->_upload->getFileInfo();
						$postPicture = 'N/A';
						$oldImage = $this->_request->getPost('hdOldImage');
						//check file upload
						foreach($files as $file=>$info){
							if($upload->_upload->isUploaded($file)){
								//change file name before upload - file name will be timestamp + orginalName
								$oginalFileName = pathinfo($upload->_upload->getFileName());
								$timestampNow = time();
								$newFileName = 'file-'.$timestampNow.'-'. rand(11111111,99999999).'.'.$oginalFileName['extension'];
								$upload->_upload->addFilter("Rename",$newFileName);
								$upload->_upload->receive();
								
								if($oldImage != 'N/A')
								{
									//delete old image
									unlink(UPLOAD_PATH . '/' . $oldImage);
									//delete old thumbnail
									unlink(THUMBNAIL_FOLDER . '/' . THUMBNAIL_NAME . $oldImage);
								}
								$postPicture = $newFileName;
								//create thumbnail
								$thumb = Dante_Thumbnail_PhpThumbFactory::create(UPLOAD_PATH . '/' . $newFileName);
								$thumb->resize(200,200);
								$thumb->save(THUMBNAIL_FOLDER . '/' . THUMBNAIL_NAME . $newFileName);
							}else
							{
								$postPicture = $oldImage;
							}
						}

						$mmorepost = new Model_morepost();
						$postID = $this->_request->getPost('hdPostID');
						$postCaption = $this->_request->getPost('txtPostCaption');
						$postStatus = $this->_request->getPost('rdStatus');
						$arr_data = array('post_picture' => $postPicture,
										'post_caption' => $postCaption,
										'post_status' => $postStatus);
						
						$result = $mmorepost->editPost($arr_data, $user_id, $postID);
						//$this->view->mess = "success";
						$this->getResponse()->setRedirect(BASE_PATH . "/post/");
					}catch(Zend_Exception $e)
					{
						echo "Caught exception: " . get_class($e) . "\n";
						echo "Message: " . $e->getMessage() . "\n";
					}
				}
			}else
			{
				$this->getResponse()->setRedirect(BASE_PATH . "/post/");
			}
		}else
		{
			$this->getResponse()->setRedirect(BASE_PATH . "/post/");
		}
		
	}
	
	public function deleteAction () {
		//Delete
		if($this->_request->getPost())
		{
			$postId = $this->_request->getPost('txtArticelID');
			$postImage = $this->_request->getPost('txtPostImage');
			$mpost = new Model_post();
			$arr_id = array($postId);
			$user_id = 1;
			$arr_add_condition = array($user_id => array("colum" => "user_id","operater" => "="));
			$result = $mpost->deletePost($arr_id, $arr_add_condition);
			if($result > 0)
			{
				//Success
				unlink($postImage);
				$this->getResponse()->setRedirect(BASE_PATH . "/post/");
			}else
			{
				//Error
			}
			
		}
	}
}