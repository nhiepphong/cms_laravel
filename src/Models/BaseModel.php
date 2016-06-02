<?php

namespace Nhiepphong\Backend\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    //

    public static function getUserByEmail($email)
    {
    	$result = self::where('email', $email)->first();
        return $result;
    }

    public static function get($select = "*", $table = "", $where = "")
	{
		$result = null;

		if($where != "")
		{
			$result = DB::table($table)->where('name', 'John')->first();
		}
		
		return $result;
	}

	public static function fetch($select = "*", $table = "", $where = "", $order = "", $by = "DESC", $start = -1, $limit = 0, $return_array = false)
	{
		$this->db->select($select);
		if($where != "")
		{
			$this->db->where($where);
		}
		if($order != "" && ($by == "DESC" || $by == "ASC"))
		{
			$this->db->order_by($order, $by);
		}
		if((int)$start >= 0 && (int)$limit > 0)
		{
			$this->db->limit($limit, $start);
		}
		#Query
		$query = $this->db->get($table);
		if($return_array){
			$result = $query->result_array();
		} else {
			$result = $query->result();
		}
		$query->free_result();
		return $result;
	}

	public static function fetch_join($select = "*", $table = "", $where = "", $join_1 = "", $table_1 = "", $on_1 = "", $join_2 = "", $table_2 = "", $on_2 = "", $order = "", $by = "DESC", $start = -1, $limit = 0, $distinct = false,$return_array = false)
	{
        $this->db->select($select);
		if(($join_1 == "INNER" || $join_1 == "LEFT" || $join_1 == "RIGHT") && $table_1 != "" && $on_1 != "")
		{
			$this->db->join($table_1, $on_1, $join_1);
		}
		if(($join_2 == "INNER" || $join_2 == "LEFT" || $join_2 == "RIGHT") && $table_2 != "" && $on_2 != "")
		{
			$this->db->join($table_2, $on_2, $join_2);
		}
		if($where != "")
		{
			$this->db->where($where);
		}
		if($order != "" && ($by == "DESC" || $by == "ASC"))
		{
            $this->db->order_by($order, $by);
		}
		if((int)$start >= 0 && (int)$limit > 0)
		{
			$this->db->limit($limit, $start);
		}
		if($distinct == true)
		{
			$this->db->distinct();
		}
		#Query
		$query = $this->db->get($table);
		if($return_array){
			$result = $query->result_array();
		} else {
            $result = $query->result();
		}
		$query->free_result();
		return $result;
	}

	public static function insert($table = "", $data)
	{
		return $this->db->insert($table, $data);
	}

	public static function update($table = "", $data, $where = "")
	{
    	if($where != "")
    	{
            $this->db->where($where);
    	}
		return $this->db->update($table, $data);
	}

	public static function delete($table = "", $where = "")
    {
		if($where != "")
    	{
            $this->db->where($where);
    	}
		return $this->db->delete($table);
    }
    
    
	/*BEGIN: ADMIN*/
	public static function getRecords($table_name, $select='*', $from, $where_conditions=null, $char_sort = 'id', $t_sort = 'DESC', $start=-1, $limit=-1){
		$result = array();
		if(!empty($from)){
			if($start==-1){ //Count
				//$query = "SELECT 1 ";
                $this->db->select($table_name.'.id');
			} else {
				//$query = "SELECT $select ";
                $this->db->select($select);
			}
			//$query .= "FROM $from ";
			if($where_conditions!=null){
				//$query .= "WHERE $where_conditions ";
                $this->db->where($where_conditions);
			}
			//$query .= "ORDER BY $table_name.$char_sort $t_sort ";
            $this->db->order_by($table_name.'.'.$char_sort, $t_sort);
			if($start!=-1){
				//$query .= "LIMIT $start, $limit ";
                $this->db->limit($limit, $start);
			}
            $query = $this->db->get($from);
			//$query = $this->db->query($query);
			$result = $query->result_array();
            //echo $this->db->last_query(); //exit();
			if($start==-1){ //Count
				$result = $query->num_rows();
			} else {
				$result = $query->result();
			}
		}
        //last_query();
		return $result;
	}

	public static function delete_record($table_name, $record_ids)
	{
		return $this->db->query("DELETE FROM $table_name WHERE id IN ($record_ids)");
	}
	
	public static function set_enable_record($table_name, $record_ids, $is_active, $mod)
	{
		return $this->db->query("UPDATE $table_name SET is_active = $is_active WHERE id IN ($record_ids)");
	}
}
