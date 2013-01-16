<?php
/**
 * @author Dante Nguyen
 *
 */
class Model_post extends Zend_Db_Table_Abstract{
    protected $_name="kb_post";
    protected $_primary="post_id";
    protected $db;
   
    /**
     * List of all post
     */
    public function listall(){
       return $this->fetchall()->toArray();
    }
    
    /**
     * Get a list of post in database with with condition
     * @param array $arr_colums : colums name will be displayed
     * @param array $arr_condition_names : conditions name will be applied.
     * Structure : array('condition_sentence' => 'condition_name'). Example : condition_sentence : AND, OR, First; condition_name : colums name > ?
     * @param array $arr_condition_values : condition values appropriate with condition name
     * @param string $order_by : conlum name will be applied to order
     * @param string $order_direction : the order direction
     * @param int $limit : the record limited value
     */
    
    public function listWithCondition($arr_colums, $arr_condition_names, $arr_condition_values, $order_by,$order_direction, $limit){
    	$data=$this->select();
    	
    	
    	$data->from('kb_post',$arr_colums);
    	$i = 0;
    	if($arr_condition_names != NULL){
    		foreach ($arr_condition_names as $k=>$v){
    			if($k != 'OR')
    			{
    				$data->where($v,$arr_condition_values[$i]);
    			}else
    			{
    				$data->orWhere($v,$arr_condition_values[$i]);
    			}
    			$i++;
    		}
    	}
    	
    	if($order_by != NULL)
    	{
    		$data->order($order_by." ".$order_direction);
    	}
    	
    	if($limit != 0)
    	{
    		$data->limit($limit);
    	}
    	$data = $this->fetchAll($data);
    	return $data->toArray();
    }
    
    public function getPost($user_id,$post_id,$arr_colums){
    	$data=$this->select();
    	$data->from('kb_post',$arr_colums);
    	$data->where('post_id = ?',$post_id);
    	$data->where('user_id = ?',$user_id);
    	
    	$data=$this->fetchAll($data);
    	return $data->toArray();
    }
    
    public function getPostById($id) {
    	$data=$this->select();
    	$data->from($this->_name);
    	$data->where('post_id = ?', $id);
    	$data=$this->fetchAll($data);
    	return $data->toArray();
    }
    
    
    public function getPosts($where = array(), $order = array()) {
    
    	$query = $this->select ()->from ( $this->_name );
    	if (is_array($order) && count ( $order )) {
    		$query->order ( $order ['field'] . ' ' . $order ['dir'] );
    	}
    
    	if (is_array($where) && count ( $where )) {
    		foreach ( $where as $condition => $value ) {
    			$query->where ( $condition, $value );
    		}
    	}
    	
    	return $this->fetchAll ( $query )->toArray ();
    
    }
    
    /**
	 * Add new post
     * @param array $arr_data : post data with key is colum name and value is new value.
     * Example : array('colum name'=>'value')
     * @return 1 if success - 0 if fail
     */
    public function addNewPost($arr_data){
    	if(count($arr_data) > 0 && $arr_data != NULL)
    	{
    		$row = $this->fetchNew();
    		foreach ($arr_data as $k=>$v)
    		{
    			$row->$k = $v;
    		}
    		$row->save();
    		return 1;
    	}else
    	{
    		return 0;
    	}
    }
    
    /**
     * @param int $id : id of the row will be updated
     * @param array $arr_data : post data with key is colum name and value is new value.
     * Example : array('colum name'=>'value')
     * @return success row if success - 0 if fail
     */
    public function updatePost($id, $arr_data){
    	if(count($arr_data) > 0 && $arr_data != NULL)
    	{
    		$where = $this->getAdapter ()->quoteInto ( $this->_primary . ' = ?', $id );
  			return $this->update ($arr_data, $where);
    	}else
    	{
    		return -1;
    	}
    }
    
    /**
     * @param int $id : id of the row will be updated
     * @return success row
     */
    public function deletePost($arr_add_condition){
    	$i = 0;
    	$where = array();
    	foreach($arr_add_condition as $k => $v)
    	{
    		$where[] = $this->getAdapter ()->quoteInto ( $v["colum"] . $v["operater"] . '?', $k );
    	}
    	$i += $this->delete($where);
  		return $i;
    }
}