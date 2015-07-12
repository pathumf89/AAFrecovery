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

class Alert extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->aauth->is_loggedin()){
			redirect('/');
		}
	}

	public function index(){
		redirect('/');
	}
	
	public function add(){
		if($this->input->post()){
			
			$this->load->model('alert_model');
			$check=$this->db->query("select * from cntrl_alert where RowId='".$this->input->post('RowId')."'");
			$check=$check->num_rows();
			$res=$this->alert_model->add($this->input->post('RowId'),$this->input->post('DeptId'));	
			if($res){
				$data['script']='alert("Alert was Successfully Saved.");';
			}
			else{
				if($check>0)
				{
					$data['script']='alert("Sorry! Duplicate Alert.")';
				}
				else {
					$data['script']='alert("ERROR:Unable to Save the Alert.")';
				}				
				
				
			}
			
		}
		/*$this->load->model('standard_model');
		$data['res']=$this->standard_model->listeStandards();
		$this->load->view('alerts/add',$data);*/
		$data['groups']=$this->aauth->list_groups();
		$this->load->model('standard_model');
		$data['res']=$this->standard_model->listeStandards();
		$data['main_content']='alerts/add2';
		$this->load->view('layout', $data);
		
	}
	

	public function all(){
		$this->load->model('alert_model');
		$data['res']=$this->alert_model->all();
		$data['main_content']='alerts/list';
		$this->load->view('layout',$data);
		
	}
}