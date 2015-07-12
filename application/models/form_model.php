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

Class Form_Model extends CI_Model{

	function add($formdata, $MajorGroupId, $SubGroupId1, $SubGroupId2, $SubGroupId3, $SubGroupId4, $SubGroupId5, $isTotal, $Min, $Max, $Description){
		$ctrl=$this->db->insert('cntrl_form', $formdata);
		//var_dump($MajorGroupId,$SubGroupId1,$SubGroupId2,$SubGroupId3,$SubGroupId4,$SubGroupId5,$isTotal,$Min,$Max);

		$data = array(
			'MajorGroupId' => $MajorGroupId,
			'SubGroupId1' => $SubGroupId1,
			'SubGroupId2' => $SubGroupId2,
			'SubGroupId3' => $SubGroupId3,
			'SubGroupId4' => $SubGroupId4,
			'SubGroupId5' => $SubGroupId5,
			'isTotal' => $isTotal,
			'Min' => $Min,
			'Max' => $Max); //,
		//'FormCode'=>$formdata['FormCode']);
		foreach($MajorGroupId as $key => $n){
			$data['MajorGroupId'] = $MajorGroupId[$key];
			$data['SubGroupId1'] = $SubGroupId1[$key];
			$data['SubGroupId2'] = $SubGroupId2[$key];
			$data['SubGroupId3'] = $SubGroupId3[$key];
			$data['SubGroupId4'] = $SubGroupId3[$key];
			$data['SubGroupId5'] = $SubGroupId5[$key];
			$data['isTotal'] = 0; //$isTotal[$key];
			$data['Min'] = $Min[$key];
			$data['Max'] = $Max[$key];
			$data['Description'] = $Description[$key];
			$data['FormCode'] = $formdata['FormCode'];
			// var_dump($data);
            
			$res = $this->db->insert('cntrl_rows', $data);
			if($res && $ctrl){
				$return=true;
			} else{
				$return=false;
			}
            
		}
		return($return);
       
	}
    
	function getForm($FormCode=-1,$Filled=false){
		
		/*$query="select a.*,c.approved,c.uid from cntrl_form a,aauth_groups b,cntrl_form_data_master c
		where 
		a.DeptId=b.id
		and
		c.FormCode=a.FormCode
		and
		c.approved <> 0
		and
		a.Status='active'
		
		";
		if($FormCode!=-1){
			
		$query="select a.* from cntrl_form a,aauth_groups b,cntrl_form_data_master c
		where 
		a.DeptId=b.id
		and
		c.FormCode=a.FormCode
		and
		a.FormCode='$FormCode'
		and 
		a.Status='active'
		LIMIT 1
		";		
		}*/
		
		
		$query="select a.* from cntrl_form a
		WHERE
		a.Status='active'
		
		";
		if($FormCode!=-1){
			
			$query="select a.* from cntrl_form a
			where 
			a.Status='active'
			and a.FormCode='$FormCode'
			";		
		}
		
		if($Filled){
			
			$query="select a.* from cntrl_form a 
			join (select distinct(FormCode)
			from cntrl_form_data_master where approved <> 0 ) b on a.FormCode=b.FormCode
			WHERE
			a.Status='active'
			";		
		}
		
		
		
		
		#$this->db->where('status','active');
		$res=$this->db->query($query);
		return $res->result();
	}
	
	function getForm2($FormCode=-1,$Filled=false){
		
		/*$query="select a.*,c.approved,c.uid from cntrl_form a,aauth_groups b,cntrl_form_data_master c
		where 
		a.DeptId=b.id
		and
		c.FormCode=a.FormCode
		and
		c.approved <> 0
		and
		a.Status='active'
		
		";
		if($FormCode!=-1){
			
		$query="select a.* from cntrl_form a,aauth_groups b,cntrl_form_data_master c
		where 
		a.DeptId=b.id
		and
		c.FormCode=a.FormCode
		and
		a.FormCode='$FormCode'
		and 
		a.Status='active'
		LIMIT 1
		";		
		}*/
		
		
		$query="select a.* from cntrl_form a
		WHERE
		a.Status='active'
		
		";
		if($FormCode!=-1){
			
			$query="select a.* from cntrl_form a
			where 
			a.Status='active'
			and a.FormCode='$FormCode'
			";		
		}
		
		if($Filled){
			
			$query="select b.id,(select name from aauth_groups v where id=b.gid) Institution,a.TimePeriod,
a.FormCode,a.Heading from cntrl_form a ,cntrl_form_data_master b
where b.approved <> 0  and a.FormCode=b.FormCode
and
a.Status='active'";		
		}
		
		
		
		
		#$this->db->where('status','active');
		$res=$this->db->query($query);
		return $res->result();
	}
	
	function getRows($FormCode=-1){
		if($FormCode!=-1){
			$this->db->where('FormCode',$FormCode);
			$res=$this->db->get('cntrl_rows');
			return $res->result();			
		}
		else{
			return FALSE;
		}
		
	}
	function getRow($Id=-1){
		if($Id!=-1){
			$this->db->where('Id',$Id);
			$res=$this->db->get('cntrl_rows');
			return $res->first_row();			
		}
		else{
			return FALSE;
		}
		
	}
	
	function saveRows($data){

		//die();
		return $this->db->insert('cntrl_row_data',$data);	
	}
	
	function getRowCount($id){
		$res=$this->db->query('select count(id) count from  cntrl_form_data_master where approved <> 0
			and FormCode="'.$id.'";');
		return $res->first_row()->count;
	}
	
	function deleteForm($FormCode){
		$this->db->where('FormCode',$FormCode);
		return $this->db->delete('cntrl_form');
	}	
	
	function get_master_id($id){
		$uid=$this->aauth->get_user_id();
		
		$gid=$this->aauth->get_company($uid);
		$sql = "INSERT INTO `fdcas`.`cntrl_form_data_master` (`id`,`FormCode`, `status`, `approved`, `created_date`, `approved_date`, `uid`, `gid`) VALUES (NULL, '".$id."', '1', '0', now(), NULL, '".$uid."', '".$gid."')";
		$this->db->query($sql);
		return $this->db->insert_id();
	}
	
	function get_sigle_row($cntrl_form_data_master_id,$rowid){
		$this->db->where('cntrl_form_data_master_id',$cntrl_form_data_master_id);
		$this->db->where('rowid',$rowid);
		$res=$this->db->get('cntrl_row_data');
		return $res->first_row();
	}

}
