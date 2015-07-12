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

Class Approval_Model extends CI_Model{


	function getQueue(){
		if($this->aauth->is_allowed('Administrator'))
		{
			$sep="";
		}
		else
		{
			$sep=" and c.gid=".$this->aauth->get_company();
		}
		$forms="select c.id, c.uid, (select name from aauth_groups x where x.id=c.gid )  Company,a.FormCode,a.Heading,a.TimePeriod from cntrl_form a,aauth_groups b,cntrl_form_data_master c
		where 
		a.DeptId=b.id
		and
		c.FormCode=a.FormCode
		and
		c.approved=0
		$sep";
		
		//echo $forms;

		$standards="select a.id,b.id RowID,uid,gid,a.Min NewMin,a.Max NewMax,b.Min OldMin,b.Max OldMax,last_changes,FormCode,Description from cntrl_standards_queue a , cntrl_rows b
		where a.cntrl_rows_id = b.id and a.approved is null";

		$alerts="select a.id,a.UserId uid,a.DeptId gid,a.AlertDate,b.Description,b.FormCode from cntrl_alert a, cntrl_rows b
		where a.RowId=b.id
		and a.ApprovedDate is null";

		$data['forms']=$this->db->query($forms);
		$data['forms']=$data['forms']->result();
		$data['standards']=$this->db->query($standards);
		$data['standards']=$data['standards']->result();
		$data['alerts']=$this->db->query($alerts);
		$data['alerts']=$data['alerts']->result();

		return $data;
	
	}

	function approveForm($id){
		$sql="update cntrl_form_data_master set approved=true ,approved_date=now()
		where id='$id'";
		//echo $sql;
		return $this->db->query($sql);

	}
	
	function rejectForm($id){
		
		$sql="delete from cntrl_form_data_master where id='$id'";
		//$sql;
		return $this->db->query($sql);
	}
	
	
	
	function approveAlert($id){
		$sql="update cntrl_alert set ApprovedDate=now(),ApproverId=".$this->aauth->get_user_id()." where Id=$id";
		return $this->db->query($sql);

	}
	
	function rejectAlert($id){
		$sql="delete from cntrl_alert where Id=$id";
		return $this->db->query($sql);

	}
	
	
	function approveStandard($rowid,$id,$min,$max){
		$sql="update cntrl_standards_queue set approved_by=".$this->aauth->get_user_id().",approved=now() where id=$id";
		$this->db->query($sql);
		$sql="update cntrl_rows set Min='$min',Max='$max' where Id=$rowid";
		return $this->db->query($sql);
	}
	
	function rejectStandard($id){
		$sql="delete from cntrl_standards_queue where id=$id";
		$this->db->query($sql);
		return $this->db->query($sql);
	}
}
?>