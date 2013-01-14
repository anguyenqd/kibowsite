<?php

class Model_ReferenceCode extends Zend_Db_Table_Abstract {
	
	/**
	 *
	 * @var table name
	 */
	protected $_name = 'kb_reference_code';
	protected $_primary = 'reference_code_id';
	
	
	public function deleteItem($id) {
		
		$row = $this->find ( $id )->current ();
		if ($row) {
			$row->delete ();
		} else {
			throw new Zend_Exception ( "Could not delete row.  Row not found!" );
		}
	}
	
	public function addReferenceCode($data = array()) {
		
		$row = $this->createRow ();
		if (count ( $data ) > 0) {
			foreach ( $data as $key => $value ) {
				$row->$key = $value;
			}
		}
		return $row->save ();
	}
	
	public function editReferenceCode($id, $data = array()) {
		
		$where = $this->getAdapter ()->quoteInto ( $this->_primary . ' = ?', $id );
		return $this->update ( $data, $where );
	}
	
	public function getAllReferenceCode() {
		
		$query = $this->select ()->from ( $this->_name );
		return $this->fetchAll ( $query )->toArray ();
	
	}
	public function getReferenceCode($where = array(), $order = array()) {
		
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