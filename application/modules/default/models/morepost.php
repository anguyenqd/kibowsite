<?php
class Model_morepost {
	protected $db;
	public function __construct() {
		$this->db = Zend_Registry::get ( 'db' );
	}
	public function getPostInfo($user_id, $post_id) {
		$sql = $this->db->query ( "select * from user order by id DESC" );
		return $sql->fetchAll ();
	}
	public function editPost($arr_data, $user_id, $post_id) {
		$sql = "UPDATE kb_post SET ";
		$i = 1;
		foreach ( $arr_data as $k => $v ) {
			$sql .= $k . " = '" . $v . "' ";
			if ($i < count ( $arr_data ))
				$sql .= " , ";
			$i ++;
		}
		$sql .= " WHERE post_id = " . $post_id . " AND user_id = " . $user_id;
		
		$result = $this->db->query ( $sql );
		$rowCount = $result->rowCount ();
		return $rowCount;
	}
}