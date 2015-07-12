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

Class Alert_Model extends CI_Model{
	function add($id=-1,$DeptId=-1){
		$data['RowId']=$id;
		$data['DeptId']=$DeptId;
		$data['UserId']=$this->aauth->get_user_id();
		return $res=$this->db->insert('cntrl_alert',$data);
	}
	function all(){
		
		$res=$this->db->query('select * from cntrl_alert where ApproverId  is not null');
		
		$this->load->model('standard_model');
		$res=$res->result();
		$data=array();
		$i=0;
		foreach($res as $row){
			//var_dump($row);
			//die();
			//echo $row->RowId;
			$data[$i]['Dept']=$this->aauth->get_company($row->DeptId);
			$data[$i]['Heading']= $this->standard_model->getStandard($row->RowId)->Heading;
			$data[$i]['Description']= $this->standard_model->getStandard($row->RowId)->Description;
			$data[$i]['UserId']= $this->aauth->get_user($row->UserId)->name;
			$data[$i]['AlertDate']= $row->AlertDate;
			if(!$row->ApproverId){
				$data[$i]['ApproverId']= $row->ApproverId;
			}
			else{
				$data[$i]['ApproverId']= $this->aauth->get_user($row->ApproverId)->name;	
			}
			$data[$i]['ApprovedDate']= $row->ApprovedDate;
			$i++;
		}
		 
		return($data);
	}
	
}