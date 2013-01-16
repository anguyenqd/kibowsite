<?php

class Kent_Helpers {
	
	/*
	 * Author(s): Lucky Spadille <spadille.lucky@gmail.com> website:
	 * http://my.opera.com/spadille/blog/ @param string directory path, where
	 * store file upload @param string override|rename return array An array
	 * store file name
	 */
	/**
	 *
	 * @param string $dir_upload
	 *        	Full path to upload folder
	 * @param string $option
	 *        	rename | override
	 * @return array Filenames are uploaded
	 */
	public function upload($dir_upload, $option = 'rename') {
		
		
		$upload = new Zend_File_Transfer_Adapter_Http ();
		$upload->setDestination ( $dir_upload );
		$files = $upload->getFileInfo ();
		
		$arrFileName = array ();
		$countFileUpload = count ( $files );
		
		if ($countFileUpload > 0) {
			
			foreach ( $files as $file => $info ) {
				
				if ($info ['name'] != '') {
					
					$validator = new Zend_Validate_File_Exists ( $dir_upload );
					if ($option == 'rename') {
						
						$arrFileName [$file] = $info ['name'];
						$real_name = $info ['name'];
						if ($validator->isValid ( $info ['name'] )) {
							
							$file_path = $upload->getFileName ( $info ['name'] );
							
							preg_match ( '/\.([^\.]+)$/', $file_path, $matches );
							$file_ext = $matches [1];
							$file_name = substr ( $info ['name'], 0, strrpos ( $info ['name'], '.' ) );
							$real_name = $file_name . '.' . $file_ext;
							
							if ($countFileUpload > 1) {
								$temp_name = $this->filterFilename ( $real_name );
								while ( file_exists ( $dir_upload . '/' . $temp_name ) ) {
									$temp_name = $file_name . '_' . rand ( 1, 100000000000 ) . '.' . $file_ext;
								}
								
								$real_name = $temp_name;
							} else {
								$temp_name = $this->FilterFilename ( $real_name );
								while ( file_exists ( $dir_upload . '/' . $temp_name ) ) {
									$temp_name = $file_name . '_' . rand ( 1, 100000000000 ) . '.' . $file_ext;
								}
								
								$real_name = $temp_name;
							
							}
							$arrFileName [$file] = $real_name;
						
						}
						$upload->addFilter ( 'Rename', $dir_upload . '/' . $real_name );
					} else {
						$arrFileName [$file] = $info ['name'];
					}
					$upload->receive ( $file );
				
				}
			}
		}
		
		return $arrFileName;
	}
	
