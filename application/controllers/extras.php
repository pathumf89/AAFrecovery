<?php

if(!defined('BASEPATH'))
exit('No direct script access allowed');
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

if(!defined('BASEPATH'))
exit('No direct script access allowed');
	
class Extras extends CI_Controller{
	function __construct(){
		
		parent::__construct();
		if(!$this->aauth->is_loggedin()){
			redirect('/');
		}
	
		$this->load->helper(array('form', 'url'));
		
	}

	function index(){
		$data['script']="$('#famsg').jqte();";
		$data['error']= ' ' ;
		$data['groups']=$this->aauth->list_groups();
		$data['main_content']='extras/fa_select';
		$this->load->view('layout',$data);	
	}

	function do_upload(){
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'pdf|doc|docx';
		$config['max_size']	= '1024';
		#$config['max_width']  = '1024';
		#$config['max_height']  = '768';
		$res=array();
		$this->load->library('upload', $config);

		if( ! $this->upload->do_upload()){
			//var_dump($this->upload->display_errors());
			$data['error'] = $this->upload->display_errors();
			$data['script']="$('#famsg').jqte();";
			$data['groups']=$this->aauth->list_groups();
			$data['main_content']='extras/fa_select';
			$this->load->view('layout',$data);	
		}
		else{
			//var_dump($this->upload->data());
			$data['upload_data'] = $this->upload->data();
			$this->load->model('extras_model');
			$groups=$this->input->post('groups');
			
			foreach($groups as $group){
				$sql="select b.email from aauth_company a, aauth_users b
				where
				a.`group`=$group
				and
				b.id=a.user";
				$rs=$this->db->query($sql);
				$res[]=$rs->first_row()->email;
				//echo .;
			}
			
				
				$this->extras_model->sendEmail($res,'FDCAS Financial Announcements',$this->input->post('msg'),$data['upload_data']['full_path']);
			
			#$this->extras_model->sendEmail('admin@drklk.org','fdcas test','test msg',$data['upload_data']['full_path']);
			$data['groups']=$this->aauth->list_groups();
			$data['script']="$('#famsg').jqte();";
			$data['main_content']='extras/fa_select';
			$this->load->view('layout',$data);	
		}
	}
	
	function add_master_data($id=NULL){
		#$this->extras_model->sendEmail('admin@drklk.org','fdcas test','test msg',$data['upload_data']['full_path']);
		//$data['groups']=$this->aauth->list_groups();
		
		if(!$this->aauth->is_allowed('Administrator')){
			$id=$this->aauth->get_company();
		}
		
		if($id!=NULL){	
			//phpinfo();
			$this->db->where('company',$id);
			$data['res']=$this->db->get('cntrl_company_master');
			$data['res']=$data['res']->first_row();
		}
		
		$data['script']="";
		if($x=$this->input->post()){
			$res=$this->db->where('company',$this->input->post('company'));
			$res=$this->db->get('cntrl_company_master');
			//echo($res->num_rows());
			//die();
			$id=$this->input->post('company');
			if($res->num_rows()==0){
				
			//var_dump($x);
				if($this->db->insert('cntrl_company_master',$x)){
					$data['script']='alert("Master Data Saved");';
				}
				else{
					$data['script']='alert("Error Duplicate Entry");';
				}
			}
			else{
				//var_dump($x);
				$this->db->where('company',$this->input->post('company'));
				if(@$this->db->update('cntrl_company_master',$x)){
					$data['script']='alert("Master Data Saved");';
				}
				else{
					$data['script']='alert("Error Duplicate Entry");';
				}
				
			}
			
		}
		$data['groups']=$this->aauth->list_groups();
		$data['script']="$('#wysiwyg').jqte();
		$('dynamic_select').select2().enable(false);";
		$data['main_content']='masterdata/add';
		if($id==null) { $id=$this->aauth->get_company(); }
		$data['id']=$id;
		$this->load->view('layout',$data);
		
			
		
	}
	
	function institutional_analysis(){
		$this->load->model('report_model');
		$data['res']=$this->report_model->get_alert_warnings();
		$data['main_content']='extras/ia';
		$this->load->view('layout',$data);
		
	}
	
}