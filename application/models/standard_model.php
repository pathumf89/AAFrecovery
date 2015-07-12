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

Class Standard_Model extends CI_Model {
	function updateStandard($Id,$data)
	{
		$data['uid']=$this->aauth->get_user_id();
		$data['gid']=$this->aauth->get_company();
		$data['cntrl_rows_Id']=$Id;
		//$this->db->set('gid',$id,FALSE);
		//$this->db->set('uid',$uid,FALSE);
		//$this->db->set('approved',0);
		$this->db->set('last_changes', 'NOW()', FALSE);
		return $this->db->insert('cntrl_standards_queue',$data);
	}
	
	function getStandard($id=-1)
	{
		$this->db->where('Id',$id);
		//$this->db->or_where('Min','is not null');
		$res=$this->db->get('cntrl_standards');
		return $res->first_row();
	}
	
	function listeStandards()
	{
		//$this->db->where('Max','is not null');
		//$this->db->or_where('Min','is not null');
		$res=$this->db->get('cntrl_standards');
		return $res->result();
	}
	
	function resetStandard($id)
	{
		//$this->db->where('Max','is not null');
		//$this->db->or_where('Min','is not null');
		$this->db->set('Max',NULL);
		$this->db->set('Min',NULL);
		$this->db->where('ID',$id);
		$res=$this->db->update('cntrl_rows');
		return $res;
	}
	
	}