	/**
	 *
	 * @param
	 *        	Filename string $str
	 *        	
	 * @return string Filenam after filter
	 */
	public function filterFilename($str) {
		$str = preg_replace ( "/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str );
		$str = preg_replace ( "/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str );
		$str = preg_replace ( "/(ì|í|ị|ỉ|ĩ)/", 'i', $str );
		$str = preg_replace ( "/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str );
		$str = preg_replace ( "/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str );
		$str = preg_replace ( "/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str );
		$str = preg_replace ( "/(đ)/", 'd', $str );
		$str = preg_replace ( "/(A|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $str );
		$str = preg_replace ( "/(E|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $str );
		$str = preg_replace ( "/(I|Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $str );
		$str = preg_replace ( "/(O|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str );
		$str = preg_replace ( "/(U|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $str );
		$str = preg_replace ( "/(Y|Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str );
		
		$str = preg_replace ( "/(Đ|D)/", 'd', $str );
		$str = preg_replace ( "/(B)/", 'b', $str );
		$str = preg_replace ( "/(C)/", 'c', $str );
		$str = preg_replace ( "/(F)/", 'f', $str );
		$str = preg_replace ( "/(G)/", 'g', $str );
		$str = preg_replace ( "/(H)/", 'h', $str );
		$str = preg_replace ( "/(J)/", 'j', $str );
		$str = preg_replace ( "/(K)/", 'k', $str );
		$str = preg_replace ( "/(L)/", 'l', $str );
		$str = preg_replace ( "/(M)/", 'm', $str );
		$str = preg_replace ( "/(N)/", 'n', $str );
		$str = preg_replace ( "/(P)/", 'p', $str );
		$str = preg_replace ( "/(Q)/", 'q', $str );
		$str = preg_replace ( "/(V)/", 'v', $str );
		$str = preg_replace ( "/(W)/", 'w', $str );
		$str = preg_replace ( "/(T)/", 't', $str );
		$str = preg_replace ( "/(S)/", 's', $str );
		$str = preg_replace ( "/(X)/", 'x', $str );
		$str = preg_replace ( "/(Z)/", 'z', $str );
		// --->>> Thay ki tu dat biet
		$str = preg_replace ( '/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/', '-', $str );
		
		$str = preg_replace ( "/-+-/", '-', $str ); // Thay the -- thanh -
		$str = preg_replace ( '/^\-+|\-+$/', '', $str );
		return $str;
	}
	
	/**
	 *
	 * @param string $img_str
	 *        	Images name
	 * @return array Images name
	 */
	public function toImgArr($img_str) {
		$result = array ();
		$imgArr = explode ( FIELD_BREAK, $img_str );
		foreach ( $imgArr as $img ) {
			if ($img != '' && $img != 'noimg.png') {
				$result [] = $img;
			}
		}
		return $result;
	}
	
	/**
	 * Convert array Images' name to String Images' name
	 *
	 * @param array $img_arr        	
	 * @return string Images' name
	 */
	public function toImgStr($img_arr) {
		$img_count = count ( $img_arr );
		$img_str = '';
		
		foreach ( $img_arr as $img ) {
			
			$img_str .= $img . FIELD_BREAK;
		
		}
		return $img_str;
	}
	
	/**
	 * Filter character in URL string
	 *
	 * @param string $str        	
	 * @return string
	 */
	public function filterUrlParam($str) {
		$str = preg_replace ( "/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str );
		$str = preg_replace ( "/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str );
		$str = preg_replace ( "/(ì|í|ị|ỉ|ĩ)/", 'i', $str );
		$str = preg_replace ( "/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str );
		$str = preg_replace ( "/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str );
		$str = preg_replace ( "/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str );
		$str = preg_replace ( "/(đ)/", 'd', $str );
		$str = preg_replace ( "/(A|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $str );
		$str = preg_replace ( "/(E|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $str );
		$str = preg_replace ( "/(I|Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $str );
		$str = preg_replace ( "/(O|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str );
		$str = preg_replace ( "/(U|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $str );
		$str = preg_replace ( "/(Y|Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str );
		
		$str = preg_replace ( "/(Đ|D)/", 'd', $str );
		$str = preg_replace ( "/(B)/", 'b', $str );
		$str = preg_replace ( "/(C)/", 'c', $str );
		$str = preg_replace ( "/(F)/", 'f', $str );
		$str = preg_replace ( "/(G)/", 'g', $str );
		$str = preg_replace ( "/(H)/", 'h', $str );
		$str = preg_replace ( "/(J)/", 'j', $str );
		$str = preg_replace ( "/(K)/", 'k', $str );
		$str = preg_replace ( "/(L)/", 'l', $str );
		$str = preg_replace ( "/(M)/", 'm', $str );
		$str = preg_replace ( "/(N)/", 'n', $str );
		$str = preg_replace ( "/(P)/", 'p', $str );
		$str = preg_replace ( "/(Q)/", 'q', $str );
		$str = preg_replace ( "/(V)/", 'v', $str );
		$str = preg_replace ( "/(W)/", 'w', $str );
		$str = preg_replace ( "/(T)/", 't', $str );
		$str = preg_replace ( "/(S)/", 's', $str );
		$str = preg_replace ( "/(X)/", 'x', $str );
		$str = preg_replace ( "/(Z)/", 'z', $str );
		
		// --->>> Thay ki tu dat biet
		$str = preg_replace ( '/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/', '-', $str );
		$str = preg_replace ( '/-+-/', '-', $str ); // Thay the -- thanh -
		$str = preg_replace ( '/^\-+|\-+$/', '', $str );
		
		return $str;
	
	}
	
	public function jsAlert($string) {
		?>
<script type="text/javascript">
        alert("<?php echo $string; ?>");
        </script>
<?php
	}
}