<?php

class Model_User extends Zend_Db_Table_Abstract {
	
	/**
	 *
	 * @var table name
	 */
	protected $_name = 'kb_user';
	protected $_primary = 'user_id';
	
	public function deleteItem($id) {
		
		$row = $this->find ( $id )->current ();
		if ($row) {
			$row->delete ();
		} else {
			throw new Zend_Exception ( "Could not delete row.  Row not found!" );
		}
	}
	
	public function addUser($data = array()) {
		
		$row = $this->createRow ();
		if (count ( $data ) > 0) {
			foreach ( $data as $key => $value ) {
				$row->$key = $value;
			}
		}
		return $row->save ();
	}
	
	public function editUser($id, $data = array()) {
		
		$row = $this->find ( $id )->current ();
		if ($row) {
			foreach ( $data as $key => $value ) {
				$row->$key = $value;
			}
		} else {
			throw new Zend_Exception ( 'Could not select row.' );
		}
		return $row->save ();
	}
	
	public function gettAllUser() {
		
		$query = $this->select ()->from ( $this->_name );
		return $this->fetchAll ( $query )->toArray ();
	
	}
	public function getUser($where = array(), $order = array()) {
		
		$query = $this->select ()->from ( $this->_name );
		if (count ( $order )) {
			$query->order ( $order ['field'] . ' ' . $order ['dir'] );
		}
		
		if (count ( $where )) {
			foreach ( $where as $condition => $value ) {
				$query->where ( $condition, $value );
			}
		}
		
		return $this->fetchAll ( $query )->toArray ();
	
	}
}