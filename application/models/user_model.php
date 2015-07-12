<?php

/*

* The MIT License (MIT)

* Copyright (c) 2014 <T.H.M Kothalawala>

* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:

* The above copyright notice and this permission notice shall be included in
* all copies or substantial portions of the Software.

* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
* THE SOFTWARE.
*/
?>

<?php

Class User_Model extends CI_Model{
	/*
	function login($username, $password) {
	$this->db->select('*');
	$this->db->from('user_view');
	$this->db->where('username', $username);
	$this->db->where('password', ($password));
	$this->db->limit(1);

	$query = $this->db->get();

	if ($query->num_rows() == 1) {
	return $query->result();
	} else {
	return false;
	}
	}

	function view($id) {
	$this->db->select('*');
	$this->db->from('user_view');
	if ($id != "all") {
	$this->db->where('id', $id);
	}

	$query = $this->db->get();

	if ($query->num_rows() >= 1) {
	return $query->result();
	} else {
	return false;
	}
	}

	function view_institutions($id) {
	$this->db->select('*');
	$this->db->from('user_department_view');
	if ($id != "all") {
	$this->db->where('id', $id);
	}

	$query = $this->db->get();

	if ($query->num_rows() >= 1) {
	return $query->result();
	} else {
	return false;
	}
	}

	function view_user_types($id) {
	$this->db->select('*');
	$this->db->from('user_types');
	if ($id != "all") {
	$this->db->where('type_id', $id);
	}

	$query = $this->db->get();

	if ($query->num_rows() >= 1) {
	return $query->result();
	} else {
	return false;
	}
	}

	function add_user($data) {

	if ($this->db->insert('user', $data)) {
	return true;
	} else {
	return false;
	}
	}

	function delete_user($data) {
	//$this->db->where('user_id', $data);
	if ($this->db->delete('user', array('user_id' => $data)))
	{
	return "User Deleted Successfully";
	}
	else
	{
	return "User Deletion Failed";
	}
           
	}
	*/

	function get_group($uid=null){
	
		if($uid==null)
		{
				$uid=$this->aauth->get_user_id();
		}
		$this->db->where('user',$uid);
		$res=$this->db->get('aauth_company');
		$res=$res->first_row()->group;
		return $res;
		/*foreach($this->aauth->list_groups() as $group){
			$res=$this->aauth->is_member($group->id);
			if($res){
				return $group->id;
			}
		
		
		}*/
		//return false;
	}
}
?>
