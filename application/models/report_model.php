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

Class Report_Model extends CI_Model{
	function getReport($id){
		//$this->db->where('FormCode',$id);
		//$this->db->order_by('id','asc');
		//$this->db->order_by('companyid');
		//$this->db->limit($limit1,$limit2);
		/*$sql='select * from cntrl_row_data a,cntrl_rows b
		where a.cntrl_form_data_master_id in (select id from  cntrl_form_data_master where approved <> 0)
		and a.rowid=b.Id
		and b.FormCode="'.$id.'"
		order by cntrl_form_data_master_id,b.Id asc LIMIT '.$limit1.','.$limit2;*/
		$sql="select * from cntrl_row_data a,cntrl_rows b
		where a.cntrl_form_data_master_id = $id
		and a.rowid=b.Id
		
		order by cntrl_form_data_master_id,b.Id asc ";
		//echo($sql);
		$res=$this->db->query($sql);
		return $res->result();
	}
	
	function getFeildCount($id){
		
		//select count(*) from cntrl_rows where FormCode="FDCAS-CB-PUB-001";
		//$this->db->count_all_results();
		$sql='select count(*) count from cntrl_rows where FormCode="'.$id.'"';
		//echo $sql;
		$res=$this->db->query($sql);
		//$this->db->limit($limit1,$limit2);
		return $res->first_row()->count; 
		//exit();
		
	}
	
	function system_stat(){
		$sql="select(select count(distinct(FormCode)) Forms from cntrl_form_data_master where approved <> 0) Forms,(select count(*) Standards from cntrl_rows 
		where FormCode in (select distinct(FormCode) from cntrl_form_data_master where approved <> 0)
		and ( Max is not null or Min is not null)) Standards,(select count(*) Alerts from cntrl_alert where ApproverId is not null) Alerts,
		(select (select count(distinct(FormCode)) Forms from cntrl_form_data_master where approved = 0)  + 
		(SELECT count(*) FROM `cntrl_standards_queue` where approved_by is null)  + 
		(select count(*) Alerts from cntrl_alert where ApproverId is null)) PendingTasks";
		$res=$this->db->query($sql);
		return $res->first_row();
	}
	
	function jasperList(){
		
		$opts = array (
			'http' => array (
				'method' => "GET",
				'header' => "Authorization: Basic " . base64_encode ( "jasperadmin:jasperadmin" ) .
				"\r\n" 
			) 
		);

		$context = stream_context_create ( $opts );

		//read the feed
		$fp = fopen ( 'http://localhost:8080/jasperserver/rest/resources/CBSL', 'r', false, $context );

		//here you got the content
		$context = stream_get_contents ( $fp );

		fclose ( $fp );

		$doc = new DOMDocument ();

		//load the content
		$doc->loadXML ( $context );

		$employees = $doc->getElementsByTagName( "resourceDescriptor" );
		$data=array();
		$i=0;

		foreach( $employees as $employee ){
			$data[$i]['uri']=$employee->getAttribute('uriString');
			$data[$i]['name']=$employee->getAttribute('name');
			//$names = $employee->getElementsByTagName( "name" );
			//$name = $names->item(0)->nodeValue;ි
			$i++;
	
		}
	
		return $data;

	}

	function get_alert_warnings(){
		if($this->aauth->is_allowed('Administrator'))
		{
			$sep="";
		}
		else
		{
			$sep=" and a.CompanyId=".$this->aauth->get_company();
		}
		$sql="select c.FormCode,c.TimePeriod,b.Description,a.id,a.CompanyId,a.value,b.Min,b.Max from cntrl_row_data a, cntrl_rows b , cntrl_form c where (a.value > b.Max or a.value < b.Min)
		and 
		a.rowid=b.Id
		and 
		a.rowid in (select RowId from cntrl_alert)
		and b.FormCode=c.FormCode
		$sep";
		$res=$this->db->query($sql);
		return $res->result();
	}

}