<?php

/**
 * @author Dante Nguyen
 * 
 */
class Cp_PostController extends Zend_Controller_Action {
	public function init() {
		$option = array (
				"layout" => "layout",
				"layoutPath" => APPLICATION_PATH . "/layouts/scripts/cp" 
		);
		Zend_Layout::startMvc ( $option );
	}
	public function indexAction() {
		$this->_loadPostList();
	}
	
	
	public function imagePopUpAction() {
		$this->_helper->layout()->disableLayout();
		$modelPost = new Model_post();
		$post = $modelPost-> getPostById($this->_request->getParam('id'));		
		$this->view->postInfo = $post[0];
	}
	
	public function addAction() {
		$addPostForm = new Cp_Form_Addpost();
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
						$_SESSION['post']['success'] = 'add-success';
						$this->getResponse()->setRedirect(ADMINCP_PATH . "/post/");
					}else
					{
						$_SESSION['post']['fail'] = 'add-fail';
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
		$mpost = new Model_morepost();
		//$paginator = Zend_Paginator::factory($mpost->getPosts(null, array('field' => 'post_time', 'dir' => 'DESC')));
		$arr_cols = array("kb_post.post_picture",
							"kb_post.post_caption",
							"kb_post.post_id",
							"kb_post.post_time",
							"kb_office.office_name");
		$arr_table = array('kb_post','kb_office','kb_user');
		$arr_where = array('kb_user.user_id = ' => 'kb_post.user_id',
							'kb_office.office_id = ' => 'kb_user.office_id');
		$arr_order_by = array('kb_post.post_time' => 'DESC');
		$limit = 0;
		$paginator = Zend_Paginator::factory($mpost->getPostList($arr_cols, $arr_table, $arr_where,$arr_order_by,$limit));
		$paginator->setItemCountPerPage(PAGING_ITEM_LIMIT);
		$paginator->setPageRange(PAGING_RANGE_LIMIT);
		$currentPage = $this->_request->getParam('page',1);
		$paginator->setCurrentPageNumber($currentPage);
		$this->view->data=$paginator;
	}
	
	public function editAction () {
		$mpost = new Model_post();
		$postID = $this->_request->getParam('id');
		if($postID != null){
			//create form
			$meditpost = new Cp_Form_Editpost();
			$user_id = 1;
			$data = $this->_request->getPost();
			$actionName = $this->_request->getPost('txtActionName');
			$this->view->form = $meditpost;
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
			
			if($this->_request->getPost())
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
			
						$mmorepost = new Model_post();
						$postID = $this->_request->getPost('hdPostID');
						$postCaption = $this->_request->getPost('txtPostCaption');
						$postStatus = $this->_request->getPost('rdStatus');
						$arr_data = array('post_picture' => $postPicture,
								'post_caption' => $postCaption,
								'post_status' => $postStatus);
			
						//$result = $mmorepost->editPost($arr_data, $user_id, $postID);
						$result = $mmorepost->updatePost($postID, $arr_data);
						if($result > -1)
						{
							$this->view->mess = "edit-success";
						}else
						{
							$this->view->mess = "edit-fail";
						}
						
					}catch(Zend_Exception $e)
					{
						echo "Caught exception: " . get_class($e) . "\n";
						echo "Message: " . $e->getMessage() . "\n";
					}
				}
			}
		}else 
		{
			$this->getResponse()->setRedirect(ADMINCP_PATH . "/post/");
		}	
	}
	
	public function deleteAction () {
		//Delete
		$postId = $this->_request->getParam('id');
		if($postId != null)
		{
			$mpost = new Model_post();
			$postData = $mpost->getPostById($postId);
			$postImage =  $postData[0]['post_picture'];
			$arr_id = array($postId);
			$arr_add_condition = array($postId => array("colum" => "post_id","operater" => "="));
			$result = $mpost->deletePost($arr_add_condition);
			if($result > 0)
			{
				//Success
				//delete old image
				unlink(UPLOAD_PATH . '/' . $postImage);
				//delete old thumbnail
				unlink(THUMBNAIL_FOLDER . '/' . THUMBNAIL_NAME . $postImage);
				$_SESSION['post']['success'] = "delete-success";
			}else
			{
				//Error
				$_SESSION['post']['fail'] = "delete-fail";
			}
			$this->getResponse()->setRedirect(ADMINCP_PATH . "/post/");
		}else
		{
			$this->getResponse()->setRedirect(ADMINCP_PATH . "/post/");
		}
	}
}