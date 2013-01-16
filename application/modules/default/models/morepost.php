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
	
	public function getPostList($arr_cols,$arr_table, $arr_where,$arr_order_by,$limit){
		$query = "SELECT ";
		$i = 1;
		foreach($arr_cols as $col)
		{
			$query .= " " . $col;
			if ($i < count( $arr_cols ))
				$query .= " , ";
			$i++;
		}
		
		$query .= " FROM ";
		$i = 1;
		foreach($arr_table as $table)
		{
			$query .= " " . $table;
			if ($i < count( $arr_table ))
				$query .= " , ";
			$i++;
		}
		
		$query .= " WHERE ";
		$i = 1;
		foreach ($arr_where as $cols => $value)
		{
			$query .= $cols . " " . $value;
			if ($i < count( $arr_where ))
				$query .= " AND ";
			$i++;
		}
		
		if($arr_order_by != NULL)
		{
			$query .= ' ORDER BY ';
			foreach ($arr_order_by as $cols => $value)
			{
				$query .= $cols . ' ' . $value;
			}
		}
		
		if($limit != 0)
		{
			$query .= ' LIMIT ' . $limit;
		}
		
		$sql = $this->db->query ($query);
		return $sql->fetchAll();
	}
}