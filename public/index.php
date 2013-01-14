<?php

// session_start();

date_default_timezone_set ( 'Asia/Ho_Chi_Minh' );

defined ( 'DS' ) || define ( 'DS', DIRECTORY_SEPARATOR );

defined ( 'APPLICATION_PATH' ) || define ( 'APPLICATION_PATH', realpath ( dirname ( __FILE__ ) . DS . '..' . DS . 'application' ) );

defined ( 'APPLICATION_ENV' ) || define ( 'APPLICATION_ENV', (getenv ( 'APPLICATION_ENV' ) ? getenv ( 'APPLICATION_ENV' ) : 'development') );

defined ( 'UPLOAD_FOLDER' ) || define ( 'UPLOAD_FOLDER', 'upload' );

defined ( 'UPLOAD_PATH' ) || define ( 'UPLOAD_PATH', (dirname ( __FILE__ ) . DS . UPLOAD_FOLDER) );

defined ( 'BASE_PATH' ) || define ( 'BASE_PATH', 'http://localhost/kb_zendtemp/public' );

defined ( 'SYS_EMAIL' ) || define ( 'SYS_EMAIL', 'vuongngocnam@gmail.com' );

defined ( 'PAGING_ITEM_LIMIT' ) || define ( 'PAGING_ITEM_LIMIT', 10);

defined ( 'PAGING_RANGE_LIMIT' ) || define ( 'PAGING_RANGE_LIMIT', 3);

/**
 * Phân cách giữa các giá trị nếu giá trị là mảng
 */
defined ( 'VAR_BREAK' ) || define ( 'VAR_BREAK', '&varbreak;' );

/**
 * Phân cách giữa các field giá trị
 */
defined ( 'FIELD_BREAK' ) || define ( 'FIELD_BREAK', '&fieldbreak;' );

/**
 * Tương đương dấu : phần giữa định nghĩa và giá trị.
 */
defined ( 'IS' ) || define ( 'IS', '&:;' );

set_include_path ( implode ( PATH_SEPARATOR, array (
		dirname ( dirname ( __FILE__ ) ) . DS . 'library',
		get_include_path (),
		(APPLICATION_PATH . DS . 'models') 
) ) );


require_once 'Zend/Application.php';

$application = new Zend_Application ( APPLICATION_ENV, APPLICATION_PATH . DS . 'configs' . DS . 'application.ini' );

$FrontController = Zend_Controller_Front::getInstance ();
$application->bootstrap ()->run ();
                
                
                